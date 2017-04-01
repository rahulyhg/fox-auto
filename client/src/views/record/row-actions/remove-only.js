

Fox.define('views/record/row-actions/remove-only', 'views/record/row-actions/default', function (Dep) {

    return Dep.extend({

        getActionList: function () {
            if (this.options.acl.edit) {
                return [
                    {
                        action: 'quickRemove',
                        label: 'Remove',
                        data: {
                            id: this.model.id
                        }
                    }
                ];
            }
        },

    });

});


