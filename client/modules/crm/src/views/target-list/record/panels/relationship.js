

Fox.define('crm:views/target-list/record/panels/relationship', 'views/record/panels/relationship', function (Dep) {

    return Dep.extend({

        fetchOnModelAfterRelate: true,

        actionOptOut: function (data) {
            if (confirm(this.translate('confirmation', 'messages'))) {
                $.ajax({
                    url: 'TargetList/action/optOut',
                    type: 'POST',
                    data: JSON.stringify({
                        id: this.model.id,
                        targetId: data.id,
                        targetType: data.type
                    })
                }).done(function () {
                    this.collection.fetch();
                    Fox.Ui.success(this.translate('Done'));
                    this.model.trigger('opt-out');
                }.bind(this));
            }
        }

    });
});

