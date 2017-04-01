

Fox.define('views/home', 'view', function (Dep) {

    return Dep.extend({

        template: 'home',

        el: '#main',

        setup: function () {
            this.createView('dashboard', 'views/dashboard', {
                el: this.options.el + ' > .home-content'
            });

        }

    });
});

