<?php
namespace Fox\ORM\Support\DB;

use \Fox\Core\Exceptions\InternalServerError;

class PDO 
{
	/*
	 * 成员属性
	 */
	protected $db_type;	// 数据库类型
	protected $host;		// 主机名
	protected $port;		// 端口号
	protected $user;		// 用户名
	protected $pass;		// 密码
	protected $charset;	// 字符集
	protected $dbname;	// 数据库名称
	public    $prefix;	// 表前缀
	protected  $pdo;		// PDO实例化对象
	
	protected $config;
	# 是否启用连接池
	protected $usepool;
	
	# 是否开启debug模式
	protected $debug;

	/*
	 * 构造方法 初始化数据库连接
	 * @param array $arr   = array() 连接数据库信息数组
	 * @param bool  $error = true    true开启异常处理模式,false关闭异常处理模式
	 */
	public function __construct()
	{
	    $pdo = app('entityManager')->getPDO();
	    
		// 连接数据库
		$this->dbConnect($pdo);

		// 设置为utf8编码
		$this->pdo->query('set names utf8');
	}
	
	/*
	 * 连接数据库
	 * 成功产生PDO对象,失败提示错误信息
	 */
	protected function dbConnect($pdo)
	{
		try {
            $this->pdo = $pdo;
			$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);// 开启异常处理
			return $this->pdo;
		} catch (\PDOException $e) {
			return $this->dealErrorInfo($e);
		}
	}

	public function release()
	{
		if ($this->usepool) {
			$this->pdo->release();
		}
	}
	
	// 开启事务
	public function beginTransaction()
	{
	   return $this->pdo->beginTransaction();
	}
	// 提交事务
	public function commit()
	{
	   return $this->pdo->commit();
	}
	// 回滚
	public function rollBack()
	{
	   return $this->pdo->rollBack();
	}
	
// --------------------------------------------------------------
//  | 无预处理, 直接执行sql操作
// --------------------------------------------------------------	
	/**
	 * exec写操作
	 * */
 	public function exec($command)
	{
		try {
			$res = $this->pdo->exec($command);
			$this->release();
			return $res;
		} catch (\PDOException $e) {
			return $this->dealExecption($command, 'exec', $e);
		}
	}

	public function query($sql)
	{
		try {
			$res = $this->pdo->query($sql);;
			$this->release();
			return $res;
		} catch (\PDOException $e) {
			return $this->dealExecption($sql, 'query', $e);
		}
	}
	
	/**
	 * 查询多条数据
	 * */
	public function find($sql)
	{
		$stmt = $this->query($sql);
		return $stmt ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : false;
	}
	
	
	/**
	 * 查询单条数据
	 * */
	public function findOne($sql) 
	{
		$stmt = $this->query($sql);
		return $stmt ? $stmt->fetch(\PDO::FETCH_ASSOC) : false;
	}
	
	/*
	 * 新增数据操作
	* @param  string $sql 要处理的SQL语句
	* @return mixed       成功返回新插入数据自增长id,失败返回0
	*/
	public function dbInsert(& $sql)
	{
		$res = $this->exec($sql);
		$id  = $this->pdo->lastInsertId();
		if ($id) {
			return $id;
		}
		return $res;
	}
	
	# 批量添加
	public function batchAdd($table = '', array & $data)
	{
		$field  = '';
		$values = '';
		$key    = '';
		$vals   = '';
	
		foreach ($data as & $info) {
			if (empty($info))
				continue;
				
			foreach ($info as $k => & $v) {
				if ($key != 'ok')
					$key    .= '`' . $k . '`,';
				$vals .= '"' . $v . '",';
			}
			if (empty($field)) {
				$field  = substr($key,  0, - 1);
				$key    = 'ok';
			}
			$vals    = substr($vals,  0, - 1);
			$values .= '(' . $vals . '),';
			$vals    = '';
		}
		$values = substr($values, 0, -1);
	
		$sql = 'INSERT INTO `' . $table . '` (' . $field . ') VALUES ' . $values;
	
		return $this->dbInsert($sql);
	}
	
	
