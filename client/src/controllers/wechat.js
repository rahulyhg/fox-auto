/**
 * Created by jqh on 2017/2/16.
 */
Fox.define('controllers/wechat', ['controller'], function (Dep) {
    return Dep.extend({
        // 抢单首页
        home: function() {
            this.entire('Company.Wxhome', null, function(view) {
                view.render()
            });
        },
        // 抢单详情界面
        grab: function() {
            this.entire('Company.Wxorder', null, function(view) {
                view.render()
            });
        },
        // 个人
        person: function() {
             this.entire('views/wechat/person', null, function(view) {
                 view.render()
             });
            //console.log(123)
        },
        // 个人信息页面
        personcon: function() {
            this.entire('views/wechat/personcon', null, function(view) {
                view.render()
            });
        },

        // 提现界面
        withdraw: function() {
            this.entire('views/wechat/withdraw', null, function(view) {
                view.render()
            });
        },

        // 订单
        orders: function() {
            this.entire('views/wechat/orders', null, function(view) {
                view.render()
            });
        },

        bill: function() {
            this.entire('views/wechat/bill', null, function(view) {
                view.render()
            })
        },

        fans: function() {
            this.entire('views/wechat/fans', null, function(view) {
                view.render()
            })
        },
        // 二维码
        qr: function() {
            this.entire('views/wechat/qr', null, function(view) {
                view.render()
            })
        },
        // 购买流量订单
        buy: function() {
            this.entire('views/wechat/buy', null, function(view) {
                view.render()
            })
        },
    })
})