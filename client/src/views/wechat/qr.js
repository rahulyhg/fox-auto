/**
 * Created by jqh on 2017/3/2.
 */
Fox.define('views/wechat/qr', 'view', function (Dep) {
    return Dep.extend({
        template: 'wechat/qr',

        data: function() {
            return {
                css: "/client/css/wechat-mobile.css",

                qrurl: __data__.qr,

                remark: '请在微信中发送二维码进行推广 <br/>1.长按二维码图片，保存图片 <br/> 把二维码图片分享至朋友圈、微信群、微信朋友 <br/>3.被分享用户通过微信扫描二维码进入到"中视流量共享平台"产生的交易，您就可以获得收益'
            }
        },
    })
})
