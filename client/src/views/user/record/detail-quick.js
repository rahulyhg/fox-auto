

Fox.define('views/user/record/detail-quick', 'views/user/record/detail', function (Dep) {

    return Dep.extend({

        sideView: 'views/user/record/detail-quick-side',

        bottomView: null,

        editModeEnabled: false,

        setup: function () {
            Dep.prototype.setup.call(this);

        }

    });

});

