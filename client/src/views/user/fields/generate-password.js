
Fox.define('views/user/fields/generate-password', 'views/fields/base', function (Dep) {

    return Dep.extend({

        _template: '<button type="button" class="btn" data-action="generatePassword">{{translate \'Generate\' scope=\'User\'}}</button>',

        events: {
            'click [data-action="generatePassword"]': function () {
                var password = Math.random().toString(36).slice(-8);

                this.model.set({
                    password: password,
                    passwordConfirm: password
                });
            }
        },

        fetch: function () {
            return {};
        }

    });

});
