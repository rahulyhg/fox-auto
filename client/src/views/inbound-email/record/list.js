

Fox.define('Views.InboundEmail.Record.List', 'Views.Record.List', function (Dep) {

    return Dep.extend({

    	quickDetailDisabled: true,

        quickEditDisabled: true,

        massActionList: ['remove'],

        checkAllResultDisabled: true

    });

});

