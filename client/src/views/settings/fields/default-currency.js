
Fox.define('views/settings/fields/default-currency', 'views/fields/enum', function (Dep) {

    return Dep.extend({

        setupOptions: function () {
            this.params.options = Fox.Utils.clone(this.getConfig().get('currencyList') || []);
        }

    });

});
