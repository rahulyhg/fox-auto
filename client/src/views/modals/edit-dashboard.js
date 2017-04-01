


Fox.define('views/modals/edit-dashboard', ['views/modal', 'model'], function (Dep, Model) {

    return Dep.extend({

        cssName: 'edit-dashboard',

        template: 'modals/edit-dashboard',

        data: function () {
            return {

            };
        },

        events: {
            'click button.add': function (e) {
                var name = $(e.currentTarget).data('name');
                this.getParentView().addDashlet(name);
                this.close();
            },
        },

        setup: function () {
            this.buttonList = [
                {
                    name: 'save',
                    label: 'Save',
                    style: 'primary'
                },
                {
                    name: 'cancel',
                    label: 'Cancel'
                }
            ];

            var dashboardLayout = this.options.dashboardLayout || [];

            var dashboardTabList = [];
            dashboardLayout.forEach(function (item) {
                if (item.name) {
                    dashboardTabList.push(item.name);
                }
            }, this);

            var model = new Model();
            model.name = 'Preferences';

            model.set('dashboardTabList', dashboardTabList);
            this.createView('dashboardTabList', 'views/fields/array', {
                el: this.options.el + ' .field[data-name="dashboardTabList"]',
                defs: {
                    name: 'dashboardTabList',
                    params: {
                        required: this.options.tabListIsNotRequired ? false : true,
                        noEmptyString: true
                    }
                },
                mode: 'edit',
                model: model
            });

            this.header = this.translate('Edit Dashboard');

            this.dashboardLayout = this.options.dashboardLayout;
        },

        actionSave: function () {
            var dashboardTabListView = this.getView('dashboardTabList');
            dashboardTabListView.fetchToModel();
            if (dashboardTabListView.validate()) {
                return;
            }

            var attributes = {};
            attributes.dashboardTabList = dashboardTabListView.model.get('dashboardTabList');

            this.trigger('after:save', attributes);

            this.dialog.close();
        },
    });
});


