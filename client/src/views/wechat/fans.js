/**
 * Created by jqh on 2017/2/22.
 */
Fox.define('views/wechat/fans', 'view', function (Dep) {
    return Dep.extend({
        template: 'wechat/fans',

        __data: null,

        views: {
            rows: {
                el: "#wechat_list",
                view: 'views/wechat/fans-rows'
            }
        },

        setup: function() {
            this.__data = __data__
        },

        data: function() {
            return {
                css: '/client/css/wechat-mobile.css',

                total: __data__.total,

                personUrl: "/?entryPoint=Person",
                homeUrl: "/?entryPoint=Home",

                homeImg: "http://wx.quantcent.com/assets/images/no_men.png",
                personImg: "http://wx.quantcent.com/assets/images/ren.png",
            }
        },
    })
})
