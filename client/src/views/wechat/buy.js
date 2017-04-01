/**
 * Created by jqh on 2017/3/6.
 */
Fox.define('views/wechat/buy', 'view', function (Dep) {
    return Dep.extend({
        template: 'wechat/buy',

        // 是否可以提交充值
        isSend: false,

        // 手机归属信息
        sendData: {
            province: "", company: "", price: 0, selectedAreaId: "", setMealId: "", mobile: ""

        },

        // 选中的地区和流量包
        // 默认为全国, 500M
        selectedData: {
            area: 100, flow: 0
        },

        defaultFlow: {0: "500M", 1: "1G", 2: "2G", 3: "3G"},

        events: {
            'keyup input[name="phoneNum"]': function(e) {
                this.isSend = false

                var self = this
                var v = $(e.currentTarget).val()

                if (! this.checkMobile(v)) {
                    return false
                }

                $.ajax({
                    type: 'GET',
                    async: true,
                    dataType : 'json',
                    url: '/?entryPoint=Buy&a=checkMobile',
                    data: 'mobile=' + v,
                    beforeSend: function() {

                    },
                    success: function (data) {
                        if (! data.status) {
                            return alert(data.msg)
                        }
                        // 校验通过允许提交充值
                        self.isSend = true

                        self.sendData.province = data.province
                        self.sendData.company  = data.company
                        self.sendData.mobile   = v
                        // 显示手机归属信息
                        self.showPhoneBelong(data)
                        // 计算默认套餐包价格
                        self.checkMoney()
                    }
                })

            },
            // 地址
            'click #flowAllBoxStyle .start': function(e) {
                var $this = $(e.currentTarget)
                this.selectedData.area = $this.attr('data-value')

                this.selected($this, '#flowAllBoxStyle')
                this.checkMoney()
            },
            // 流量包
            'click #flowAllBox .start': function(e) {
                var $this = $(e.currentTarget)
                this.selectedData.flow = $this.attr('data-value')

                this.selected($this, '#flowAllBox')
                this.checkMoney()
            },

            'click #sendForm2': function(e) {
                var v = $(e.currentTarget).val()
                // 判断是否允许提交充值申请
                if (! this.isSend) {
                    alert('请输入有效手机号码并选取有效的流量包套餐！')
                    return false
                }

                //if (! confirm("请确认订单信息后下单")) {
                //    return false
                //}


                this.callpay()
                return

                var self = this

                $.ajax({
                    type: 'POST',
                    async: true,
                    dataType : 'json',
                    url: '/?entryPoint=Buy&a=ordering',
                    data: JSON.stringify(self.sendData),
                    beforeSend: function() {

                    },
                    success: function (data) {

                    }
                })
            },
        },

        //调用微信JS api 支付
        jsApiCall: function () {
            WeixinJSBridge.invoke(
                'getBrandWCPayRequest',
                __data__.jsApiParameters,
                function(res) {
                    //WeixinJSBridge.log(res.err_msg);
                    //alert(res.err_code+res.err_desc+res.err_msg);
                }
            );
        },

        callpay: function () {
            if (typeof WeixinJSBridge == "undefined") {
                if ( document.addEventListener ) {
                    document.addEventListener('WeixinJSBridgeReady', this.jsApiCall.bind(this), false);
                } else if (document.attachEvent) {
                    document.attachEvent('WeixinJSBridgeReady', this.jsApiCall.bind(this));
                    document.attachEvent('onWeixinJSBridgeReady', this.jsApiCall.bind(this));
                }
            } else {
                this.jsApiCall()
            }
        },

        afterRender: function () {
            console.log(333,wechatUI)
            wechatUI.alert('ht', 'ttt')

        },

        selected: function($this, id) {
            var $li = $(id + ' .start')
            $li.removeClass('current')
            $this.addClass('current')
        },

        showPhoneBelong: function(data) {
            $('#phoneBelong').val(data.province_zh + '  ' + data.company_zh)
        },

        checkMobile: function(mobile) {
            var patten = /^0?(13[0-9]|15[012356789]|18[0236789]|14[57])[0-9]{8}$/
            if (patten.exec(mobile)) {
                return true
            }
            return false
        },

        // 获取套餐包售价
        checkMoney: function() {
            var areaId = this.sendData.province,// 手机归属地
                type   = this.sendData.company, // 手机运营商类型
                flow   = this.selectedData.flow,// 选择的流量包
                area   = this.selectedData.area,// 选择的地域
                rows   = this.rows

            var selectedAreaId = 100
            // 判断是否为全国，不是则为手机归属地省份
            if (area != 100) {
                selectedAreaId = areaId
            }

            var price = false, price_d = 0, setMealId = ''
            for(var i in rows) {
                if (
                    rows[i].flow == flow && selectedAreaId == rows[i].area_id && type == rows[i].type
                ) {
                    price = price_d = rows[i].selling_price

                    price = parseFloat(price / 1000)
                    price = price.toFixed(2)

                    setMealId = rows[i].id
                }
            }

            if (price) {
                this.isSend                  = true
                this.sendData.price          = price_d
                this.sendData.selectedAreaId = selectedAreaId
                this.sendData.setMealId      = setMealId
                this.sendData.flow           = flow
                return $('#phoneSell').val('￥' + price)
            }

            $('#phoneSell').val('暂无')
            this.isSend = false
        },

        setup: function() {
            this.rows = __data__.rows
        },

        data: function() {
            var self = this
            return {
                flows: self.defaultFlow,
            }
        },
    })
})
