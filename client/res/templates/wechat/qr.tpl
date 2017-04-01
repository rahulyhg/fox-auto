
    <!--<link href="{{css}}" rel="stylesheet" type="text/css">-->

    <style>
        .ft{position:fixed;bottom:0px;left:0; background:#ffffff; width:100%; height:50px;border-top:1px solid #EBEBEB}
        a { text-decoration:none; color:#000; margin-bottom:auto}
        p { color: black; line-height: 10px; margin-left: 5px; font-size:14px}
        .ui-tab-nav li.current a {font-weight:bold;color:#5184b0; border-bottom-color:#5184b0; font-size:16px}
        #wechat_list{text-align:center}
        .swipebox img{width:3rem;height:3rem;}
        .qr{margin: 0 auto;min-width:300px;max-width: 320px;}
        .remark{border-top:1px solid #5184b0;color:#5184b0;text-align: left;
            font-size: 17px;font-weight: bold;}
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

            </div>
        </div>
    </div>
    <div id="wechat_list">
        <img class="qr" src="{{qrurl}}" />
        <br/>
        <br/>
        <div class="remark">
            <br/>
            {{{remark}}}
        </div>
    </div>
</div>

