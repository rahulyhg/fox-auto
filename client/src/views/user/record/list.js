

Fox.define('views/user/record/list', 'views/record/list', function (Dep) {

    return Dep.extend({

        quickEditDisabled: true,

        massActionList: ['remove', 'massUpdate', 'export'],

        checkAllResultDisabled: true

    });

});