// --------------------------------------------------------------
//  | 预处理执行sql操作
// --------------------------------------------------------------	
	
	/**
	 * 预处理
	 * */
	public function prepare($sql, array & $data, $select = true) 
	{
		try {
			$stmt = $this->pdo->prepare($sql);

			$this->release();
			if (! $stmt) {
				return false;
			}

			$stmt->execute($data);

			return $select ? $stmt : $stmt->rowCount();
		} catch (\PDOException $e) {
			$stmt = $this->dealExecption($sql, 'prepare', $e);

			if (! $stmt) {
				return false;
			}

			$stmt->execute($data);

			return $select ? $stmt : $stmt->rowCount();
		}
	}


	/**
	 * 查询单条数据操作
	 * 
	 * @param  string $sql 要处理的SQL语句
	 * @param array $whereData where字句值, 如: [48, '小强']
	 * @return mixed       成功返回关联一维数组,失败返回false
	 */
	public function dbGetRow($sql, array $whereData = [])
	{
		$stmt = $this->prepare($sql, $whereData);
		return $stmt ? $stmt->fetch(\PDO::FETCH_ASSOC) : false;
	}

	/**
	 * 查询多条数据操作
	 * 
	 * @param  string $sql 要处理的SQL语句
	 * @param array $whereData where字句值, 如: [48, '小强']
	 * @return mixed       成功返回关联二维数组,失败返回false
	 */
	public function dbGetAll($sql, array $whereData)
	{
		$stmt = $this->prepare($sql, $whereData);
		
		return $stmt ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : false;
	}
	
	
	
	/**
	 * 预处理修改
	 * 
	 * @param string $table
	 * @param array $data 要修改的数据
	 * @param string $where where字句, 参数值用"?"代替, 如: WHERE id = ? AND name = ?
	 * @param array $whereData where字句值, 如: [48, '小强']
	 * @return int 
	 * */
	public function update($table, array $data = [], $where = '', array $whereData = [])
	{
		$updateStr = '';
		foreach ($data as $key => $val) {
			if (strpos($key, '=') === false) {
				$updateStr .= '`' . $key . '` = ?,';
			} else {
				$updateStr .= $key . ' ?,';
			}
			
			$data[] = $val;
			unset($data[$key]);
		}
		
		foreach ($whereData as $v) {
			$data[] = $v;
		}
		
		$updateStr = substr($updateStr, 0, - 1);
		$sql = 'UPDATE `' . $table . '` SET ' . $updateStr . $where;
// debug($sql);die;
		return $this->prepare($sql, $data, false);
	}
	
	
	/*
	 * 添加数据
	*
	* @param string $table
	* @param array $data
	* @return boolean
	*/
	public function add($table, array $data) 
	{
		$field = '';
		$values = '';
		
		foreach ($data as $k => $v) {
			$field  .= '`' . $k . '`,';
			$values .= '?,';
			
			unset($data[$k]);
			$data[] = $v;
		}
		$field  = substr($field,  0, - 1);
		$values = substr($values, 0, - 1);

		$sql = 'INSERT INTO `' . $table . '` (' . $field . ') VALUES (' . $values . ')';
		
		$res = $this->prepare($sql, $data, false);
		$id = $this->pdo->lastInsertId();
		if ($id) {
			return $id;
		}
		return $res;
		
	}
	
	public function replace($table, array $data)
	{
	    $field = '';
	    $values = '';
	
	    foreach ($data as $k => $v) {
	        $field  .= '`' . $k . '`,';
	        $values .= '?,';
	        	
	        unset($data[$k]);
	        $data[] = $v;
	    }
	    $field  = substr($field,  0, - 1);
	    $values = substr($values, 0, - 1);
	
	    $sql = 'REPLACE INTO `' . $table . '` (' . $field . ') VALUES (' . $values . ')';
	
	    $res = $this->prepare($sql, $data, false);
	    $id = $this->pdo->lastInsertId();
	    if ($id) {
	        return $id;
	    }
	    return $res;
	
	}
	
	public function delete($table, $where = '', array $whereData = []) 
	{
		$sql = 'DELETE FROM `' . $table . '` ' . $where;
		return $this->prepare($sql, $whereData, false);		
	}


	// 异常处理
	protected function dealExecption($sql, $fun, $e) {
		logger()->error($e->getMessage());
	}


	protected function dealErrorInfo($e)
	{
	    
	}

}
