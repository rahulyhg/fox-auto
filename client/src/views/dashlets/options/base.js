

Fox.define('views/dashlets/options/base', ['views/modal', 'views/record/detail', 'model', 'view-record-helper'], function (Dep, Detail, Model, ViewRecordHelper) {

    var self;

    return Dep.extend({

        name: null,

        template: 'dashlets/options/base',

        cssName: 'options-modal',

        fieldsMode: 'edit',

        data: function () {
            return {
                options: this.optionsData,
            };
        },

        buttonList: [
            {
                name: 'save',
                label: 'Save',
                style: 'primary'
            },
            {
                name: 'cancel',
                label: 'Cancel'
            }
        ],

        getDetailLayout: function () {
            var layout = this.getMetadata().get(['dashlets', this.name, 'options', 'layout']);
            if (layout) {
                return layout;
            }
            layout = [{rows: []}];
            var i = 0;
            var a = [];
            for (var field in this.fields) {

                if (!(i % 2)) {
                    a = [];
                    layout[0].rows.push(a);
                }
                a.push({name: field});
                i++;
            }
            return layout;
        },

        init: function () {
            Dep.prototype.init.call(this);
            this.fields = this.options.fields;
            this.fieldList = Object.keys(this.fields);
            this.optionsData = this.options.optionsData;
        },

        setup: function (dialog) {
            this.id = 'dashlet-options';

            this.recordHelper = new ViewRecordHelper();

            var self = this;
            var model = this.model = new Model();
            model.name = 'DashletOptions';
            model.defs = {
                fields: this.fields
            };
            model.set(this.optionsData);

            this.createView('record', 'views/record/detail-middle', {
                model: model,
                recordHelper: this.recordHelper,
                _layout: {
                    type: 'record',
                    layout: Detail.prototype.convertDetailLayout.call(this, this.getDetailLayout())
                },
                el: this.options.el + ' .record',
                layoutData: {
                    model: model,
                    columnCount: 2,
                },
            });

            this.header = this.getLanguage().translate('Dashlet Options') + ': ' + this.getLanguage().translate(this.name, 'dashlets');
        },

        fetchAttributes: function () {
            var attributes = {};
            this.fieldList.forEach(function (field) {
                var fieldView = this.getView('record').getView(field);
                _.extend(attributes, fieldView.fetch());
            }, this);

            this.model.set(attributes, {silent: true});

            var valid = true;
            this.fieldList.forEach(function (field) {
                var fieldView = this.getView('record').getView(field);
                valid = !fieldView.validate() && valid;
            }, this);

            if (!valid) {
                this.notify('Not Valid', 'error');
                return null;
            }
            return attributes;
        },

        actionSave: function (dialog) {
            var attributes = this.fetchAttributes();

            if (attributes == null) {
                return;
            }

            this.trigger('save', attributes);
        },
    });
});


