/**
 * Created by jqh on 2017/2/16.
 */
Fox.define('views/wechat/person', 'view', function (Dep) {

    return Dep.extend({
        template: 'wechat/person',

        data: function() {
            return {
                avatar: __data__.avatar,
                nickname: __data__.name,
                money: __data__.balances,
                blockedMoney: __data__.blocked_balances, // 冻结余额
                waitOrders: __data__.wait,
                handledOrders: __data__.handled,
                finishedOrders: __data__.finished,

                personalUrl: "/?entryPoint=Personcon", // 个人
                withdrawUrl: "/?entryPoint=Withdraw", // 提现
                allOrdersUrl: "/?entryPoint=Orders", // 全部订单
                waitOrdersUrl: "/?entryPoint=Orders&type=wait", // 待处理订单
                handledOrdersUrl: "/?entryPoint=Orders&type=finished", // 已处理订单
                finishedOrdersUrl: "/?entryPoint=Orders&type=success", // 已完成订单
                incomeUrl: "/?entryPoint=Bill", // 收入详情
                mymemberUrl: "/?entryPoint=fans", // 我的粉丝
                shareUrl: "", // 我的二维码
                shareIncomeUrl: "/?entryPoint=Bill&type=2",// 推广收入
                newsUrl: "", // 我的消息
                homeUrl: "/?entryPoint=Home",
                personUrl: "/?entryPoint=Person", // 个人中心

                css: "/client/css/wechat-mobile.css",

                incomeImg: "",
                rightImg: "http://wx.quantcent.com/assets/images/tou1.png",
                rightImg1: "http://wx.quantcent.com/assets/images/tou.png",
                waitImg: "http://wx.quantcent.com/assets/images/wp.png",
                handledImg: "http://wx.quantcent.com/assets/images/ws.png",
                finishedImg: "http://wx.quantcent.com/assets/images/wr.png",
                homeImg: "http://wx.quantcent.com/assets/images/no_men.png",
                personImg: "http://wx.quantcent.com/assets/images/ren.png",
            }
        },

        setup: function() {

        }
    })
})