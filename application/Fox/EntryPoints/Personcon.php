<?php
namespace Fox\EntryPoints;

use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;

class Personcon extends Base
{
    public static $authRequired = false;

    public function handle()
    {
//         $id = '23213ddas';

        $wechat = $this->getcontainer()->make('wechatAuth');
        // 获取用户信息
        $user = $wechat->getUser();

        $id     = $user['id'];
        $openId = $user['open_id'];

        if (!empty($_GET['a'])) {
            return $this->dispatch($_GET['a']);
        }

//        $id = '23213ddas';
//        $openId = 'SDFDSFDS';

        $q = $this->q();
        $user = $q->from('account')
            ->select()
            ->where(['id' => $id])
            ->readRow();
        if (!$user) {
            $user = $q->from('account')
                ->select()
                ->where(['open_id' => $openId])
                ->readRow();
            if ($user) {
                // 重新登录
//                $wechat->reLogin($user);
            } else {
                // 重新授权
//                return $wechat->redirect();
            }
        }

        /*// 待支付
        $res1 = $q->from('orders')->where(['seller_id' => $user['id'], 'status' => 0, 'deleted' => 0])->count();
        // 已处理
        $res2 = $q->from('orders')->where(['seller_id' => $user['id'], 'status' => 1, 'deleted' => 0])->count();
        // 已完成
        $res3 = $q->from('orders')
            ->where(
                [
                    'seller_id' => $user['id'], 'status' => 1, 'deleted' => 0, 'audit_status' => 1
                ]
            )
            ->count();

        $data = [
            'wait' => $res1 ? $res1['TOTAL'] : 0,
            'handled' => $res2 ? $res2['TOTAL'] : 0,
            'finished' => $res3 ? $res3['TOTAL'] : 0
        ];*/

        $this->displayClient('wechat', 'personcon', $user);
    }

    public function actionSaveForm()
    {
        $q = $this->q();
        $rs = urldecode(\GuzzleHttp\json_decode(file_get_contents('php://input'),1));
        parse_str($rs,$myarr);
        $mobile = $myarr['mobile'];
        if($mobile==0 || empty($mobile)) {
            return $this->returnMsg('请正确填写手机号！');
        }
        $res= $q->from('account')->where('open_id','SDFDSFDS')->update($myarr);
        if($res){
            return $this->returnMsg('',$res);
        }
        return $this->returnMsg('信息更新失败，或数据无修改!');
    }
}
