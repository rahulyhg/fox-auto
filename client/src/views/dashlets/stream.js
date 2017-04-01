

Fox.define('views/dashlets/stream', 'views/dashlets/abstract/base', function (Dep) {

    return Dep.extend({

        name: 'Stream',

        _template: '<div class="list-container">{{{list}}}</div>',

        actionRefresh: function () {
            this.getView('list').showNewRecords();
        },

        afterRender: function () {
            this.getCollectionFactory().create('Note', function (collection) {
                this.collection = collection;

                collection.url = 'Stream';
                collection.maxSize = this.getOption('displayRecords');

                this.listenToOnce(collection, 'sync', function () {
                    this.createView('list', 'views/stream/record/list', {
                        el: this.options.el + ' > .list-container',
                        collection: collection,
                        isUserStream: true,
                        noEdit: false,
                    }, function (view) {
                        view.render();
                    });
                }.bind(this));
                collection.fetch();

            }, this);
        },

        setupActionList: function () {
            this.actionList.unshift({
                name: 'viewList',
                html: this.translate('View List'),
                iconHtml: '<span class="glyphicon glyphicon glyphicon-th-list"></span>'
            });
            this.actionList.unshift({
                name: 'create',
                html: this.translate('Create Post', 'labels'),
                iconHtml: '<span class="glyphicon glyphicon-plus"></span>'
            });
        },

        actionCreate: function () {
            this.createView('dialog', 'views/stream/modals/create-post', {}, function (view) {
                view.render();
                this.listenToOnce(view, 'after:save', function () {
                    view.close();
                    this.actionRefresh();
                }, this);
            }, this)
        },

        actionViewList: function () {
            this.getRouter().navigate('#Stream', {trigger: true});
        }

    });
});


