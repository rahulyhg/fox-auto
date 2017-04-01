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
    .weui-btn_plain-primary{border-color: #999;color:#999}
    .border-top{border-top: 1px solid #d9d9d9;}
    .mone
    y{color:#d34a4f;font-size:18px;}
    .weui-btn_primary:not(.weui-btn_disabled):active {color: hsla(0,0%,100%,.4);background-color: #5184b0;}
    .weui-icon_msg:before {font-size: 48px;margin-top:15px;}
    .weui-dialog__btn_primary {color: #5184b0;}
    .weui-btn_area{margin-top:2rem;}
    .form-control {
        margin-bottom: 3px;
        display: block;
        width: 100%;
        height: 33px;
        padding: 6px 10px;
        font-size: 14px;
        line-height: 1.36;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #d1d5d6;
        border-radius: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
        -moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
        box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
        -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        -webkit-transition: all border-color ease-in-out .15s,box-shadow ease-in-out .15s ease-out;
        -moz-transition: all border-color ease-in-out .15s,box-shadow ease-in-out .15s ease-out;
        -o-transition: all border-color ease-in-out .15s,box-shadow ease-in-out .15s ease-out;
        transition: all border-color ease-in-out .15s,box-shadow ease-in-out .15s ease-out;
    }
</style>
<div class="container" id="container">
    <div class="cell">
        <div class="hd">
            <h1 class="page_title">流量转移抢单</h1>
        </div>
        <br/>
        <p>
            &nbsp;<a class="weui-btn_plain-primary" data-action="update-belongs">修改归属信息</a>
        </p>
        {{#if list}}
        {{#each list}}
        <div class="weui-cells" >
            <div class="weui-cell weui-cell_access" data-id="{{this.id}}">
                <div class="weui-cell__bd">
                    <p>{{arrKey ../areas this.area_id}}{{arrKey ../flowTypes this.flow_type}}
                        {{arrKey ../flows this.flow}}</p>
                </div>
                <div class="weui-cell__ft"> &yen;{{getMoney this.money}}  抢单</div>
            </div>
        </div>
        {{/each}}
        {{else}}
    <div class="weui-cells">
        <div class="weui-cell weui-cell_access" data-id="{{this.id}}">
        <div class="weui-cell__bd">
            <p>暂无可抢订单</p>
        </div>

    </div>
</div>
        {{/if}}

        <div class="weui-cells__tips">
            <!--<p>每天11:00-16:00发放购买4G流量的订单，抢完即止。</p>-->
        </div>
        <div class="weui-btn_area">
            <a class="weui-btn weui-btn_primary" href="javascript:;" data-action="reload">换一组</a>
        </div>
    </div>



</div>
</div>


<div style="width:100%; float:left; height:60px;">&nbsp;</div>
<div class="ft">
    <table style="width:100%; text-align:center; margin-top:5px;border:none">
        <tr style="border:none">
            <td onclick=" window.location.href='?entryPoint=Home' " style="width:25%;border:none;border-right: 1px solid #EBEBEB">
                <a href="?entryPoint=home" style="color:#329DEF; font-size: 13px;">
                    <img style="width:20px;" src="http://wx.quantcent.com/assets/images/men.png" /><br/>首页
                </a>
            </td>
            <td onclick=" window.location.href='?entryPoint=Person' " style="width:25%;border:none">
                <a href="?entryPoint=person" style="color:#999; font-size: 13px;">
                    <img style="width:20px;" src="http://wx.quantcent.com/assets/images/no_ren.png" /><br/>个人
                </a>
            </td>
        </tr>
    </table>
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