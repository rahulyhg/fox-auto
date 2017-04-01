/**
 * Created by jqh on 2017/2/22.
 */
Fox.define('views/wechat/bill-rows', 'views/wechat/rows-base', function (Dep) {
    return Dep.extend({
        template: 'wechat/bill-rows',

        data: function() {
            var self = this
            return {
                total: self.__data.total,
                rows: self.__data.rows,

                froms: {
                    1: "流量转移", 2: "粉丝流量转移", 3: "购买流量"
                }
            }
        },
    })
})
