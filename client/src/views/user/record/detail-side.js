

Fox.define('views/user/record/detail-side', 'views/record/detail-side', function (Dep) {

    return Dep.extend({

        panelList: [
            {
                name: 'default',
                label: false,
                view: 'views/record/panels/side',
                options: {
                    fieldList: ['avatar'],
                    mode: 'detail',
                }
            }
        ],

        setupPanels: function () {
            Dep.prototype.setupPanels.call(this);

            var showActivities = this.getAcl().checkUserPermission(this.model);
            if (!showActivities) {
                if (this.getAcl().get('userPermission') === 'team') {
                    if (!this.model.has('teamsIds')) {
                        this.listenToOnce(this.model, 'sync', function () {
                            if (this.getAcl().checkUserPermission(this.model)) {
                                this.showPanel('activities', function () {
                                    this.getView('activities').actionRefresh();
                                });
                                this.showPanel('history', function () {
                                    this.getView('history').actionRefresh();
                                });
                            }
                        }, this);
                    }
                }
            }

            this.panelList.push({
                "name":"activities",
                "label":"Activities",
                "view":"crm:views/record/panels/activities",
                "hidden": !showActivities,
                "aclScope": "Activities"
            });
            this.panelList.push({
                "name":"history",
                "label":"History",
                "view":"crm:views/record/panels/history",
                "hidden": !showActivities,
                "aclScope": "Activities"
            });
        }

    });

});

