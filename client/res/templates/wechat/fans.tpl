
    <!--<link href="{{css}}" rel="stylesheet" type="text/css">-->

    <style>
        .ft{position:fixed;bottom:0px;left:0; background:#ffffff; width:100%; height:50px;border-top:1px solid #EBEBEB}
        a { text-decoration:none; color:#000; margin-bottom:auto}
        p { color: black; line-height: 10px; margin-left: 5px; font-size:14px}
        .ui-tab-nav li.current a {font-weight:bold;color:#5184b0; border-bottom-color:#5184b0; font-size:16px}
        .top_l { margin-top: -20px; margin-bottom: -17px;}
        .top_r {float:right; margin-top: -17px; margin-bottom: 10px;}
        .button_blue { font-size: 14px;  width: 70px; background: #d34a4f; padding: 5px 20px; color: white; border-radius: 5px; border:none; margin-right:8px; }
        .button_red {font-size: 14px;  width: 70px; background: #D14;  padding: 5px 20px;color: white; border-radius: 5px; border:none; margin-right:8px; }
        .button_gray {font-size: 14px;  width: 70px; background: #999;  padding: 5px 20px;color: white; border-radius: 5px; border:none; margin-right:8px; }
        .button_orange {  width: 70px; height: 30px; background: orange; cellpadding: 10px; color: white; border-radius: 5px; border:none; margin-right:8px; margin-top:15px}
        .gap {margin:0; margin-top:10px;width:100%; height:50px; float:left; border-bottom:1px solid #F2F2F2;}
        .goods {float:left; margin-left:20px; margin-top:20px; color:#000}
        .goods_li { margin-bottom:10px; width:230px; overflow:hidden; font-size:16px;}
        .goods_lis { margin-bottom:10px; width:230px; overflow:hidden; font-size:15px; color:#666666}
        .shop_flag { width:40px; height:40px; margin-left:20px }
        .shopname {float:left; margin-top:15px;}
        .ord_status { margin-right:8px}
        .swipebox img{width:3rem;height:3rem;}
        /*.content2{font-size:16px; width:200px; height:20px;text-overflow:ellipsis;white-space: nowrap; overflow: hidden}*/
    </style>

<div class="mobile" >
    <!--页面加载 开始-->
    <!--<div id="preloader">-->
        <!--<div id="status">-->
            <!--<p class="center-text"><span>拼命加载中···</span></p>-->
        <!--</div>-->
    <!--</div>-->
    <div class="baoliao" >
        <div class="user_nav_list w" style="width:100%">
            <div class="ui-tab" >
                <ul class="ui-tab-nav">
                    <li  class="" style="border-right:1px solid #ccc">
                        <a>{{#if total}}我的粉丝（{{total}}）{{else}}暂无数据{{/if}}</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <div id="wechat_list">
        {{{rows}}}

    </div>
</div>

<div id="more_Infor" class="w"><span id="more_Infor_btn">上拉加载更多数据</span></div>

<div style="width:100%; float:left; height:60px;">&nbsp;</div>

<div class="ft">
    <table style="width:100%; text-align:center; margin-top:5px;border:none">
        <tr style="border:none">
            <td onclick=" window.location.href='{{homeUrl}}' " style="width:25%;border:none;border-right: 1px solid #EBEBEB">
                <a href="{{homeUrl}}" style="color:#999; font-size: 13px;">
                    <img style="width:20px;" src="{{homeImg}}" /><br/>首页
                </a>
            </td>

            <td onclick=" window.location.href='{{personUrl}}' " style="width:25%;border:none">
                <a href="{{personUrl}}" style="color:#329DEF; font-size: 13px;">
                    <img style="width:20px;" src="{{personImg}}" /><br/>个人
                </a>
            </td>
        </tr>
    </table>
</div>

</div>

