Fox.define('Views.Company.Wxorder', ['View', 'lib!wx'], function (Dep) {
    return Dep.extend({
        template: 'company.wxorder',

        data: function () {
            return {
                data: __data__.row,
                flowTypes: {
                    1: "电信", 2: "移动", 3: "联通"
                },
                flows: {0: "500M", 1: "1G", 2: "2G", 3: "3G"},
            };
        },

        setup: function () {
            wx.config(__data__.config)

            wx.error(function(res) {});
        },

        events: {
            'click .weui-gallery__del': function() {
                var imgId = this.delImg()
                http({
                    url: "/?entryPoint=Order&a=delImg&id=" + imgId + '&orderId=' +  __data__.orderId,
                    success: function(data) {

                    }
                })
            },
            'click #showTooltips': function() {
                var self = this
                var imgs = '';
                $('#img_list > ul').each(function(i,item){ imgs += $(this).children().attr('data-imgid')+',';});
                if (imgs.length <= 0) {
                    self.showDialog('请选择APP上流量转移记录截图或转移成功短信截图','无法提交');
                    return ;
                }
                if (__data__.row.status == 1) {
                    self.showDialog('您已提交过申请，无需重复提交','无法提交');
                    return ;
                }

                http({
                    url: '/?entryPoint=Order&a=Submit&id=' + __data__.orderId,
                    success: function (data) {
                        switch (parseInt(data.status)) {
                            case 1:
                                self.showToast('提交成功，系统审核通过后，收入自动到账');
                                break;
                            default:
                                self.showDialog(data.msg,'提交出错');
                                break;
                        }
                        return false;
                    },
                });
            },
            'click #uploaderInput': function() {
                var self = this
                var images = {}

                wx.chooseImage({
                    count:1,
                    sizeType: ['compressed'],
                    success: function(res) {
                        images.localId = res.localIds;
                        if (images.localId.length == 0) {
                            self.showToast('请先选择图片');
                            return;
                        }
                        if (images.localId.length > 1) {
                            self.showToast('一次只能上传一张图片');
                            return;
                        }
                        var i = 0, length = images.localId.length;
                        images.serverId = [];

                        function upload() {
                            self.localIdStr = images.localId[i];
                            wx.uploadImage({
                                localId: images.localId[i],
                                isShowProcess: 1,
                                success: function(res) {
                                    i++;
                                    images.serverId.push(res.serverId);
                                    self.downloadImg(res.serverId);
                                    if (i < length) {
                                        upload();
                                    }
                                },
                                fail: function(res) {
                                    //alert(JSON.stringify(res));
                                }
                            });
                        }
                        upload();
                    }
                });

            }
        },

        afterRender: function() {
            var imgs = __data__.row.imgs || []
            for (var i in imgs) {
                this.displayImg(imgs[i].id, imgs[i].src)
            }

            var self = this
            var images = {
                localId: [],
                serverId: []
            };
            self.localIdStr = '';

            $(document).ready(function(){
                //倒计时
                $('#countdown').html('<span id="hour"></span>:<span id="mini"></span>:<span id="sec"></span>');
                var obj = {
                    sec: document.getElementById("sec"),
                    mini: document.getElementById("mini"),
                    hour: document.getElementById("hour")
                }
                self.fnTimeCountDown(__data__.row.time, __data__.now, obj, self.timeout);
            });

        },

        timeout: function() {
            //倒计时结束时回调函数
            alert('订单已进入自动取消队列，请不要继续进行转移，订单自动取消后会重新进入抢单列表');
            window.location = '/?entryPoint=Home'
        },

        delImg: function() {
            var img_id = $('#galleryImg').children().attr('data-img-id');
            $('#img_'+img_id).remove();
            return img_id
        },

        initGallery: function() {
            var tmpl = '<li data-img-id="#id#"><img class="gallery-img" src="#url#"></li>',
                $gallery = $("#gallery"), $galleryImg = $("#galleryImg"),
                $uploaderFiles = $(".uploaderFiles");


            $uploaderFiles.on("click", function(){
                var src = $(this).children().children().attr('src');
                var id = $(this).children().attr('data-imgid');
                tmpl = tmpl.replace('#id#', id);
                $galleryImg.html($(tmpl.replace('#url#', src)));
                $galleryImg.attr("style", this.getAttribute("style"));
                $gallery.fadeIn(100);
            });
            $gallery.on("click", function(){
                $gallery.fadeOut(100);
            });
        },

        //倒计时处理
        fnTimeCountDown: function(d, now, o, callback) {
            var f = {
                zero: function(n){
                    var n = parseInt(n, 10);
                    if(n > 0){
                        if(n <= 9){
                            n = "0" + n;
                        }
                        return String(n);
                    }else{
                        return "00";
                    }
                },
                dv: function() {
                    //现在将来秒差值
                    var dur = Math.round(d - now), pms = {
                        sec: "00",
                        mini: "30",
                        hour: "00",
                        day: "00",
                        month: "00",
                        year: "0",
                        stop:false
                    };
                    if(dur > 0){
                        pms.sec = f.zero(dur % 60);
                        pms.mini = Math.floor((dur / 60)) > 0? f.zero(Math.floor((dur / 60)) % 60) : "00";
                        pms.hour = Math.floor((dur / 3600)) > 0? f.zero(Math.floor((dur / 3600)) % 24) : "00";
                        pms.day = Math.floor((dur / 86400)) > 0? f.zero(Math.floor((dur / 86400)) % 30) : "00";
                        //月份，以实际平均每月秒数计算
                        pms.month = Math.floor((dur / 2629744)) > 0? f.zero(Math.floor((dur / 2629744)) % 12) : "00";
                        //年份，按按回归年365天5时48分46秒算
                        pms.year = Math.floor((dur / 31556926)) > 0? Math.floor((dur / 31556926)) : "0";
                    }else{
                        pms.stop = true;//倒计时结束
                    }
                    return pms;
                },
                ui: function() {
                    now ++;
                    if(o.sec){
                        o.sec.innerHTML = f.dv().sec;
                    }
                    if(o.mini){
                        o.mini.innerHTML = f.dv().mini;
                    }
                    if(o.hour){
                        o.hour.innerHTML = f.dv().hour;
                    }
                    if(o.day){
                        o.day.innerHTML = f.dv().day;
                    }
                    if(o.month){
                        o.month.innerHTML = f.dv().month;
                    }
                    if(o.year){
                        o.year.innerHTML = f.dv().year;
                    }

                    if(f.dv().stop){//计时结束，回调
                        callback();
                    }else{
                        setTimeout(f.ui, 1000);
                    }
                }
            };
            f.ui();
        },

        // 显示图片
        displayImg: function(id, src) {
            var img        = new Image(),
                ul         = document.createElement('ul'),
                li         = document.createElement('li');

            ul.className = 'weui-uploader__files uploaderFiles';
            li.className = 'weui-uploader__file';
            li.appendChild(img);
            ul.appendChild(li);

            img.src = src;
            ul.id = 'img_' + id;
            li.dataset.imgid = id;

            document.querySelector('#img_list').appendChild(ul);

            this.initGallery();//初始化gallery
        },

        downloadImg: function(serverId) {
            var self = this
            http({
                url: '/?entryPoint=Order&a=DownloadImg&imgId='+serverId + '&orderId=' + __data__.orderId,
                success: function (data) {
                    if (data.status){
                        //图片成功下载至服务器，显示图片
                        self.displayImg(data.id, self.localIdStr)
                    }else{
                        alert(data.msg);
                    }
                },
            });
        },

        showDialog: function(content, title) {
            $('#dialog_title').html(title);
            $('#dialog_content').html(content);
            $('#dialog').show().on('click', '.weui-dialog__btn', function () {
                $('#dialog').off('click').hide();
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

