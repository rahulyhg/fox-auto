

Fox.define('views/user/fields/contact', 'views/fields/link', function (Dep) {

    return Dep.extend({

        select: function (model) {
            Dep.prototype.select.call(this, model);

            if (model.has('accountId')) {
                var names = {};
                names[model.get('accountId')] = model.get('accountName');

                var attributes = {
                    accountsIds: [model.get('accountId')],
                    accountsNames: names
                };
            }

            attributes.firstName = model.get('firstName');
            attributes.lastName = model.get('lastName');
            attributes.salutationName = model.get('salutationName');

            attributes.emailAddress = model.get('emailAddress');
            attributes.emailAddressData = model.get('emailAddressData');

            attributes.phoneNumber = model.get('phoneNumber');
            attributes.phoneNumberData = model.get('phoneNumberData');

            if (this.model.isNew() && !this.model.get('userName') && attributes.emailAddress) {
                attributes.userName = attributes.emailAddress;
            }

            this.model.set(attributes);
        }

    });

});
