/**
 * Created by jqh on 2017/2/22.
 */
Fox.define('views/wechat/orders-rows', 'views/wechat/rows-base', function (Dep) {
    return Dep.extend({
        template: 'wechat/orders-rows',

        data: function() {
            var self = this
            return {
                total: self.__data.total,
                rows: self.__data.rows,

                status: {0: '未转移', 1: '已处理，待审核', 2: '被投诉', 3: '已取消', 4: '已取消', 5: '审核不通过', 6: '已完成'},
//0刚提交还未审核；1提交后审核成功；2提交后审核不成
//0未充值，1已充值，2已充值被投诉，3订单超时取消，4主动取消，5被投诉取消， 6已完成

                adresses: {0: '全国', 1: '广东', 3: '广西'},
                flowTypes: {1: '移动', 2: '电信', 3: '联通'},
            }
        },
    })
})
