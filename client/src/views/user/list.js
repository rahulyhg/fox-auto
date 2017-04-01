

Fox.define('views/user/list', 'views/list', function (Dep) {

    return Dep.extend({

        setup: function () {
            Dep.prototype.setup.call(this);

            if (this.getUser().isAdmin()) {
                this.addMenuItem('dropdown', {
                    name: 'createPortalUser',
                    label: 'Create Portal User'
                });
            }
        },

        actionCreatePortalUser: function () {
            var viewName = this.getMetadata().get('clientDefs.Contact.modalViews.select') || 'views/modals/select-records';

            this.createView('modal', viewName, {
                scope: 'Contact',
                primaryFilterName: 'notPortalUsers',
                createButton: false
            }, function (view) {
                view.render();

                this.listenToOnce(view, 'select', function (model) {
                    var attributes = {};

                    attributes.contactId = model.id;
                    attributes.contactName = model.get('name');

                    if (model.has('accountId')) {
                        var names = {};
                        names[model.get('accountId')] = model.get('accountName');

                        attributes.accountsIds = [model.get('accountId')];
                        attributes.accountsNames = names;
                    }

                    attributes.firstName = model.get('firstName');
                    attributes.lastName = model.get('lastName');
                    attributes.salutationName = model.get('salutationName');

                    attributes.emailAddress = model.get('emailAddress');
                    attributes.emailAddressData = model.get('emailAddressData');

                    attributes.phoneNumber = model.get('phoneNumber');
                    attributes.phoneNumberData = model.get('phoneNumberData');

                    attributes.userName = attributes.emailAddress;

                    attributes.isPortalUser = true;

                    var router = this.getRouter();

                    var url = '#' + this.scope + '/create';

                    router.dispatch(this.scope, 'create', {
                        attributes: attributes
                    });
                    router.navigate(url, {trigger: false});
                }, this);
            }, this);
        },

    });
});

