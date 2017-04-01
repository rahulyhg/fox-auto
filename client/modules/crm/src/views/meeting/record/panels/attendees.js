

Fox.define('crm:views/meeting/record/panels/attendees', 'views/record/panels/side', function (Dep) {

    return Dep.extend({

        setupFields: function () {
            this.fieldList = [];

            this.fieldList.push('users');

            if (this.getAcl().check('Contact') && !this.getMetadata().get('scopes.Contact.disabled')) {
                this.fieldList.push('contacts');
            }
            if (this.getAcl().check('Lead') && !this.getMetadata().get('scopes.Lead.disabled')) {
                this.fieldList.push('leads');
            }
        }

    });

});
