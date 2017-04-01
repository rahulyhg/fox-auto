<?php


namespace Fox\Services;

use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\NotFound;

use Fox\ORM\Entity;

class Wechat extends \Fox\Core\Services\Base
{
    public function find($companyId)
    {
        $pdo = $this->getEntityManager()->getPDO();

        $sql = "select * from im_config where id= " . $pdo->quote($companyId);
        $sth = $pdo->prepare($sql);

        $sth->execute();
        $result = false;
        while ($row = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $result = $row;
        }

        return $result;
    }

    public function save($data){
        $pdo = $this->getEntityManager()->getPDO();
        $id  = $this->getUser()->get('company')->id;

        $countSql = "select count(*) as 'COUNT' from im_config where id=" . $id;

        $sth = $pdo->prepare($countSql);
        $sth->execute();
        $row = $sth->fetch(\PDO::FETCH_ASSOC);
        $totalCount = $row['COUNT'];

        if ($totalCount > 0){
            $sql = "update im_config set dispatch_mode=".$pdo->quote($data['dispatch_mode']).",session_time=".$pdo->quote($data['session_time']).",welcome_msg=".$pdo->quote($data['welcome_msg']).",end_msg=".$pdo->quote($data['end_msg']).",reply_mode=".$pdo->quote($data['reply_mode']).",tp_appid=".$pdo->quote($data['tp_appid']).",tp_token=".$pdo->quote($data['tp_token']).",tp_account=".$pdo->quote($data['tp_account']).",tp_encoding_aes_key=".$pdo->quote($data['tp_encoding_aes_key']).",qy_corpid=".$pdo->quote($data['qy_corpid']).",qy_secret=".$pdo->quote($data['qy_secret']).",qy_token=".$pdo->quote($data['qy_token']).",qy_encoding_aes_key=".$pdo->quote($data['qy_encoding_aes_key']) . " where id =". $pdo->quote($id);
        }else{
            $sql = "insert into im_config (id, dispatch_mode, session_time, welcome_msg, end_msg, reply_mode, tp_appid, tp_token, tp_account, tp_encoding_aes_key, qy_corpid, qy_secret, qy_token, qy_encoding_aes_key) values(".$pdo->quote($id).", ".$pdo->quote($data['dispatch_mode']).", ".$pdo->quote($data['session_time']).", ".$pdo->quote($data['welcome_msg']).", ".$pdo->quote($data['end_msg']).", ".$pdo->quote($data['reply_mode']).", ".$pdo->quote($data['tp_appid']).", ".$pdo->quote($data['tp_token']).", ".$pdo->quote($data['tp_account']).", ".$pdo->quote($data['tp_encoding_aes_key']).", ".$pdo->quote($data['qy_corpid']).", ".$pdo->quote($data['qy_secret']).", ".$pdo->quote($data['qy_token']).", ".$pdo->quote($data['qy_encoding_aes_key']).")";
        }

        $sth = $pdo->prepare($sql);
        $sth->execute();

        return true;

    }
}

