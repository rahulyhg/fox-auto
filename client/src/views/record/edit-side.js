

Fox.define('views/record/edit-side', 'views/record/detail-side', function (Dep) {

    return Dep.extend({

        mode: 'edit',

        panelList: [
            {
                name: 'default',
                label: false,
                view: 'views/record/panels/side',
                options: {
                    fieldList: [
                        {
                            name: 'assignedUser',
                            view: 'views/fields/assigned-user'
                        },
                        {
                            name: 'teams',
                            view: 'views/fields/teams'
                        }
                    ],
                    mode: 'edit',
                }
            }
        ]

    });
});


