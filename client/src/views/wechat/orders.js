/**
 * Created by jqh on 2017/2/17.
 */
Fox.define('views/wechat/orders', 'view', function (Dep) {
    return Dep.extend({
        template: 'wechat/orders',

        api: '/?entryPoint=Orders',

        __data: null,

        views: {
            rows: {
                el: "#wechat_list",
                view: 'views/wechat/orders-rows'
            }
        },

        data: function() {
            return {
                css: '/client/css/wechat-mobile.css',

                total: __data__.total,
                title: '',
                type: __data__.type,
                rowNum: __data__.rowNum,

                // 全部订单
                allUrl: "/?entryPoint=Orders",
                // 待处理订单
                waitUrl: "/?entryPoint=Orders&type=wait",
                // 已处理订单
                finishedUrl: "/?entryPoint=Orders&type=finished",
                // 转移成功订单
                successUrl: "/?entryPoint=Orders&type=success",
                // 卖流量抢单首页
                homeUrl: "/?entryPoint=Home",
                personUrl: "/?entryPoint=Person",

                homeImg: "http://wx.quantcent.com/assets/images/no_men.png",
                personImg: "http://wx.quantcent.com/assets/images/ren.png",

            }
        },

        afterRender: function () {
            this.loadd()

        },

        loadd: function() {
            var ajax_flag = true;
            var loading ='<img src="http://wx.quantcent.com/assets/images/loading.gif">正在加载中';
            var nodata = '已加载全部数据';
            var total = parseInt(__data__.total);
            var page = parseInt(this.page);
            var status = 'all';
            var shipping_callback = '';
            var self = this;
            var w = ''

            $(window).bind("scroll", function(){
                var more = $("#more_Infor_btn");
                var $this = $(this),
                    viewH = $(document.body).height(),//可见高度
                    contentH = $(window).height(),//内容高度
                    scrollTop = $(this).scrollTop(),//滚动高度
                    newht = viewH - contentH - scrollTop;
                w = contentH - viewH - scrollTop;
                if (__data__.rows.length < __data__.rowNum || total <= ((page - 1) * __data__.rowNum + __data__.rowNum)) {
                    $("#more_Infor").show();
                    more.unbind().html(nodata);
                    return;
                }
                if (w <= 30) {
                    $("#more_Infor").show();
                    if(!ajax_flag) return;
                    ajax_flag = false;

                    $.ajax({
                        type: 'GET',
                        async: true,
                        dataType : 'json',
                        url: self.api,
                        data: 'status='+status+'&p='+page,
                        beforeSend: function(){
                            more.html(loading);
                        },
                        success: function (data) {
                            switch (parseInt(data.state)) {
                                case 1:
                                    page = data.page;


                                    $('#wechat_list').append(val);
                                    more.unbind().html('点击加载更多数据');
                                    break;
                                default:
                                    more.unbind().html('点击加载更多数据');
                                    break;
                            }
                            $(".lazy").lazyload();
                            ajax_flag = true;
                            return false;
                        },
                        error: function () {
                            more.unbind().html('点击加载更多数据');
                            ajax_flag = true;
                        },
                        cache: false

                    });
                }
            });
        }

    })
})
