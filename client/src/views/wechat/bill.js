/**
 * Created by jqh on 2017/2/21.
 */
Fox.define('views/wechat/bill', 'view', function (Dep) {
    return Dep.extend({
        template: 'wechat/bill',

        views: {
            rows: {
                el: "#wechat_list",
                view: 'views/wechat/bill-rows'
            }
        },

        setup: function() {

        },

        data: function() {
            return {
                css: '/client/css/wechat-mobile.css',

                total: __data__.total,
                rows: __data__.rows,

                personUrl: "/?entryPoint=Person",
                homeUrl: "/?entryPoint=Home",

                homeImg: "http://wx.quantcent.com/assets/images/no_men.png",
                personImg: "http://wx.quantcent.com/assets/images/ren.png",
            }

        },

        afterRender: function() {

        },
    })
})
