

Fox.define('views/admin/field-manager/fields/source-list', 'views/fields/multi-enum', function (Dep) {

    return Dep.extend({

        setupOptions: function () {
            this.params.options = Fox.Utils.clone(Object.keys(this.getMetadata().get('entityDefs.Attachment.sources') || {}));

            this.translatedOptions = {};
            this.params.options.forEach(function (item) {
                this.translatedOptions[item] = this.translate(item, 'scopeNamesPlural');
            }, this);
        }
    });

});
