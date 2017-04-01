

Fox.define('views/user/record/detail-quick-side', 'views/record/detail-side', function (Dep) {

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
        ]

    });

});

