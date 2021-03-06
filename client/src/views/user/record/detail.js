

Fox.define('views/user/record/detail', 'views/record/detail', function (Dep) {

    return Dep.extend({

        sideView: 'views/user/record/detail-side',

        bottomView: 'views/user/record/detail-bottom',

        editModeDisabled: true,

        setup: function () {
            Dep.prototype.setup.call(this);

            if (this.model.id == this.getUser().id || this.getUser().isAdmin()) {
                if (!this.model.get('isPortalUser')) {
                    this.buttonList.push({
                        name: 'access',
                        label: 'Access',
                        style: 'default'
                    });
                }

                if (this.model.id == this.getUser().id) {
                    this.dropdownItemList.push({
                        name: 'changePassword',
                        label: 'Change Password',
                        style: 'default'
                    });
                }
            }

            if (this.model.id == this.getUser().id) {
                this.listenTo(this.model, 'after:save', function () {
                    this.getUser().set(this.model.toJSON());
                }.bind(this));
            }

            this.setupFieldAppearance();
        },

        setupFieldAppearance: function () {
            this.controlFieldAppearance();
            this.listenTo(this.model, 'change', function () {
                this.controlFieldAppearance();
            }, this);

            var isAdminView = this.getFieldView('isAdmin');
            if (isAdminView) {
                this.listenTo(isAdminView, 'change', function () {
                    if (this.model.get('isAdmin')) {
                        this.model.set('isPortalUser', false, {silent: true});
                    }
                }, this);
            }
        },

        controlFieldAppearance: function () {
            if (this.model.get('isAdmin')) {
                this.hideField('isPortalUser');
            } else {
                this.showField('isPortalUser');
            }

            if (this.model.get('isPortalUser')) {
                this.hideField('isAdmin');
                this.hideField('roles');
                this.hideField('teams');
                this.hideField('defaultTeam');
                this.showField('portals');
                this.showField('portalRoles');
                this.showField('contact');
                this.showField('accounts');
                this.showPanel('portal');
                this.hideField('title');
            } else {
                this.showField('isAdmin');
                this.showField('roles');
                this.showField('teams');
                this.showField('defaultTeam');
                this.hideField('portals');
                this.hideField('portalRoles');
                this.hideField('contact');
                this.hideField('accounts');
                this.hidePanel('portal');
                this.showField('title');
            }
        },

        actionChangePassword: function () {
            this.notify('Loading...');

            this.createView('changePassword', 'views/modals/change-password', {
                userId: this.model.id
            }, function (view) {
                view.render();
                this.notify(false);

                this.listenToOnce(view, 'changed', function () {
                    setTimeout(function () {
                        this.getBaseController().logout();
                    }.bind(this), 2000);
                }, this);

            }.bind(this));
        },

        actionPreferences: function () {
            this.getRouter().navigate('#Preferences/edit/' + this.model.id, {trigger: true});
        },

        actionEmailAccounts: function () {
            this.getRouter().navigate('#EmailAccount/list/userId=' + this.model.id, {trigger: true});
        },

        actionExternalAccounts: function () {
            this.getRouter().navigate('#ExternalAccount', {trigger: true});
        },

        actionAccess: function () {
            this.notify('Loading...');

            $.ajax({
                url: 'User/action/acl',
                type: 'GET',
                data: {
                    id: this.model.id,
                }
            }).done(function (aclData) {
                this.createView('access', 'views/user/modals/access', {
                    aclData: aclData,
                    model: this.model,
                }, function (view) {
                    this.notify(false);
                    view.render();
                }.bind(this));
            }.bind(this));
        }

    });

});

