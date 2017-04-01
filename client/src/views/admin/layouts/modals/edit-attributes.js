


Fox.define('views/admin/layouts/modals/edit-attributes', ['views/modal', 'model'], function (Dep, Model) {

    return Dep.extend({

        _template: '<div class="edit-container">{{{edit}}}</div>',

        setup: function () {
            this.buttonList = [
                {
                    name: 'save',
                    text: this.translate('Apply'),
                    style: 'primary'
                },
                {
                    name: 'cancel',
                    text: 'Cancel'
                }
            ];

            var model = new Model();
            model.name = 'LayoutManager';
            model.set(this.options.attributes || {});

            this.header = this.translate(this.options.name, 'fields', this.options.scope);

            var attributeList = Fox.Utils.clone(this.options.attributeList || []);
            var index = attributeList.indexOf('name');
            if (~index) {
                attributeList.splice(index, 1);
            }

            this.createView('edit', 'Admin.Layouts.Record.EditAttributes', {
                el: this.options.el + ' .edit-container',
                attributeList: attributeList,
                attributeDefs: this.options.attributeDefs,
                model: model
            });
        },

        actionSave: function () {
            var editView = this.getView('edit');
            var attrs = editView.fetch();

            editView.model.set(attrs, {silent: true});
            if (editView.validate()) {
                return;
            }

            var attributes = {};
            attributes = editView.model.attributes;

            this.trigger('after:save', attributes);
            return true;
        },
    });
});
