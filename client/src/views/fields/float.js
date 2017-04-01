

Fox.define('views/fields/float', 'views/fields/int', function (Dep) {

    return Dep.extend({

        type: 'float',

        editTemplate: 'fields/float/edit',

        decimalMark: '.',

        thousandSeparator: ',',

        validations: ['required', 'float', 'range'],

        setup: function () {
            Dep.prototype.setup.call(this);

            if (this.getPreferences().has('decimalMark')) {
                this.decimalMark = this.getPreferences().get('decimalMark');
            } else {
                if (this.getConfig().has('decimalMark')) {
                    this.decimalMark = this.getConfig().get('decimalMark');
                }
            }
            if (this.getPreferences().has('thousandSeparator')) {
                this.thousandSeparator = this.getPreferences().get('thousandSeparator');
            } else {
                if (this.getConfig().has('thousandSeparator')) {
                    this.thousandSeparator = this.getConfig().get('thousandSeparator');
                }
            }
        },

        getValueForDisplay: function () {
            var value = isNaN(this.model.get(this.name)) ? null : this.model.get(this.name);
            return this.formatNumber(value);
        },

        formatNumber: function (value) {
            if (value !== null) {
                var parts = value.toString().split(".");
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, this.thousandSeparator);
                return parts.join(this.decimalMark);
            }
            return '';
        },

        defineMaxLength: function () {
        },

        validateFloat: function () {
            var value = this.model.get(this.name);
            if (isNaN(value)) {
                var msg = this.translate('fieldShouldBeFloat', 'messages').replace('{field}', this.translate(this.name, 'fields', this.model.name));
                this.showValidationMessage(msg);
                return true;
            }
        },

        parse: function (value) {
            value = (value !== '') ? value : null;
            if (value !== null) {
                value = value.split(this.thousandSeparator).join('');
                value = value.split(this.decimalMark).join('.');
                value = parseFloat(value);
            }
            return value;
        },

        fetch: function () {
            var value = this.$el.find('[name="'+this.name+'"]').val();
            value = this.parse(value);

            var data = {};
            data[this.name] = value;
            return data;
        },
    });
});

