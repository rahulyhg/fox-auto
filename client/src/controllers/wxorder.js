
Fox.define('controllers/wxorder', 'controller', function (Dep) {
    return Dep.extend({
        index: function () {
            this.entire('Company.Wxorder', {
        }, function (view) {
                view.render();
            });
        },

    });
});

