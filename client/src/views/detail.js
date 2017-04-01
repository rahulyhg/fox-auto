

Fox.define('views/detail', 'views/main', function (Dep) {

    return Dep.extend({

        template: 'detail',

        el: '#main',

        scope: null,

        name: 'Detail',

        optionsToPass: ['attributes', 'returnUrl', 'returnDispatchParams'],

        headerView: 'views/header',

        recordView: 'views/record/detail',

        addUnfollowButtonToMenu: function () {
            this.removeMenuItem('follow', true);

            this.addMenuItem('buttons', {
                name: 'unfollow',
                label: 'Followed',
                style: 'success',
                action: 'unfollow'
            }, true);
        },

        addFollowButtonToMenu: function () {
            this.removeMenuItem('unfollow', true);

            this.addMenuItem('buttons', {
                name: 'follow',
                label: 'Follow',
                style: 'default',
                icon: 'glyphicon glyphicon-share-alt',
                html: '<span class="glyphicon glyphicon-share-alt"></span> ' + this.translate('Follow'),
                action: 'follow'
            }, true);
        },

        setup: function () {
            Dep.prototype.setup.call(this);

            this.headerView = this.options.headerView || this.headerView;
            this.recordView = this.options.recordView || this.recordView;

            this.setupHeader();
            this.setupRecord();

            if (this.getMetadata().get('scopes.' + this.scope + '.stream')) {
                if (this.model.has('isFollowed')) {
                    this.handleFollowButton();
                }

                this.listenTo(this.model, 'change:isFollowed', function () {
                    this.handleFollowButton();
                }, this);
            }
        },

        setupHeader: function () {
            this.createView('header', this.headerView, {
                model: this.model,
                el: '#main > .header'
            });
        },

        setupRecord: function () {
            var o = {
                model: this.model,
                el: '#main > .record'
            };
            this.optionsToPass.forEach(function (option) {
                o[option] = this.options[option];
            }, this);
            this.createView('record', this.getRecordViewName(), o);
        },

        getRecordViewName: function () {
            return this.getMetadata().get('clientDefs.' + this.scope + '.recordViews.detail') || this.recordView;
        },

        handleFollowButton: function () {
            if (this.model.get('isFollowed')) {
                this.addUnfollowButtonToMenu();
            } else {
                if (this.getAcl().checkModel(this.model, 'stream')) {
                    this.addFollowButtonToMenu();
                }
            }
        },

        actionFollow: function () {
            $el = this.$el.find('[data-action="follow"]');
            $el.addClass('disabled');
            $.ajax({
                url: this.model.name + '/' + this.model.id + '/subscription',
                type: 'PUT',
                success: function () {
                    $el.remove();
                    this.model.set('isFollowed', true);
                }.bind(this),
                error: function () {
                    $el.removeClass('disabled');
                }.bind(this)
            });
        },

        actionUnfollow: function () {
            $el = this.$el.find('[data-action="unfollow"]');
            $el.addClass('disabled');
            $.ajax({
                url: this.model.name + '/' + this.model.id + '/subscription',
                type: 'DELETE',
                success: function () {
                    $el.remove();
                    this.model.set('isFollowed', false);
                }.bind(this),
                error: function () {
                    $el.removeClass('disabled');
                }.bind(this)
            });

        },

        getHeader: function () {
            var name = Handlebars.Utils.escapeExpression(this.model.get('name'));

            return this.buildHeaderHtml([
                '<a href="#' + this.model.name + '" class="action" data-action="navigateToRoot">' + this.getLanguage().translate(this.model.name, 'scopeNamesPlural') + '</a>',
                name
            ]);
        },

        updatePageTitle: function () {
            this.setPageTitle(this.model.get('name'));
        },

        updateRelationshipPanel: function (name) {
            var bottom = this.getView('record').getView('bottom');
            if (bottom) {
                var rel = bottom.getView(name);
                if (rel) {
                    rel.collection.fetch();
                }
            }
        },

        relatedAttributeMap: {},

        relatedAttributeFunctions: {},

        selectRelatedFilters: {},

        selectPrimaryFilterNames: {},

        selectBoolFilterLists: [],

        actionCreateRelated: function (data) {
            data = data || {};

            var link = data.link;
            var scope = this.model.defs['links'][link].entity;
            var foreignLink = this.model.defs['links'][link].foreign;

            var attributes = {};

            if (this.relatedAttributeFunctions[link] && typeof this.relatedAttributeFunctions[link] == 'function') {
                attributes = _.extend(this.relatedAttributeFunctions[link].call(this), attributes);
            }

            Object.keys(this.relatedAttributeMap[link] || {}).forEach(function (attr) {
                attributes[this.relatedAttributeMap[link][attr]] = this.model.get(attr);
            }, this);

            this.notify('Loading...');

            var viewName = this.getMetadata().get('clientDefs.' + scope + '.modalViews.edit') || 'views/modals/edit';
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
                    this.updateRelationshipPanel(link);
                    this.model.trigger('after:relate');
                }, this);
            }.bind(this));
        },

        actionSelectRelated: function (data) {
            var link = data.link;

            if (!this.model.defs['links'][link]) {
                throw new Error('Link ' + link + ' does not exist.');
            }
            var scope = this.model.defs['links'][link].entity;
            var foreign = this.model.defs['links'][link].foreign;

            var massRelateEnabled = false;
            if (foreign) {
                var foreignType = this.getMetadata().get('entityDefs.' + scope + '.links.' + foreign + '.type');
                if (foreignType == 'hasMany') {
                    massRelateEnabled = true;
                }
            }

            var self = this;
            var attributes = {};

            var filters = Fox.Utils.cloneDeep(this.selectRelatedFilters[link]) || {};
            for (var filterName in filters) {
                if (typeof filters[filterName] == 'function') {
                    var filtersData = filters[filterName].call(this);
                    if (filtersData) {
                        filters[filterName] = filtersData;
                    } else {
                        delete filters[filterName];
                    }
                }
            }

            var primaryFilterName = data.primaryFilterName || this.selectPrimaryFilterNames[link] || null;
            if (typeof primaryFilterName == 'function') {
                primaryFilterName = primaryFilterName.call(this);
            }

            var boolFilterList = data.boolFilterList || Fox.Utils.cloneDeep(this.selectBoolFilterLists[link] || []);
            if (typeof boolFilterList == 'function') {
                boolFilterList = boolFilterList.call(this);
            }

            var viewName = this.getMetadata().get('clientDefs.' + scope + '.modalViews.select') || 'views/modals/select-records';

            this.notify('Loading...');
            this.createView('dialog', viewName, {
                scope: scope,
                multiple: true,
                createButton: false,
                filters: filters,
                massRelateEnabled: massRelateEnabled,
                primaryFilterName: primaryFilterName,
                boolFilterList: boolFilterList
            }, function (dialog) {
                dialog.render();
                this.notify(false);
                dialog.once('select', function (selectObj) {
                    var data = {};
                    if (Object.prototype.toString.call(selectObj) === '[object Array]') {
                        var ids = [];
                        selectObj.forEach(function (model) {
                            ids.push(model.id);
                        });
                        data.ids = ids;
                    } else {
                        if (selectObj.massRelate) {
                            data.massRelate = true;
                            data.where = selectObj.where;
                        } else {
                            data.id = selectObj.id;
                        }
                    }
                    $.ajax({
                        url: self.scope + '/' + self.model.id + '/' + link,
                        type: 'POST',
                        data: JSON.stringify(data),
                        success: function () {
                            this.notify('Linked', 'success');
                            this.updateRelationshipPanel(link);
                            this.model.trigger('after:relate');
                        }.bind(this),
                        error: function () {
                            this.notify('Error occurred', 'error');
                        }.bind(this)
                    });
                }.bind(this));
            }.bind(this));
        },

        actionDuplicate: function () {
            var attributes = Fox.Utils.cloneDeep(this.model.attributes);
            delete attributes.id;

            var url = '#' + this.scope + '/create';

            this.getRouter().dispatch(this.scope, 'create', {
                attributes: attributes,
            });
            this.getRouter().navigate(url, {trigger: false});
        },

    });
});

