/**
 * Created by jqh on 2017/2/27.
 */
Fox.define('views/set-meal/record/list', 'views/record/list', function (Dep) {
    return Dep.extend({
        massActionList: ['examine'],

        checkAllResultMassActionList: ['examine'],

        setup: function() {
            Dep.prototype.setup.call(this)

        },

        massActionExamine: function (item) {
            //console.log(123456, this.collection.get('58a297e8d6add3795').attributes)

            var self = this
            //if (! this.getAcl().check(this.scope, 'examine')) {
            //    return this.notify('Access denied', 'error');
            //}
            this.notify('loading...')
            this.createView('massUpdate', 'views/vertify/examine', {
                scope: self.scope,
                ids: self.checkedList,
                where: self.collection.getWhere(),
                c: self.collection,
                byWhere: self.allResultIsChecked
            }, function (view) {
                view.render();
                view.notify(false);

            }.bind(this));

        },
    })
})
