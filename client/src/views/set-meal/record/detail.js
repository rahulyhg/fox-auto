/**
 * Created by jqh on 2017/2/28.
 */
Fox.define('views/set-meal/record/detail', 'views/record/detail', function (Dep, ViewRecordHelper) {
    return Dep.extend({

        // 只能新增不能修改
        save: function(callback) {
            delete this.model.id
            delete this.model.attributes.id

            this.isNew = true

            return Dep.prototype.save.call(this, callback)
        }
    })
})
