

Fox.define('views/record/panels/bottom', 'view', function (Dep) {

    return Dep.extend({

        template: 'record/panels/side',

        actionList: null,

        buttonList: null,

        defs: null,

        mode: 'detail',

        fieldList: null,

        disabled: false,

        events: {
            'click .action': function (e) {
                var $el = $(e.currentTarget);
                var action = $el.data('action');
                var method = 'action' + Fox.Utils.upperCaseFirst(action);
                if (typeof this[method] == 'function') {
                    var data = $el.data();
                    this[method](data, e);
                    e.preventDefault();
                }
            }
        },

        data: function () {
            return {
                scope: this.scope,
                name: this.panelName,
                hiddenFields: this.recordHelper.getHiddenFields(),
                fieldList: this.getFieldList(),
            };
        },

        init: function () {
            this.panelName = this.options.panelName;
            this.defs = this.options.defs || {};
            this.recordHelper = this.options.recordHelper;

            if ('disabled' in this.options) {
                this.disabled = this.options.disabled;
            }

            this.mode = this.options.mode || this.mode;

            this.readOnlyLocked = this.options.readOnlyLocked || this.readOnly;
            this.readOnly = this.readOnly || this.options.readOnly;
            this.inlineEditDisabled = this.inlineEditDisabled || this.options.inlineEditDisabled;

            this.buttonList = _.clone(this.defs.buttonList || this.buttonList || []);
            this.actionList = _.clone(this.defs.actionList || this.actionList || []);

            this.fieldList = this.options.fieldList || this.fieldList || [];
        },

        setup: function () {
            this.setupFields();

            this.fieldList = this.fieldList.map(function (d) {
                var item = d;
                if (typeof item !== 'object') {
                    item = {
                        name: item
                    }
                }
                item = Fox.Utils.clone(item);

                if (this.recordHelper.getFieldStateParam(item.name, 'hidden') !== null) {
                    item.hidden = this.recordHelper.getFieldStateParam(item.name, 'hidden');
                } else {
                    this.recordHelper.setFieldStateParam(item.name, item.hidden || false);
                }
                return item;
            }, this);

            this.fieldList = this.fieldList.filter(function (item) {
                if (!item.name) return;
                if (!(item.name in (((this.model.defs || {}).fields) || {}))) return;
                return true;
            }, this);

            this.createFields();
        },

        setupFields: function () {
        },

        getButtonList: function () {
            return this.buttonList || [];
        },

        getActionList: function () {
            return this.actionList || [];
        },

        getFieldViews: function () {
            var fields = {};

            this.getFieldList().forEach(function (item) {
                if (this.hasView(item.name)) {
                    fields[item.name] = this.getView(item.name);
                }
            }, this);
            return fields;
        },

        getFields: function () {
            return this.getFields();
        },

        getFieldList: function () {
            return this.fieldList.map(function (item) {
                if (typeof item !== 'object') {
                    return {
                        name: item
                    };
                }
                return item;
            }, this);
        },

        createFields: function () {
            this.getFieldList().forEach(function (item) {
                var view = null;
                var field;
                var readOnly = null;
                if (typeof item === 'object') {
                    field = item.name;
                    view = item.view;
                    if ('readOnly' in item) {
                        readOnly = item.readOnly;
                    }
                } else {
                   field = item;
                }
                if (!(field in this.model.defs.fields)) {
                    return;
                }
                this.createField(field, readOnly, view);

            }, this);
        },

        createField: function (field, readOnly, viewName) {
            var type = this.model.getFieldType(field) || 'base';
            viewName = viewName || this.model.getFieldParam(field, 'view') || this.getFieldManager().getViewName(type);

            var o = {
                model: this.model,
                el: this.options.el + ' .field[data-name="' + field + '"]',
                defs: {
                    name: field,
                    params: {},
                },
                mode: this.mode
            };

            var readOnlyLocked = this.readOnlyLocked;

            if (this.readOnly) {
                o.readOnly = true;
            } else {
                if (readOnly !== null) {
                    o.readOnly = readOnly
                }
                if (readOnly) {
                    readOnlyLocked = true;
                }
            }
            if (this.inlineEditDisabled) {
                o.inlineEditDisabled = true;
            }

            if (this.recordHelper.getFieldStateParam(field, 'hidden')) {
                o.disabled = true;
            }
            if (this.recordHelper.getFieldStateParam(field, 'hiddenLocked')) {
                o.disabledLocked = true;
            }
            if (this.recordHelper.getFieldStateParam(field, 'readOnly')) {
                o.readOnly = true;
            }
            if (this.recordHelper.getFieldStateParam(field, 'required') !== null) {
                o.defs.params.required = this.recordHelper.getFieldStateParam(field, 'required');
            }
            if (!readOnlyLocked && this.recordHelper.getFieldStateParam(field, 'readOnlyLocked')) {
                readOnlyLocked = true;
            }

            if (readOnlyLocked) {
                o.readOnlyLocked = readOnlyLocked;
            }

            this.createView(field, viewName, o);
        }

    });
});

