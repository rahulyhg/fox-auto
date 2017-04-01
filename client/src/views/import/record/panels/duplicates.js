

Fox.define('views/import/record/panels/duplicates', 'views/import/record/panels/imported', function (Dep) {

    return Dep.extend({

        link: 'duplicates',

        actionUnmarkAsDuplicate: function (data) {
            var id = data.id;
            var type = data.type;

            if (confirm(this.translate('confirmation', 'messages'))) {
                this.ajaxPostRequest('Import/action/unmarkAsDuplicate', {
                    id: this.model.id,
                    entityId: id,
                    entityType: type
                }).then(function () {
                    this.collection.fetch();
                });
            }
        }

    });
});

