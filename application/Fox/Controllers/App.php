<?php
namespace Fox\Controllers;

use \Fox\Core\Exceptions\BadRequest;

class App extends \Fox\Core\Controllers\Base
{
    public function actionUser()
    {
        $preferences = $this->getPreferences()->getValues();
        unset($preferences['smtpPassword']);

        $user = $this->getUser();
        if (!$user->has('teamsIds')) {
            $user->loadLinkMultipleField('teams');
        }
        if ($user->get('isPortalUser')) {
            $user->loadAccountField();
            $user->loadLinkMultipleField('accounts');
        }

        return array(
            'user' => $user->getValues(),
            'acl' => $this->getAcl()->getMap(),
            'preferences' => $preferences,
            'token' => $this->getUser()->get('token')
        );
    }

    public function actionReturnOrderNum($params)
    {
        return $num = date('YmdGis'.time()) . $params['id'];
    }


    public function postActionDestroyAuthToken($params, $data)
    {
        $token = $data['token'];
        if (empty($token)) {
            throw new BadRequest();
        }

        $auth = new \Fox\Core\Utils\Auth($this->getContainer());
        return $auth->destroyAuthToken($token);
    }

    // 微信验证
    public function actionWechatAuth()
    {
        $app = $this->getcontainer()->make('wechat');
        $response = $app->server->serve();
        
        logger()->error('test 234 auth');
        // 将响应输出
        $response->send(); // Laravel 里请使用：return $response;
//         var_dump($response);
        die;
    }
}

