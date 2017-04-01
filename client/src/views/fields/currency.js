

Fox.define('views/fields/currency', 'views/fields/float', function (Dep) {

    return Dep.extend({

        type: 'currency',

        editTemplate: 'fields/currency/edit',

        detailTemplate: 'fields/currency/detail',

        listTemplate: 'fields/currency/detail',

        data: function () {
            return _.extend({
                currencyFieldName: this.currencyFieldName,
                currencyValue: this.model.get(this.currencyFieldName) || this.getPreferences().get('defaultCurrency') || this.getConfig().get('defaultCurrency'),
                currencyOptions: this.currencyOptions,
                currencyList: this.currencyList
            }, Dep.prototype.data.call(this));
        },

        setup: function () {
            Dep.prototype.setup.call(this);
            this.currencyFieldName = this.name + 'Currency';
            this.currencyList = this.getConfig().get('currencyList') || ['USD'];
            var currencyValue = this.currencyValue = this.model.get(this.currencyFieldName) || this.getConfig().get('defaultCurrency');
        },

        formatNumber: function (value) {
            if (value !== null) {
                var parts = value.toString().split(".");
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, this.thousandSeparator);
                if (parts.length > 1) {
                    if (parts[1].length == 1) {
                        parts[1] += '0';
                    } else if (parts[1].length > 2) {
                        if (this.mode != 'edit') {
                            var fixed = value.toFixed(2);
                            parts[1] = fixed.split(".")[1];
                        }
                    }
                }
                return parts.join(this.decimalMark);
            }
            return '';
        },

        afterRender: function () {
            Dep.prototype.afterRender.call(this);
            if (this.mode == 'edit') {
                this.$currency = this.$el.find('[name="' + this.currencyFieldName + '"]');
                this.$currency.on('change', function () {
                    this.model.set(this.currencyFieldName, this.$currency.val());
                }.bind(this));
            }
        },

        fetch: function () {
            var value = this.$element.val();
            value = this.parse(value);

            var data = {};

            var currencyValue = this.$currency.val();
            if (value === null) {
                currencyValue = null;
            }

            data[this.name] = value;
            data[this.currencyFieldName] = currencyValue
            return data;
        },
    });
});

