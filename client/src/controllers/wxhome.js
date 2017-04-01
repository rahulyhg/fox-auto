
Fox.define('controllers/wxhome', 'controller', function (Dep) {

    return Dep.extend({

        index: function () {

            this.entire('Company.Wxhome', {

            }, function (view) {
                view.render();
            });
        },

    });
});

