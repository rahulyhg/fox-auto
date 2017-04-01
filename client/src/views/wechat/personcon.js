/**
 * Created by jqh on 2017/2/16.
 */
Fox.define('views/wechat/personcon', 'view', function (Dep) {

    return Dep.extend({
        template: 'wechat/personcon',

        data: function () {
            return {
                name: __data__.name,            //昵称
                mobile: __data__.mobile,        //手机号
                full_name: __data__.full_name,  //姓名
                wechat_no: __data__.wechat_no,  //微信号
                sex: this.getselect(__data__.sex), //性别选项
                zfb: __data__.zfb,              //支付宝
                css: "/client/css/wechat-mobile.css",

                incomeImg: "",
                rightImg: "http://wx.quantcent.com/assets/images/tou1.png",
                rightImg1: "http://wx.quantcent.com/assets/images/tou.png",
                waitImg: "http://wx.quantcent.com/assets/images/wp.png",
                handledImg: "http://wx.quantcent.com/assets/images/ws.png",
                finishedImg: "http://wx.quantcent.com/assets/images/wr.png",
                homeImg: "http://wx.quantcent.com/assets/images/no_men.png",
                personImg: "http://wx.quantcent.com/assets/images/ren.png",
            }
        },

        setup: function () {

        },

        events: {
            'click .sub.mySubForm': function (e) {
                var $target = $(e.currentTarget);
                var action = $target.data('id');
                var data = $('#personform').serialize();
                var mobile = $("input[name='mobile']").val();
                if(mobile ==0 || mobile == ''){
                    alert('请正确填写手机号！');
                    return;
                }
                http({
                    url: '/?entryPoint=Personcon&a=' + action,
                    method: 'POST',
                    data: data,
                    success: function (data) {
                        if (!data.status) {
                            alert(data.msg);
                            return;
                        }
                        alert('信息保存成功！');
                        window.history.go(-1);
                        return;
                    },
                    error: function () {
                    }
                })
            }
        },

        getselect: function (data) {
            data = Number(data);
            var str = '';
            var datalist = [['请选择'], ['男'], ['女']];
            for (var i = 0; i < datalist.length; i++) {
                if (data == i) {
                    str += '<option value="' + i + '" selected>' + datalist[i] + '</option>';
                } else {
                    str += '<option value="' + i + '">' + datalist[i] + '</option>';
                }
            }
            return str;
        }
    })
});