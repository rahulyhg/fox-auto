

Fox.define('crm:views/call/record/list-expanded', ['views/record/list-expanded', 'crm:views/call/record/list'], function (Dep, List) {

    return Dep.extend({

        actionSetHeld: function (data) {
            List.prototype.actionSetHeld.call(this, data);
        },

        actionSetNotHeld: function (data) {
            List.prototype.actionSetNotHeld.call(this, data);
        },

    });

});
