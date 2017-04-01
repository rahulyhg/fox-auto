
Fox.define('views/preferences/fields/language', 'views/fields/enum', function (Dep) {

    return Dep.extend({

        setupOptions: function () {
            this.params.options = Fox.Utils.clone(this.getConfig().get('languageList'));

            this.params.options.unshift('');

            this.translatedOptions = Fox.Utils.clone(this.getLanguage().translate('language', 'options') || {});

            var defaultTranslated =  this.translatedOptions[this.getConfig().get('language')] || this.getConfig().get('language');

            this.translatedOptions[''] = this.translate('Default') + ' (' + defaultTranslated + ')';
        },

    });

});
