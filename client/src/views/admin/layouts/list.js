

Fox.define('Views.Admin.Layouts.List', 'Views.Admin.Layouts.Rows', function (Dep) {

    return Dep.extend({

        dataAttributes: ['name', 'width', 'link', 'notSortable', 'align'],

        dataAttributesDefs: {
            link: {type: 'bool'},
            width: {type: 'float'},
            notSortable: {type: 'bool'},
            align: {
                type: 'enum',
                options: ["left", "right"]
            }
        },

        editable: true,

        ignoreList: [],

        ignoreTypeList: [],

        setup: function () {
            Dep.prototype.setup.call(this);

            this.wait(true);
            this.loadLayout(function () {
                this.wait(false);
            }.bind(this));
        },

        loadLayout: function (callback) {
            this.getModelFactory().create(Fox.Utils.hyphenToUpperCamelCase(this.scope), function (model) {
                this.getHelper().layoutManager.get(this.scope, this.type, function (layout) {
                    this.readDataFromLayout(model, layout);
                    if (callback) {
                        callback();
                    }
                }.bind(this), false);
            }.bind(this));
        },

        readDataFromLayout: function (model, layout) {
            var allFields = [];
            for (var field in model.defs.fields) {
                if (this.checkFieldType(model.getFieldParam(field, 'type')) && this.isFieldEnabled(model, field)) {

                    allFields.push(field);
                }
            }

            allFields.sort(function (v1, v2) {
                return this.translate(v1, 'fields', this.scope).localeCompare(this.translate(v2, 'fields', this.scope));
            }.bind(this));

            this.enabledFieldsList = [];

            this.enabledFields = [];
            this.disabledFields = [];

            for (var i in layout) {
                this.enabledFields.push({
                    name: layout[i].name,
                    label: this.getLanguage().translate(layout[i].name, 'fields', this.scope)
                });
                this.enabledFieldsList.push(layout[i].name);
            }

            for (var i in allFields) {
                if (!_.contains(this.enabledFieldsList, allFields[i])) {
                    this.disabledFields.push({
                        name: allFields[i],
                        label: this.getLanguage().translate(allFields[i], 'fields', this.scope)
                    });
                }
            }

            this.rowLayout = layout;

            for (var i in this.rowLayout) {
                this.rowLayout[i].label = this.getLanguage().translate(this.rowLayout[i].name, 'fields', this.scope);
            }
        },

        parseDataAttributes: function (dialog) {
            var width = parseFloat(dialog.$el.find("[name='width']").val());
            if (isNaN(width) || width > 100 || width < 0) {
                width = '';
            }
            return {
                width: width,
                link: dialog.$el.find("[name='link']").val()
            };
        },

        checkFieldType: function (type) {
            if (['linkMultiple'].indexOf(type) != -1) {
                return false;
            }
            return true;
        },

        isFieldEnabled: function (model, name) {
            if (this.ignoreList.indexOf(name) != -1) {
                return false;
            }
            if (this.ignoreTypeList.indexOf(model.getFieldParam(name, 'type')) != -1) {
                return false;
            }
            return !model.getFieldParam(name, 'disabled') && !model.getFieldParam(name, 'layoutListDisabled');
        }

    });
});


