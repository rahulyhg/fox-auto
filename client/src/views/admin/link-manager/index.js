

Fox.define('views/admin/link-manager/index', 'view', function (Dep) {

    return Dep.extend({

        template: 'admin/link-manager/index',

        scopeDataList: null,

        scope: null,

        data: function () {
            return {
                linkDataList: this.linkDataList,
                scope: this.scope,
            };
        },

        events: {
            'click a[data-action="editLink"]': function (e) {
                var link = $(e.currentTarget).data('link');
                this.editLink(link);
            },
            'click button[data-action="createLink"]': function (e) {
                this.createLink();
            },
            'click [data-action="removeLink"]': function (e) {
                var link = $(e.currentTarget).data('link');
                if (confirm(this.translate('confirmation', 'messages'))) {
                    this.removeLink(link);
                }
            }
        },

        computeRelationshipType: function (type, foreignType) {
            if (type == 'hasMany') {
                if (foreignType == 'hasMany') {
                    return 'manyToMany';
                } else if (foreignType == 'belongsTo') {
                    return 'oneToMany';
                } else {
                    return;
                }
            } else if (type == 'belongsTo') {
                if (foreignType == 'hasMany') {
                    return 'manyToOne';
                } else {
                    return;
                }
            } else if (type == 'belongsToParent') {
                if (foreignType == 'hasChildren') {
                    return 'childrenToParent'
                }
                return;
            } else if (type == 'hasChildren') {
                if (foreignType == 'belongsToParent') {
                    return 'parentToChildren'
                }
                return;
            }
        },

        setupLinkData: function () {
            this.linkDataList = [];

            var links = this.getMetadata().get('entityDefs.' + this.scope + '.links');
            var linkList = Object.keys(links).sort(function (v1, v2) {
                return v1.localeCompare(v2);
            }.bind(this));

            linkList.forEach(function (link) {
                var d = links[link];

                if (!d.foreign) return;
                if (!d.entity) return;

                var foreignType = this.getMetadata().get('entityDefs.' + d.entity + '.links.' + d.foreign + '.type');

                var type = this.computeRelationshipType(d.type, foreignType);

                if (!type) return;

                this.linkDataList.push({
                    link: link,
                    isCustom: d.isCustom,
                    customizable: d.customizable,
                    type: type,
                    entityForeign: d.entity,
                    entity: this.scope,
                    linkForeign: d.foreign,
                    label: this.getLanguage().translate(link, 'links', this.scope),
                    labelForeign: this.getLanguage().translate(d.foreign, 'links', d.entity)
                });

            }, this);
        },

        setup: function () {
            this.scope = this.options.scope || null;

            this.setupLinkData();

            this.on('after:render', function () {
                this.renderHeader();
            });
        },

        createLink: function () {
            this.createView('edit', 'views/admin/link-manager/modals/edit', {
                scope: this.scope
            }, function (view) {
                view.render();

                this.listenTo(view, 'after:save', function () {
                    this.clearView('edit');
                    this.setupLinkData();
                    this.render();
                }, this);

                this.listenTo(view, 'close', function () {
                    this.clearView('edit');
                }, this);
            }.bind(this));
        },

        editLink: function (link) {
            this.createView('edit', 'views/admin/link-manager/modals/edit', {
                scope: this.scope,
                link: link
            }, function (view) {
                view.render();

                this.listenTo(view, 'after:save', function () {
                    this.clearView('edit');
                    this.setupLinkData();
                    this.render();
                }, this);

                this.listenTo(view, 'close', function () {
                    this.clearView('edit');
                }, this);
            }.bind(this));
        },

        removeLink: function (link) {
            $.ajax({
                url: 'EntityManager/action/removeLink',
                type: 'POST',
                data: JSON.stringify({
                    entity: this.scope,
                    link: link
                })
            }).done(function () {
                this.$el.find('table tr[data-link="'+link+'"]').remove();
                this.getMetadata().load(function () {
                    this.setupLinkData();
                    this.render();
                }.bind(this), true);
            }.bind(this));
        },

        renderHeader: function () {
            if (!this.scope) {
                $('#scope-header').html('');
                return;
            }

            $('#scope-header').show().html(this.getLanguage().translate(this.scope, 'scopeNames'));
        },

        updatePageTitle: function () {
            this.setPageTitle(this.getLanguage().translate('Entity Manager', 'labels', 'Admin'));
        },
    });
});


