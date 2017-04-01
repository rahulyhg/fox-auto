/**
 * Created by jqh on 2017/2/22.
 */
/**
 * Created by jqh on 2017/2/22.
 */
Fox.define('views/wechat/rows-base', 'view', function (Dep) {
    return Dep.extend({
        template: null,

        api: '',

        __data: null,

        setup: function() {
            this.__data = __data__
        },

        data: function() {
            var self = this
            return {
                total: self.__data.total,
                rows: self.__data.rows,
            }
        },

        loadd: function() {
            var ajax_flag = true;
            var loading ='<img src="http://wx.quantcent.com/assets/images/loading.gif">正在加载中';
            var nodata = '已加载全部数据';
            var status = 'all';
            var shipping_callback = '';
            var self = this;
            var w = ''

            $(window).bind("scroll", function() {
                var total = parseInt(self.__data.total);
                var page = parseInt(self.__data.page);
                var nextPage = parseInt(self.__data.page) + 1;

                var more = $("#more_Infor_btn");
                var $this = $(this),
                    viewH = $(document.body).height(),//可见高度
                    contentH = $(window).height(),//内容高度
                    scrollTop = $(this).scrollTop(),//滚动高度
                    newht = viewH - contentH - scrollTop;
                w = contentH - viewH - scrollTop;
                if (self.__data.rows.length < self.__data.rowNum || total <= ((page - 1) * self.__data.rowNum + self.__data.rowNum)) {
                    $("#more_Infor").show();
                    more.unbind().html(nodata);
                    return;
                }

                if (w <= 50) {
                    $("#more_Infor").show();
                    if (! ajax_flag) return;
                    ajax_flag = false;

                    $.ajax({
                        type: 'GET',
                        dataType : 'json',
                        url: self.api,
                        data: 'api=1' + '&page='+nextPage,
                        beforeSend: function(){
                            more.html(loading);
                        },
                        success: function (data) {
                            self.__data = data

                            self._getTemplate(function(a) {
                                self.$el.append(a.call(self, self.data()))
                            })

                            more.unbind().html('点击加载更多数据');

                            ajax_flag = true;
                            return false;
                        },
                        error: function () {
                            more.unbind().html('点击加载更多数据');
                            ajax_flag = true;
                        }

                    });
                }
            });
        },

        afterRender: function() {
            this.loadd()
        },

    })
})

