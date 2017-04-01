<link rel="stylesheet" href="/client/css/wui-min.css">
<style>
    .icon { text-align: center; margin-top: 20%;}
    .icon img { width: 30%; height: 30%; margin-bottom: 20px;}
    .text { text-align: center; color: #1cb7f0; font-size: 18px; font-weight: bold; border-bottom: 1px solid; height: 25px }
    .page_title{text-align:center;font-size:28px;color:#5184b0;font-weight:400;margin:0 15%}
    .page_desc{text-align:center;color:#888;font-size:14px}
    .weui-cell:before{left:0 !important;}
    .flow{float: left;margin-right: 9px;margin-bottom: 9px;border: 1px solid #d9d9d9;border-radius: 5px;text-align: center;}
    .flow_selected{background-color: #d34a4f;color: white;}
    .weui-btn_primary {background-color: #5184b0;}
    .border-top{border-top: 1px solid #d9d9d9;}
    .money{color:#d34a4f;font-size:18px;}
    .weui-btn_primary:not(.weui-btn_disabled):active {color: hsla(0,0%,100%,.4);background-color: #5184b0;}
    .weui-cells {margin-top: 0;}
    .weui-dialog__btn_primary {color: #5184b0;}
</style>
<script type="text/javascript">

</script>
<div class="hd">
    <h1 class="page_title">订单处理</h1>
</div>
<div class="weui-cells weui-cells_form">
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">订单号</label></div>
        <div class="weui-cell__bd weui-cell_primary">
            <input class="weui-input" type="text" value="{{data.name}}" readonly>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">手机号</label></div>
        <div class="weui-cell__bd weui-cell_primary">
            <input id="mobile" name="mobile" class="weui-input" type="text" value="{{data.buyer_mobile}}" readonly>
        </div>
        <div class="weui-cell_ft weui-cells__tips">
            <--长按复制
        </div>
    </div>

    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">转移流量</label></div>
        <div class="weui-cell__bd weui-cell_primary">
            <input class="weui-input" type="text" value="{{data.area_name}}{{arrKey flowTypes data.flow_type}} {{arrKey flows data.flow}}" readonly>
        </div>
    </div>

</div>
<div class="weui-cell">
    <div class="weui-cell__hd"><label class="weui-label" style="width:80px;">订单收益</label></div>
    <div class="weui-cell__bd weui-cell_primary">
        <label class="money" id="money">{{getMoney data.money}}</label> 元
    </div>
    <div class="weui-cell_ft">

    </div>
</div>
<div class="weui-cell">
    <div class="weui-cell__hd"><label class="weui-label" style="width:80px;">倒计时</label></div>
    <div class="weui-cell__bd weui-cell_primary" id="countdown">

    </div>
    <div class="weui-cell_ft">

    </div>
</div>
<div class="weui-cells__tips">
    <p>倒计时结束，系统自动取消订单，如果时间不够进行流量转移，请取消订单后重新抢单</p>
</div>

<div class="weui-gallery" id="gallery">
    <span class="weui-gallery__img" id="galleryImg"></span>
    <div class="weui-gallery__opr">
        <a href="javascript:;" class="weui-gallery__del">
            <i class="weui-icon-delete weui-icon_gallery-delete"></i>
        </a>
    </div>
</div>

<div class="weui-cells weui-cells_form">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <div class="weui-uploader">
                <div class="weui-uploader__hd">
                    <p class="weui-uploader__title">图片上传(APP上转移记录截图或转移成功短信截图)</p>
                    <div class="weui-uploader__info"></div>
                </div>
                <div class="weui-uploader__bd" id="img_list">
                    <div class="weui-uploader__input-box">
                        <input id="uploaderInput" class="weui-uploader__input" type="button" accept="image/*" >
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="weui-cells__tips">
    <p>请通过广东移动APP向订单中的手机号码转移流量</p>
</div>
<div class="weui-cells__tips">
    <p><label style="color:red">注意：</label>广东移动APP的iPhone版BUG：直接粘贴号码无法转移，需要手动删除最后一位数字，然后再手动添加，这样处理后，“我要转移”提交按钮才可以进行提交</p>
</div>

<div class="weui-btn_area" style="margin-bottom: 20px;">
    <a class="weui-btn weui-btn_primary"  id="showTooltips">提交审核</a>
</div>


<!--BEGIN dialog-->
<div class="js_dialog" id="dialog" style="display:none;">
    <div class="weui-mask"></div>
    <div class="weui-dialog">
        <div class="weui-dialog__hd"><strong class="weui-dialog_title" id="dialog_title"></strong></div>
        <div class="weui-dialog__bd" id="dialog_content"></div>
        <div class="weui-dialog__ft">
            <a href="javascript:;"  class="weui-dialog__btn weui-dialog__btn_primary">确定</a>
            <a href="javascript:;" data-action="cancel" class="weui-dialog__btn weui-dialog__btn_default">取消</a>
        </div>
    </div>
</div>
<!--END dialog-->
<!--BEGIN toast-->
<div id="toast" style="display: none;">
    <div class="weui-mask_transparent"></div>
    <div class="weui-toast">
        <i class="weui-icon_msg weui-icon-warn"></i>
        <p class="weui-toast__content" id="toast_content"></p>
    </div>
</div>
<!--end toast-->
<div id="loadingToast" class="weui-loading_toast" style="display: none;">
    <div class="weui-mask_transparent"></div>
    <div class="weui-toast">
        <i class="weui-loading weui-icon_toast"></i>
        <p class="weui-toast__content">请求处理中</p>
    </div>
</div>