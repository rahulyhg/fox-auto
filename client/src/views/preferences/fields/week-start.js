
Fox.define('views/preferences/fields/week-start', 'views/fields/enum-int', function (Dep) {

    return Dep.extend({

        setupOptions: function () {
            Dep.prototype.setupOptions.call(this);
            this.params.options.unshift(-1);

            this.translatedOptions = Fox.Utils.clone(this.getLanguage().translate('weekStart', 'options', 'Settings') || {});
            this.translatedOptions[-1] = this.translate('Default') + ' (' + this.getLanguage().translateOption(this.getConfig().get('weekStart'), 'weekStart', 'Settings') +')';
        },

    });

});
