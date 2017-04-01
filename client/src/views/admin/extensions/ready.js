

Fox.define('views/admin/extensions/ready', 'views/modal', function (Dep) {

    return Dep.extend({

        cssName: 'ready-modal',

        header: false,

        template: 'admin/extensions/ready',

        createButton: true,

        data: function () {
            return {
                version: this.upgradeData.version,
                text: this.translate('installExtension', 'messages', 'Admin').replace('{version}', this.upgradeData.version)
                                                                             .replace('{name}', this.upgradeData.name)
            };
        },

        setup: function () {
            this.buttonList = [
                {
                    name: 'run',
                    text: this.translate('Install', 'labels', 'Admin'),
                    style: 'danger'
                },
                {
                    name: 'cancel',
                    label: 'Cancel'
                }
            ];

            this.upgradeData = this.options.upgradeData;

            this.header = this.getLanguage().translate('Ready for installation', 'labels', 'Admin');

        },

        actionRun: function () {
            this.trigger('run');
            this.remove();
        }
    });
});

