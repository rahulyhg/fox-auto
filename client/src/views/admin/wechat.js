
Fox.define('views/admin/wechat', 'view', function (Dep) {

    return Dep.extend({

        template: 'admin/wechat',

        detailValue: null,

        data: function () {
            return {
                data: this.detailValue
            };
        },

        events: {
            'click .button-container .action': function (e) {
                var $target = $(e.currentTarget);
                var action = $target.data('action');
                var data = $target.data();
                if (action) {
                    var method = 'action' + Fox.Utils.upperCaseFirst(action);
                    if (typeof this[method] == 'function') {
                        this[method].call(this, data, e);
                        e.preventDefault();
                    }
                }
            },
        },

        setup: function () {
            //var companyId = this.getUser().get( 'companyId');
            var companyId = "1";
            this.wait(true);
            $.ajax({
                url: 'Admin/action/Wechat?q=' + companyId,
                success: function (data) {
                    this.detailValue = data;
                    this.wait(false);
                }.bind(this)
            });
        },

        actionSave: function () {

            var dispatch_mode = this.$el.find('select[name="dispatch_mode"]').val();
            var session_time = this.$el.find('input[name="session_time"]').val();
            var welcome_msg = this.$el.find('input[name="welcome_msg"]').val();
            var end_msg = this.$el.find('input[name="end_msg"]').val();
            var reply_mode = this.$el.find('select[name="reply_mode"]').val();
            var tp_appid = this.$el.find('input[name="tp_appid"]').val();
            var tp_token = this.$el.find('input[name="tp_token"]').val();
            var tp_account = this.$el.find('input[name="tp_account"]').val();
            var tp_encoding_aes_key = this.$el.find('input[name="tp_encoding_aes_key"]').val();
            var qy_corpid = this.$el.find('input[name="qy_corpid"]').val();
            var qy_secret = this.$el.find('input[name="qy_secret"]').val();
            var qy_token = this.$el.find('input[name="qy_token"]').val();
            var qy_encoding_aes_key = this.$el.find('input[name="qy_encoding_aes_key"]').val();

            var data = {
                "dispatch_mode": dispatch_mode,
                "session_time": session_time,
                "welcome_msg": welcome_msg,
                "end_msg": end_msg,
                "reply_mode": reply_mode,
                "tp_appid": reply_mode,
                "tp_token": tp_token,
                "tp_account": tp_account,
                "tp_encoding_aes_key": tp_encoding_aes_key,
                "qy_corpid": qy_corpid,
                "qy_secret": qy_secret,
                "qy_token": qy_token,
                "qy_encoding_aes_key": qy_encoding_aes_key,
            };

            $.ajax({
                url: 'Admin/action/Wechat',
                timeout: 0,
                type: 'POST',
                data: JSON.stringify(data),
                success: function (result) {
                    alert('保存成功');
                    this.getRouter().navigate('#Admin', {trigger: true});
                }.bind(this)
            });
        },

        updatePageTitle: function () {
            this.setPageTitle(this.getLanguage().translate('微信设置'));
        },

    });
});
