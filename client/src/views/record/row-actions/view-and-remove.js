

Fox.define('views/record/row-actions/view-and-remove', 'views/record/row-actions/default', function (Dep) {

    return Dep.extend({

        getActionList: function () {
            var actionList = [{
                action: 'quickView',
                label: 'View',
                data: {
                    id: this.model.id
                }
            }];
            if (this.options.acl.edit) {
                actionList.push({
                    action: 'quickRemove',
                    label: 'Remove',
                    data: {
                        id: this.model.id
                    }
                });

            }
            return actionList;
        }
    });

});


