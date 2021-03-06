

Fox.define('views/modals/detail', 'views/modal', function (Dep) {

    return Dep.extend({

        cssName: 'detail-modal',

        header: false,

        template: 'modals/detail',

        editDisabled: false,

        fullFormDisabled: false,

        detailViewName: null,

        columnCount: 2,

        backdrop: true,

        fitHeight: true,

        setup: function () {

            var self = this;

            this.buttonList = [];

            if ('editDisabled' in this.options) {
                this.editDisabled = this.options.editDisabled;
            }

            this.fullFormDisabled = this.options.fullFormDisabled || this.fullFormDisabled;

            if (!this.editDisabled) {
                this.addEditButton();
            }

            if (!this.fullFormDisabled) {
                this.buttonList.push({
                    name: 'fullForm',
                    label: 'Full Form'
                });
            }

            this.buttonList.push({
                name: 'cancel',
                label: 'Close'
            });

            if (this.model && this.model.collection && !this.navigateButtonsDisabled) {
                this.buttonList.push({
                    name: 'previous',
                    html: '<span class="glyphicon glyphicon-chevron-left"></span>',
                    title: this.translate('Previous Entry'),
                    pullLeft: true,
                    disabled: true
                });
                this.buttonList.push({
                    name: 'next',
                    html: '<span class="glyphicon glyphicon-chevron-right"></span>',
                    title: this.translate('Next Entry'),
                    pullLeft: true,
                    disabled: true
                });
                this.indexOfRecord = this.model.collection.indexOf(this.model);
            } else {
                this.navigateButtonsDisabled = true;
            }

            this.scope = this.scope || this.options.scope;
            this.id = this.options.id;

            this.waitForView('record');

            this.sourceModel = this.model;

            this.getModelFactory().create(this.scope, function (model) {
                if (!this.sourceModel) {
                    this.model = model;
                    this.model.id = this.id;

                    this.listenToOnce(this.model, 'sync', function () {
                        this.createRecordView();
                    }, this);
                    this.model.fetch();
                } else {
                    this.model = this.sourceModel.clone();
                    this.model.collection = this.sourceModel.collection;

                    this.listenTo(this.model, 'change', function () {
                        this.sourceModel.set(this.model.getClonedAttributes());
                    }, this);

                    this.once('after:render', function () {
                        this.model.fetch();
                    }, this);
                    this.createRecordView();
                }
            }, this);
        },

        addEditButton: function () {
            var index = -1;
            this.buttonList.forEach(function (item, i) {
                if (item.name === 'edit') {
                    index = i;
                }
            }, this);
            if (~index) return;

            this.buttonList.unshift({
                name: 'edit',
                label: 'Edit',
                style: 'primary'
            });
        },

        removeEditButton: function () {
            var index = -1;
            this.buttonList.forEach(function (item, i) {
                if (item.name === 'edit') {
                    index = i;
                }
            }, this);
            if (~index) {
                this.buttonList.splice(index, 1);
            }
        },

        createRecordView: function (callback) {
            var model = this.model;
            this.header = this.getLanguage().translate(this.scope, 'scopeNames');

            if (model.get('name')) {
                this.header += ' &raquo; ' + model.get('name');
            }
            if (!this.fullFormDisabled) {
                this.header = '<a href="#' + this.scope + '/view/' + this.id+'" class="action" title="'+this.translate('Full Form')+'" data-action="fullForm">' + this.header + '</a>';
            }

            if (!this.editDisabled) {
                var editAccess = this.getAcl().check(model, 'edit', true);
                if (editAccess) {
                    this.showButton('edit');
                } else {
                    this.hideButton('edit');
                    if (editAccess === null) {
                        this.listenToOnce(model, 'sync', function() {
                            if (this.getAcl().check(model, 'edit')) {
                                this.showButton('edit');
                            }
                        }, this);
                    }
                }
            }

            var viewName = this.detailViewName || this.getMetadata().get('clientDefs.' + model.name + '.recordViews.detailQuick') || 'Record.DetailSmall'; 
            var options = {
                model: model,
                el: this.containerSelector + ' .record-container',
                type: 'detailSmall',
                layoutName: this.layoutName || 'detailSmall',
                columnCount: this.columnCount,
                buttonsPosition: false,
                inlineEditDisabled: true,
                exit: function () {},
            };
            this.createView('record', viewName, options, callback);
        },

        afterRender: function () {
            Dep.prototype.afterRender.call(this);

            setTimeout(function () {
                this.$el.children(0).scrollTop(0);
            }.bind(this), 50);

            if (!this.navigateButtonsDisabled) {
                this.controlNavigationButtons();
            }
        },

        controlNavigationButtons: function () {
            var recordView = this.getView('record');
            if (!recordView) return;

            var indexOfRecord = this.indexOfRecord;

            var previousButtonEnabled = false;
            var nextButtonEnabled = false;

            if (indexOfRecord > 0) {
                previousButtonEnabled = true;
            }

            if (indexOfRecord < this.model.collection.total - 1) {
                nextButtonEnabled = true;
            } else {
                if (this.model.collection.total === -1) {
                    nextButtonEnabled = true;
                } else if (this.model.collection.total === -2) {
                    if (indexOfRecord < this.model.collection.length - 1) {
                        nextButtonEnabled = true;
                    }
                }
            }

            var $previous = this.$el.find('footer button[data-name="previous"]');
            var $next = this.$el.find('footer button[data-name="next"]');

            if (previousButtonEnabled) {
                $previous.removeClass('disabled');
            } else {
                $previous.addClass('disabled');
            }

            if (nextButtonEnabled) {
                $next.removeClass('disabled');
            } else {
                $next.addClass('disabled');
            }
        },

        switchToModelByIndex: function (indexOfRecord) {
            if (!this.model.collection) return;

            this.sourceModel = this.model.collection.at(indexOfRecord);

            if (!this.sourceModel) {
                throw new Error("Model is not found in collection by index.");
            }

            this.indexOfRecord = indexOfRecord;

            this.id = this.sourceModel.id;
            this.scope = this.sourceModel.name;

            this.model = this.sourceModel.clone();
            this.model.collection = this.sourceModel.collection;

            this.listenTo(this.model, 'change', function () {
                this.sourceModel.set(this.model.getClonedAttributes());
            }, this);

            this.once('after:render', function () {
                this.model.fetch();
            }, this);

            this.createRecordView(function () {
                this.reRender();
            }.bind(this));

            this.controlNavigationButtons();
        },

        actionPrevious: function () {
            if (!this.model.collection) return;
            if (!(this.indexOfRecord > 0)) return;

            var indexOfRecord = this.indexOfRecord - 1;
            this.switchToModelByIndex(indexOfRecord);
        },

        actionNext: function () {
            if (!this.model.collection) return;
            if (!(this.indexOfRecord < this.model.collection.total - 1) && this.model.collection.total >= 0) return;
            if (this.model.collection.total === -2 && this.indexOfRecord >= this.model.collection.length - 1) {
                return;
            }

            var collection = this.model.collection;

            var indexOfRecord = this.indexOfRecord + 1;
            if (indexOfRecord <= collection.length - 1) {
                this.switchToModelByIndex(indexOfRecord);
            } else {
                var initialCount = collection.length;

                this.listenToOnce(collection, 'sync', function () {
                    var model = collection.at(indexOfRecord);
                    this.switchToModelByIndex(indexOfRecord);
                }, this);
                collection.fetch({
                    more: true,
                    remove: false,
                });
            }
        },

        actionEdit: function () {
            this.createView('quickEdit', 'views/modals/edit', {
                scope: this.scope,
                id: this.id,
                fullFormDisabled: this.fullFormDisabled
            }, function (view) {
                view.once('after:render', function () {
                    Fox.Ui.notify(false);
                    this.dialog.hide();
                }, this);

                this.listenToOnce(view, 'remove', function () {
                    this.close();
                }, this);

                this.listenToOnce(view, 'after:save', function (model) {
                    this.trigger('after:save', model);
                }, this);

                this.listenToOnce(view, 'cancel', function () {
                    this.trigger('after:edit-cancel');
                }, this);

                view.render();
            }, this);
        },

        actionFullForm: function () {
            var url;
            var router = this.getRouter();

            url = '#' + this.scope + '/view/' + this.id;

            var attributes = this.getView('record').fetch();
            var model = this.getView('record').model;
            attributes = _.extend(attributes, model.getClonedAttributes());

            setTimeout(function () {
                router.dispatch(this.scope, 'view', {
                    attributes: attributes,
                    returnUrl: Backbone.history.fragment,
                    model: this.sourceModel || this.model,
                    id: this.id
                });
                router.navigate(url, {trigger: false});
            }.bind(this), 10);


            this.trigger('leave');
            this.dialog.close();
        }
    });
});

