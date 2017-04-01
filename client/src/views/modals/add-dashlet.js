


Fox.define('views/modals/add-dashlet', 'views/modal', function (Dep) {

    return Dep.extend({

        cssName: 'add-dashlet',

        template: 'modals/add-dashlet',

        data: function () {
            return {
                dashletList: this.dashletList,
            };
        },

        events: {
            'click button.add': function (e) {
                var name = $(e.currentTarget).data('name');
                this.trigger('add', name);
                this.close();
            },
        },

        buttonList: [
            {
                name: 'cancel',
                label: 'Cancel'
            }
        ],

        setup: function () {
            /*this.buttonList = [
                {
                    name: 'cancel',
                    label: 'Cancel'
                }
            ];*/

            this.header = this.translate('Add Dashlet');

            var dashletList = Object.keys(this.getMetadata().get('dashlets') || {}).sort(function (v1, v2) {
                return this.translate(v1, 'dashlets').localeCompare(this.translate(v2, 'dashlets'));
            }.bind(this));

            this.dashletList = [];

            dashletList.forEach(function (item) {
                var aclScope = this.getMetadata().get('dashlets.' + item + '.aclScope') || null;
                if (aclScope) {
                    if (!this.getAcl().check(aclScope)) {
                        return;
                    }
                }
                this.dashletList.push(item);
            }, this);
        },
    });
});


