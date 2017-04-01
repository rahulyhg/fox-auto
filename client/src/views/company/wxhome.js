Fox.define('Views.Company.Wxhome', 'View', function (Dep) {
    return Dep.extend({
        template: 'company.wxhome',

        el: '#main',

        flows: {
            "0": "500M", "1": "1G", "2": "2G", "3": "3G"
        },

        flowTypes: {
            1: "电信", 2: "移动", 3: "联通"
        },

        list: null,

        data: function () {
            var self = this
            return {
                flowTypes: self.flowTypes,
                flows: self.flows,
                list: __data__.rows,
                areas: __data__.areas,
            };
        },

        afterRender: function() {
            if (__data__.setBelongs) {
                this.showUpdateBelongs()
            }
        },

        setup: function() {

        },

        events: {
            'click a[data-action="reload"]': function(e) {
                console.log('/?entryPoint=Home&page=' + __data__.page)
                window.location.replace('/?entryPoint=Home&page=' + __data__.page)
            },
            'click a[data-action="update-belongs"]': function(e) {
                // 修改归属信息
                this.showUpdateBelongs()
            },
            'click .weui-cells .weui-cell': function (e) {
                this.showLoading();
                var $target = $(e.currentTarget);
                var action = $target.data('id');
                var data = $target.data();
                var self = this

                http({
                    url: '/?entryPoint=Home&a=Grab&id=' + action,
                    success: function (data) {
                        self.hideLoading()
                        switch (data.status) {
                            case 5:
                        alert('need phone number')
                                break;
                            case 1:
                                window.location.href = '?entryPoint=Order&id=' + data.oid;
                                break;
                            default:
                                alert(data.msg)
                        }
                    },
                    error: function(d) {
                        self.hideLoading()
                        alert(d)

                    }
                })
            },
        },

        updateBelongs: function() {
            this.showLoading()
            var self = this
            var area = $('.p_area').val(), type = $('.p_type').val()

            http({
                url: '/?entryPoint=Home&a=SetBelongsTo&type=' + type + '&area=' + area,
                success: function(data) {
                    self.hideLoading()
                    if (data.status == 1) {
                        alert('设置成功')
                        window.location.replace('/?entryPoint=Home&page=' + __data__.page)
                        return true
                    }

                    alert(data.msg)
                    return false
                }
            })
            return true
        },

        showUpdateBelongs: function() {
            var content = ''
            content = '<select class="form-control p_type">'

            for (var i in this.flowTypes) {
                content += '<option value="' + i + '">' + this.flowTypes[i] + '</option>'
            }
            content += '</select>'
                + '<select class="form-control p_area">'

            for (var j in __data__.areas) {
                if (j == 100) {
                    continue
                }
                content += '<option value="' + j + '">' + __data__.areas[j] + '</option>'
            }
            content += '</select>'

            this.showDialog(content, '请选择归属地和运营商信息', this.updateBelongs)
        },

        showDialog: function(content, title, callback) {
            var self = this
            $('#dialog_title').html(title);
            $('#dialog_content').html(content);
            $('#dialog').show().on('click', '.weui-dialog__btn', function (e) {
                if ($(e.currentTarget).attr('data-action') == 'cancel') {
                    return $('#dialog').off('click').hide();
                }
                if (callback) {
                    callback.call(self)
                    $('#dialog').off('click').hide();
                } else {
                    $('#dialog').off('click').hide();
                }
            });
        },

        showToast: function(content, time) {
            time = time || 5500
            $('#toast').show();
            $('#toast_content').html(content);
            setTimeout(function () {
                $('#toast').hide();
            }, time);
        },

        showLoading: function () {
            this.$el.find('#loadingToast').show();
        },

        hideLoading: function () {
            this.$el.find('#loadingToast').hide();
        },


    });
});

