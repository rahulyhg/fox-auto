

Fox.define('crm:views/record/panels/history', 'crm:views/record/panels/activities', function (Dep) {

    return Dep.extend({

        name: 'history',

        scopeList: ['Meeting', 'Call', 'Email'],

        sortBy: 'dateStart',

        asc: false,

        rowActionsView: 'crm:views/record/row-actions/history',

        actionList: [
            {
                action: 'createActivity',
                label: 'Log Meeting',
                data: {
                    link: 'meetings',
                    status: 'Held',
                },
                acl: 'create',
                aclScope: 'Meeting',
            },
            {
                action: 'createActivity',
                label: 'Log Call',
                data: {
                    link: 'calls',
                    status: 'Held',
                },
                acl: 'create',
                aclScope: 'Call',
            },
            {
                action: 'archiveEmail',
                label: 'Archive Email',
                acl: 'create',
                aclScope: 'Email',
            },
        ],

        listLayout: {
            'Meeting': {
                rows: [
                    [
                        {name: 'ico', view: 'Crm:Fields.Ico'},
                        {
                            name: 'name',
                            link: true,
                        },
                        {name: 'status'},
                    ],
                    [
                        {name: 'assignedUser'},
                        {name: 'dateStart'},
                    ]
                ]
            },
            'Call': {
                rows: [
                    [
                        {name: 'ico', view: 'Crm:Fields.Ico'},
                        {
                            name: 'name',
                            link: true,
                        },
                        {name: 'status'},
                    ],
                    [
                        {name: 'assignedUser'},
                        {name: 'dateStart'},
                    ]
                ]
            },
            'Email': {
                rows: [
                    [
                        {name: 'ico', view: 'Crm:Fields.Ico'},
                        {
                            name: 'name',
                            link: true,
                        },
                    ],
                    [
                        {name: 'status'},
                        {name: 'dateSent'},
                    ]
                ]
            },
        },

        where: {
            scope: false,
        },

        getArchiveEmailAttributes: function (data, callback) {
            data = data || {};
            var attributes = {
                dateSent: this.getDateTime().getNow(15),
                status: 'Archived',
                from: this.model.get('emailAddress'),
                to: this.getUser().get('emailAddress')
            };

            if (this.model.name == 'Contact') {
                if (this.model.get('accountId')) {
                    attributes.parentType = 'Account',
                    attributes.parentId = this.model.get('accountId');
                    attributes.parentName = this.model.get('accountName');
                }
            } else if (this.model.name == 'Lead') {
                attributes.parentType = 'Lead',
                attributes.parentId = this.model.id
                attributes.parentName = this.model.get('name');
            }
            callback.call(this, attributes);
        },

        actionArchiveEmail: function (data) {
            var self = this;
            var link = 'emails';
            var scope = 'Email';

            var relate = null;
            if ('emails' in this.model.defs['links']) {
                relate = {
                    model: this.model,
                    link: this.model.defs['links']['emails'].foreign
                };
            }

            this.notify('Loading...');

            var viewName = this.getMetadata().get('clientDefs.' + scope + '.modalViews.edit') || 'views/modals/edit';

            this.getArchiveEmailAttributes(data, function (attributes) {
                this.createView('quickCreate', viewName, {
                    scope: scope,
                    relate: relate,
                    attributes: attributes
                }, function (view) {
                    view.render();
                    view.notify(false);
                    this.listenToOnce(view, 'after:save', function () {
                        this.collection.fetch();
                        this.model.trigger('after:relate');
                    }, this);
                });
            });
        },

        actionReply: function (data) {
            var id = data.id;
            if (!id) {
                return;
            }

            Fox.require('EmailHelper', function (EmailHelper) {
                var emailHelper = new EmailHelper(this.getLanguage(), this.getUser());

                this.notify('Please wait...');

                this.getModelFactory().create('Email', function (model) {
                    model.id = id;
                    this.listenToOnce(model, 'sync', function () {
                        var attributes = emailHelper.getReplyAttributes(model, data, this.getPreferences().get('emailReplyToAllByDefault'));
                        var viewName = this.getMetadata().get('clientDefs.Email.modalViews.compose') || 'views/modals/compose-email';
                        this.createView('quickCreate', viewName, {
                            attributes: attributes,
                        }, function (view) {
                            view.render(function () {
                                view.getView('edit').hideField('selectTemplate');
                            });

                            this.listenToOnce(view, 'after:save', function () {
                                this.collection.fetch();
                                this.model.trigger('after:relate');
                            }, this);

                            view.notify(false);
                        }.bind(this));
                    }, this);
                    model.fetch();
                }, this);
            }, this);
        }
    });
});

