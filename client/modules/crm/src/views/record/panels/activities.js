

Fox.define('crm:views/record/panels/activities', ['views/record/panels/relationship', 'multi-collection'], function (Dep, MultiCollection) {

    return Dep.extend({

        name: 'activities',

        template: 'crm:record/panels/activities',

        scopeList: ['Meeting', 'Call'],

        sortBy: 'dateStart',

        serviceName: 'Activities',

        asc: false,

        rowActionsView: 'crm:views/record/row-actions/activities',

        actionList: [
            {
                action: 'createActivity',
                label: 'Schedule Meeting',
                data: {
                    link: 'meetings',
                    status: 'Planned',
                },
                acl: 'create',
                aclScope: 'Meeting',
            },
            {
                action: 'createActivity',
                label: 'Schedule Call',
                data: {
                    link: 'calls',
                    status: 'Planned',
                },
                acl: 'create',
                aclScope: 'Call',
            },
            {
                action: 'composeEmail',
                label: 'Compose Email',
                acl: 'create',
                aclScope: 'Email',
            }
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
                    ],
                    [
                        {name: 'assignedUser'},
                        {name: 'dateStart'},
                    ]
                ]
            }
        },

        currentScope: false,

        events: _.extend({
            'click button.scope-switcher': function (e) {
                var $target = $(e.currentTarget);
                this.$el.find('button.scope-switcher').removeClass('active');
                $target.addClass('active');
                this.currentScope = $target.data('scope') || false;

                this.collection.where = [this.currentScope];

                this.listenToOnce(this.collection, 'sync', function () {
                    this.notify(false);
                }.bind(this));
                this.notify('Loading...');
                this.collection.fetch();

                this.currentTab = this.currentScope || 'all';
                this.getStorage().set('state', this.getStorageKey(), this.currentTab);
            }
        }, Dep.prototype.events),

        data: function () {
            return {
                currentTab: this.currentTab,
                scopeList: this.scopeList,
                tabList: this.tabList
            };
        },

        getStorageKey: function () {
            return 'activities-' + this.model.name + '-' + this.name;
        },

        setup: function () {

            this.currentTab = this.getStorage().get('state', this.getStorageKey()) || 'all';

            if (this.currentTab != 'all') {
                this.currentScope = this.currentTab;
            }

            this.seeds = {};

            this.wait(true);
            var i = 0;
            this.scopeList.forEach(function (scope) {
                this.getModelFactory().getSeed(scope, function (seed) {
                    this.seeds[scope] = seed;
                    i++;
                    if (i == this.scopeList.length) {
                        this.wait(false);
                    }
                }.bind(this));
            }.bind(this));
            if (this.scopeList.length == 0) {
                this.wait(false);
            }


            this.tabList = [];
            this.scopeList.forEach(function (item) {
                if (this.getAcl().check(item)) {
                    this.tabList.push(item);
                }
            }, this);
        },

        afterRender: function () {
            var url = this.serviceName + '/' + this.model.name + '/' + this.model.id + '/' + this.name;

            this.collection = new MultiCollection();
            this.collection.seeds = this.seeds;
            this.collection.url = url;
            this.collection.where = [this.currentScope];
            this.collection.sortBy = this.sortBy;
            this.collection.asc = this.asc;
            this.collection.maxSize = this.getConfig().get('recordsPerPageSmall') || 5;


            this.listenToOnce(this.collection, 'sync', function () {
                this.createView('list', 'views/record/list-expanded', {
                    el: this.$el.selector + ' > .list-container',
                    pagination: false,
                    type: 'listRelationship',
                    rowActionsView: this.rowActionsView,
                    checkboxes: false,
                    collection: this.collection,
                    listLayout: this.listLayout,
                }, function (view) {
                    view.render();
                });
            }, this);

            if (!this.defs.hidden) {
                this.collection.fetch();
            }
        },

        fetchHistory: function () {
            if (this.name == 'history') return;
            var parentView = this.getParentView();
            if (parentView) {
                if (parentView.hasView('history')) {
                    var historyCollection = parentView.getView('history').collection;
                    if (historyCollection) {
                        historyCollection.fetch();
                    }
                }
            }
        },

        getCreateActivityAttributes: function (data, callback) {
            data = data || {};

            var attributes = {
                status: data.status
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
            if (this.model.name != 'Account' && this.model.has('contactsIds')) {
                attributes.contactsIds = this.model.get('contactsIds');
                attributes.contactsNames = this.model.get('contactsNames');
            }

            if (this.model.name == 'User') {
                attributes.assignedUserId = this.model.id;
                attributes.assignedUserName = this.model.get('name');
            }

            callback.call(this, attributes);
        },

        actionCreateActivity: function (data) {
            var self = this;
            var link = data.link;
            var scope = this.model.defs['links'][link].entity;
            var foreignLink = this.model.defs['links'][link].foreign;

            this.notify('Loading...');

            var viewName = this.getMetadata().get('clientDefs.' + scope + '.modalViews.edit') || 'views/modals/edit';

            this.getCreateActivityAttributes(data, function (attributes) {
                this.createView('quickCreate', viewName, {
                    scope: scope,
                    relate: {
                        model: this.model,
                        link: foreignLink,
                    },
                    attributes: attributes,
                }, function (view) {
                    view.render();
                    view.notify(false);
                    this.listenToOnce(view, 'after:save', function () {
                        this.model.trigger('after:relate');
                        this.collection.fetch();
                        this.fetchHistory();
                    }, this);
                }, this);
            });

        },

        getComposeEmailAttributes: function (data, callback) {
            data = data || {};
            var attributes = {
                status: 'Draft',
                to: this.model.get('emailAddress')
            };
            callback.call(this, attributes);
        },

        actionComposeEmail: function () {
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

            this.getComposeEmailAttributes(null, function (attributes) {
                if (this.model.name == 'Contact') {
                    if (this.getConfig().get('b2cMode')) {
                        attributes.parentType = 'Contact';
                        attributes.parentName = this.model.get('name');
                        attributes.parentId = this.model.id;
                    } else {
                        if (this.model.get('accountId')) {
                            attributes.parentType = 'Account',
                            attributes.parentId = this.model.get('accountId');
                            attributes.parentName = this.model.get('accountName');
                        }
                    }
                } else if (this.model.name == 'Lead') {
                    attributes.parentType = 'Lead',
                    attributes.parentId = this.model.id
                    attributes.parentName = this.model.get('name');
                }
                if (~['Contact', 'Lead', 'Account'].indexOf(this.model.name) && this.model.get('emailAddress')) {
                    attributes.nameHash = {};
                    attributes.nameHash[this.model.get('emailAddress')] = this.model.get('name');
                }

                this.createView('quickCreate', 'views/modals/compose-email', {
                    relate: relate,
                    attributes: attributes
                }, function (view) {
                    view.render();
                    view.notify(false);
                    this.listenToOnce(view, 'after:save', function () {
                        this.collection.fetch();
                        this.model.trigger('after:relate');
                        this.fetchHistory();
                    }, this);
                }, this);
            });

        },

        actionRefresh: function () {
            this.collection.fetch();
        },

        actionSetHeld: function (data) {
            var id = data.id;
            if (!id) {
                return;
            }
            var model = this.collection.get(id);
            model.save({
                status: 'Held'
            }, {
                patch: true,
                success: function () {
                    this.collection.fetch();
                    this.fetchHistory();
                }.bind(this)
            });
        },

        actionSetNotHeld: function (data) {
            var id = data.id;
            if (!id) {
                return;
            }
            var model = this.collection.get(id);
            model.save({
                status: 'Not Held'
            }, {
                patch: true,
                success: function () {
                    this.collection.fetch();
                    this.fetchHistory();
                }.bind(this)
            });
        },
    });
});

