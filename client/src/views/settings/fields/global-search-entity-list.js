
Fox.define('Views.Settings.Fields.GlobalSearchEntityList', 'Views.Fields.MultiEnum', function (Dep) {

    return Dep.extend({

        setup: function () {

            this.params.options = Object.keys(this.getMetadata().get('scopes')).filter(function (scope) {
                if (this.getMetadata().get('scopes.' + scope + '.disabled')) return;
                return this.getMetadata().get('scopes.' + scope + '.customizable') && this.getMetadata().get('scopes.' + scope + '.entity');
            }, this).sort(function (v1, v2) {
                return this.translate(v1, 'scopeNamesPlural').localeCompare(this.translate(v2, 'scopeNamesPlural'));
            }.bind(this));

            Dep.prototype.setup.call(this);
        },

    });
});
