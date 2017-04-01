

Fox.define('crm:views/dashlets/activities', ['views/dashlets/abstract/base', 'multi-collection'], function (Dep, MultiCollection) {

    return Dep.extend({

        name: 'Activities',

        _template: '<div class="list-container">{{{list}}}</div>',

        rowActionsView: 'crm:views/meeting/record/row-actions/dashlet',

        scopeList: ['Meeting', 'Call'],

        listLayout: {
            'Meeting': {
                rows: [
                    [
                        {
                            name: 'ico',
                            view: 'crm:views/fields/ico',
                            params: {
                                notRelationship: true
                            }
                        },
                        {
                            name: 'name',
                            link: true,
                        },
                    ],
                    [
                        {name: 'dateStart'}
                    ]
                ]
            },
            'Call': {
                rows: [
                    [
                        {
                            name: 'ico',
                            view: 'crm:views/fields/ico',
                            params: {
                                notRelationship: true
                            }
                        },
                        {
                            name: 'name',
                            link: true,
                        },
                    ],
                    [
                        {name: 'dateStart'}
                    ]
                ]
            }
        },

        setupActionList: function () {
            if (this.getAcl().checkScope('Call', 'create')) {
                this.actionList.unshift({
                    name: 'createCall',
                    html: this.translate('Create Call', 'labels', 'Call'),
                    iconHtml: '<span class="glyphicon glyphicon-plus"></span>'
                });
            }
            if (this.getAcl().checkScope('Meeting', 'create')) {
                this.actionList.unshift({
                    name: 'createMeeting',
                    html: this.translate('Create Meeting', 'labels', 'Meeting'),
                    iconHtml: '<span class="glyphicon glyphicon-plus"></span>'
                });
            }
        },

        setup: function () {
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
            }, this);
        },


        afterRender: function () {
            this.collection = new MultiCollection();
            this.collection.seeds = this.seeds;
            this.collection.url = 'Activities/action/listUpcoming';
            this.collection.maxSize = this.getConfig().get('recordsPerPageSmall') || 5;

            this.listenToOnce(this.collection, 'sync', function () {
                this.createView('list', 'crm:views/meeting/record/list-expanded', {
                    el: this.options.el + ' > .list-container',
                    pagination: false,
                    type: 'list',
                    rowActionsView: this.rowActionsView,
                    checkboxes: false,
                    collection: this.collection,
                    listLayout: this.listLayout,
                }, function (view) {
                    view.render();
                });
            }, this);

            this.collection.fetch();
        },

        actionRefresh: function () {
            this.collection.fetch();
        },

        actionCreateMeeting: function () {
            var attributes = {};

            this.notify('Loading...');
            var viewName = this.getMetadata().get('clientDefs.Meeting.modalViews.edit') || 'views/modals/edit';
            this.createView('quickCreate', viewName, {
                scope: 'Meeting',
                attributes: attributes,
            }, function (view) {
                view.render();
                view.notify(false);
                this.listenToOnce(view, 'after:save', function () {
                    this.actionRefresh();
                }, this);
            }.bind(this));
        },

        actionCreateCall: function () {
            var attributes = {};

            this.notify('Loading...');
            var viewName = this.getMetadata().get('clientDefs.Call.modalViews.edit') || 'views/modals/edit';
            this.createView('quickCreate', viewName, {
                scope: 'Call',
                attributes: attributes,
            }, function (view) {
                view.render();
                view.notify(false);
                this.listenToOnce(view, 'after:save', function () {
                    this.actionRefresh();
                }, this);
            }.bind(this));
        }
    });
});

