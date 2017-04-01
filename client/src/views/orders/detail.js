/**
 * Created by jqh on 2017/3/10.
 */
Fox.define('views/orders/detail', 'views/detail', function (Dep) {
    return Dep.extend({

        setup: function () {
            Dep.prototype.setup.call(this);

            this.setupMenu();
        },

        setupMenu: function () {
            this.menu.buttons.unshift({
                "label": "审核",
                "action": "examine",
                "style": "danger",
                "acl": "edit"
            });
        },

        actionExamine: function() {
            var self = this
            //if (! this.getAcl().check(this.scope, 'examine')) {
            //    return this.notify('Access denied', 'error');
            //}
            this.notify('loading...')
            this.createView('massUpdate', 'views/vertify/examine', {
                scope: self.scope,
                ids: [self.model.id],
                //where: self.collection.getWhere(),
                c: '',
                //byWhere: self.allResultIsChecked
            }, function (view) {
                view.render();
                view.notify(false);

            }.bind(this));
        },

    });
});

