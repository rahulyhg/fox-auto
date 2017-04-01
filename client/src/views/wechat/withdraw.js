/**
 * Created by jqh on 2017/2/17.
 */
Fox.define('views/wechat/withdraw', 'view', function (Dep) {

    return Dep.extend({
        template: 'wechat/withdraw',

        // 提现金额
        money: 0,

        events: {
            'click .enchashment': function(e) {
                console.log(9999, this.money)
                if (this.money < 1) {
                    return
                }

            },
            // 输入框
            'keyup .cont': function(e) {
                this.money = $(e.currentTarget).val()
                this.money = (this.money.match(/\d+(\.\d{0,4})?/)||[''])[0]
                if (this.money < 1) {
                    this.$enchashment.addClass('disable')
                    return
                }

                this.$enchashment.removeClass('disable')
            }
        },

        data: function() {
            if (__data__.msg) {
                alert(__data__.msg)
            }

            return {
                css: "/client/css/wechat-mobile.css",

                money: __data__.balances,
                list: __data__.rows,
                statusL: {1: "审核中", 2: "审核不通过", 3: "提现成功"},
            }
        },

        setup: function() {

        },

        afterRender: function() {
            this.$enchashment = $('.enchashment')
        },

    })
})
