

Fox.define('views/record/list-tree', 'views/record/list', function (Dep) {

    return Dep.extend({

        template: 'record/list-tree',

        showMore: false,

        showCount: false,

        checkboxes: false,

        rowActionsView: false,

        presentationType: 'tree',

        header: false,

        listContainerEl: ' > .list > ul',

        checkAllResultDisabled: true,

        showRoot: false,

        massActionList: ['remove'],

        selectable: false,

        createDisabled: false,

        selectedData: null,

        level: 0,

        itemViewName: 'views/record/list-tree-item',

        data: function () {
            var data = Dep.prototype.data.call(this);
            data.createDisabled = this.createDisabled;
            data.showRoot = this.showRoot;
            if (data.showRoot) {
                data.rootName = this.rootName || this.translate('Root');
            }

            data.showEditLink = this.showEditLink;

            if (this.level == 0 && this.selectable && !(this.selectedData || {}).id) {
                data.rootIsSelected = true;
            }

            return data;
        },

        setup: function () {
            if ('selectable' in this.options) {
                this.selectable = this.options.selectable;
            }

            this.createDisabled = this.options.createDisabled || this.createDisabled;

            if ('showRoot' in this.options) {
                this.showRoot = this.options.showRoot;
                if ('rootName' in this.options) {
                    this.rootName = this.options.rootName;
                }
            }

            if ('showRoot' in this.options) {
                this.showEditLink = this.options.showEditLink;
            }

            if ('level' in this.options) {
                this.level = this.options.level;
            }
            if (this.level == 0) {
                this.selectedData = {
                    id: null,
                    path: [],
                    names: {}
                };
            }
            if ('selectedData' in this.options) {
                this.selectedData = this.options.selectedData;
            }
            Dep.prototype.setup.call(this);

            if (this.selectable) {
                this.on('select', function (o) {
                    if (o.id) {
                        this.$el.find('a.link[data-id="'+o.id+'"]').addClass('text-bold');

                        if (this.level == 0) {
                            this.$el.find('a.link').removeClass('text-bold');
                            this.$el.find('a.link[data-id="'+o.id+'"]').addClass('text-bold');

                            this.setSelected(o.id);
                            o.selectedData = this.selectedData;
                        }
                    }
                    if (this.level > 0) {
                        this.getParentView().trigger('select', o);
                    }
                }, this);
            }
        },

        setSelected: function (id) {
            if (id === null) {
                this.selectedData.id = null;
            }
            this.rowList.forEach(function (key) {
                var view = this.getView(key);

                if (view.model.id == id) {
                    view.setIsSelected();
                } else {
                    view.isSelected = false;
                }
                if (view.hasView('children')) {
                    view.getView('children').setSelected(id);
                }
            }, this);
        },

        buildRows: function (callback) {
            this.checkedList = [];
            this.rowList = [];

            if (this.collection.length > 0) {
                this.wait(true);

                var modelList = this.collection.models;
                var count = modelList.length;
                var built = 0;
                modelList.forEach(function (model, i) {
                    this.rowList.push('row-' + i);
                    this.createView('row-' + i, this.itemViewName, {
                        model: model,
                        collection: this.collection,
                        el: this.options.el + ' ' + this.getRowSelector(model.id),
                        createDisabled: this.createDisabled,
                        level: this.level,
                        isSelected: model.id == this.selectedData.id,
                        selectedData: this.selectedData,
                        selectable: this.selectable
                    }, function () {
                        built++;
                        if (built == count) {
                            if (typeof callback == 'function') {
                                callback();
                            }
                            this.wait(false);
                        };
                    }.bind(this));
                }, this);

            } else {
                if (typeof callback == 'function') {
                    callback();
                }
            }
        },

        getRowSelector: function (id) {
            return 'li[data-id="' + id + '"]';
        },

        getItemEl: function (model, item) {
            return this.options.el + ' li[data-id="' + model.id + '"] span.cell-' + item.name;
        },

        getCreateAttributes: function () {
            return {};
        },

        actionCreate: function (data, e) {
            e.stopPropagation();

            var attributes = this.getCreateAttributes();

            attributes.order = this.collection.length + 1;
            attributes.parentId = null;
            attributes.parentName = null;

            if (this.model) {
                attributes.parentId = this.model.id;
                attributes.parentName = this.model.get('name');
            }

            var scope = this.collection.name;

            var viewName = this.getMetadata().get('clientDefs.' + scope + '.modalViews.edit') || 'Modals.Edit';
            this.createView('quickCreate', viewName, {
                scope: scope,
                attributes: attributes
            }, function (view) {
                view.render();
                this.listenToOnce(view, 'after:save', function (model) {
                    view.close();
                    model.set('childCollection', this.collection.createSeed());
                    this.collection.push(model);
                    this.buildRows(function () {
                        this.render();
                    }.bind(this));
                }, this);
            }.bind(this));
        },

        actionSelectRoot: function () {
            this.trigger('select', {id: null});
            if (this.selectable) {
                this.$el.find('a.link').removeClass('text-bold');
                this.$el.find('a.link[data-action="selectRoot"]').addClass('text-bold');
                this.setSelected(null);
            }
        }

    });
});

