<?php
namespace Fox\Controllers;

use \Fox\Core\Exceptions\Error;
use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;
use GuzzleHttp\json_decode;

class User extends \Fox\Core\Controllers\Record
{
    public function actionTest()
    {
        return get_class($this->getService(4));die;
    }
    
    public function actionReturnPhp()
    {
        $root = __ROOT__ . '/application/Fox/Core/defaults';
        $data = [];
        $this->getALLFilePath($root, $data);
        
        $this->returnJsonToPhp($data);
        
        return ['success'];
    }
    
    protected function returnJsonToPhp($data)
    {
        $fileManager = app('fileManager');
        
        foreach ((array) $data as & $f) {
            $content = $fileManager->getContents($f);
            $arrayContent = json_decode($content, true);
            
            $new = str_replace('.json', '.php',  $f);
            
            $fileManager->putPhpContents($new, $arrayContent);
        }
    }
    
    protected function getALLFilePath($root, array & $data)
    {
        $dh = opendir($root);//打开目录
        while (($d = readdir($dh)) != false) {
            //逐个文件读取，添加!=false条件，是为避免有文件或目录的名称为0
            if ($d == '.' || $d == '..') {//判断是否为.或..，默认都会有
                continue;
            }

            if (is_dir($root . '/' . $d)) {//如果为目录
                $this->getALLFilePath($root . '/' . $d, $data);//继续读取该目录下的目录或文件
            } else {
                $data[] = $root . '/' . $d;
            }
        }
    }
    
    public function actionAcl($params, $data, $request)
    {
        $userId = $request->get('id');
        if (empty($userId)) {
            throw new Error();
        }

        if (!$this->getUser()->isAdmin() && $this->getUser()->id != $userId) {
            throw new Forbidden();
        }

        $user = $this->getEntityManager()->getEntity('User', $userId);
        if (empty($user)) {
            throw new NotFound();
        }

        return $this->getAclManager()->getMap($user);
    }

    public function postActionChangeOwnPassword($params, $data, $request)
    {
        if (!array_key_exists('password', $data) || !array_key_exists('currentPassword', $data)) {
            throw new BadRequest();
        }
        return $this->getService('User')->changePassword($this->getUser()->id, $data['password'], true, $data['currentPassword']);
    }

    public function postActionChangePasswordByRequest($params, $data, $request)
    {
        if (empty($data['requestId']) || empty($data['password'])) {
            throw new BadRequest();
        }

        $p = $this->getEntityManager()->getRepository('PasswordChangeRequest')->where(array(
            'requestId' => $data['requestId']
        ))->findOne();

        if (!$p) {
            throw new Forbidden();
        }
        $userId = $p->get('userId');
        if (!$userId) {
            throw new Error();
        }

        $this->getEntityManager()->removeEntity($p);

        if ($this->getService('User')->changePassword($userId, $data['password'])) {
            return array(
                'url' => $p->get('url')
            );
        }
    }

    public function postActionPasswordChangeRequest($params, $data, $request)
    {
        if (empty($data['userName']) || empty($data['emailAddress'])) {
            throw new BadRequest();
        }

        $userName = $data['userName'];
        $emailAddress = $data['emailAddress'];
        $url = null;
        if (!empty($data['url'])) {
            $url = $data['url'];
        }

        return $this->getService('User')->passwordChangeRequest($userName, $emailAddress, $url);
    }
}

