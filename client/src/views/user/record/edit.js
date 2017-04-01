

Fox.define('views/user/record/edit', ['views/record/edit', 'views/user/record/detail'], function (Dep, Detail) {

    return Dep.extend({

        sideView: 'views/user/record/edit-side',

        setup: function () {
            Dep.prototype.setup.call(this);

            if (this.model.id == this.getUser().id) {
                this.listenTo(this.model, 'after:save', function () {
                    this.getUser().set(this.model.toJSON());
                }, this);
            }

            this.hideField('sendAccessInfo');

            var passwordChanged = false;

            this.listenToOnce(this.model, 'change:password', function (model) {
                passwordChanged = true;
                if (model.get('emailAddress')) {
                    this.showField('sendAccessInfo');
                    this.model.set('sendAccessInfo', true);
                }
            }, this);

            this.listenTo(this.model, 'change:emailAddress', function (model) {
                if (passwordChanged) {
                    if (model.get('emailAddress')) {
                        this.showField('sendAccessInfo');
                        this.model.set('sendAccessInfo', true);
                    } else {
                        this.hideField('sendAccessInfo');
                        this.model.set('sendAccessInfo', false);
                    }
                }
            }, this);

            Detail.prototype.setupFieldAppearance.call(this);
        },

        controlFieldAppearance: function () {
            Detail.prototype.controlFieldAppearance.call(this);
        },

        getGridLayout: function (callback) {

            var self = this;

            this._helper.layoutManager.get(this.model.name, this.options.layoutName || this.layoutName, function (simpleLayout) {

                var layout = _.clone(simpleLayout);

                if (this.type == 'edit') {
                    layout.push({
                        label: 'Password',
                        rows: [
                            [
                                {
                                    name: 'password',
                                    type: 'password',
                                    params: {
                                        required: self.isNew,
                                        readyToChange: true
                                    }
                                },
                                {
                                    name: 'generatePassword',
                                    view: 'views/user/fields/generate-password',
                                    customLabel: ''
                                }
                            ],
                            [
                                {
                                    name: 'passwordConfirm',
                                    type: 'password',
                                    params: {
                                        required: self.isNew,
                                        readyToChange: true
                                    }
                                },
                                {
                                    name: 'passwordInfo',
                                    customLabel: '',
                                    customCode: '{{translate "passwordWillBeSent" scope="User" category="messages"}}'
                                }
                            ],
                            [
                                {
                                    name: 'sendAccessInfo'
                                },
                                false
                            ]
                        ]
                    });
                }

                var gridLayout = {
                    type: 'record',
                    layout: this.convertDetailLayout(layout),
                };

                callback(gridLayout);
            }.bind(this));
        },

        fetch: function () {
            var data = Dep.prototype.fetch.call(this);

            if (!this.isNew) {
                if ('password' in data) {
                    if (data['password'] == '') {
                        delete data['password'];
                        delete data['passwordConfirm'];
                        this.model.unset('password');
                        this.model.unset('passwordConfirm');
                    }
                }
            }

            return data;
        }

    });

});

