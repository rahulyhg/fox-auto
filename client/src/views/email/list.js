

Fox.define('views/email/list', 'views/list', function (Dep) {

    return Dep.extend({

        createButton: false,

        setup: function () {
            Dep.prototype.setup.call(this);

            if (this.getUser().isAdmin()) {
                this.menu.dropdown.push({
                    link: '#InboundEmail',
                    label: 'Inbound Emails'
                });
            }
        },

        actionComposeEmail: function () {
            this.notify('Loading...');
            var viewName = this.getMetadata().get('clientDefs.Email.modalViews.compose') || 'views/modals/compose-email';
            this.createView('quickCreate', viewName, {
                attributes: {
                    status: 'Draft'
                }
            }, function (view) {
                view.render();
                view.notify(false);
                this.listenToOnce(view, 'after:save', function () {
                    this.collection.fetch();
                }, this);
            }, this);
        },

    });
});

