

Fox.define('crm:views/meeting/fields/users', 'crm:views/meeting/fields/attendees', function (Dep) {

    return Dep.extend({

        selectPrimaryFilterName: 'active'

    });

});
