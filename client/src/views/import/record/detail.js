

Fox.define('views/import/record/detail', 'views/record/detail', function (Dep) {

    return Dep.extend({

        readOnly: true,

        returnUrl: '#Import/list'

    });

});

