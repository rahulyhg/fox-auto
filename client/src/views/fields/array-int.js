

Fox.define('views/fields/array-int', 'views/fields/array', function (Dep) {

    return Dep.extend({

        type: 'arrayInt',

        addValue: function (value) {
            value = parseInt(value);
            if (isNaN(value)) {
                return;
            }
            Dep.prototype.addValue.call(this, value);
        },

        removeValue: function (value) {
            value = parseInt(value);
            if (isNaN(value)) {
                return;
            }
            Dep.prototype.removeValue.call(this, value);
        }

    });
});

