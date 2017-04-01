

Fox.define('views/user/record/edit-side', 'views/record/edit-side', function (Dep) {

    return Dep.extend({

        panelList: [
            {
                name: 'default',
                label: false,
                view: 'views/record/panels/side',
                options: {
                    fieldList: ['avatar'],
                    mode: 'edit',
                }
            }
        ],

    });

});

