

Fox.define('crm:views/dashlets/tasks', 'views/dashlets/abstract/record-list', function (Dep) {

    return Dep.extend({

        listViewName: 'crm:views/task/record/list-expanded',

        rowActionsView: 'crm:views/task/record/row-actions/dashlet'

    });
});

