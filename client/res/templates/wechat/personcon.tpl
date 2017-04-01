<!--<link href="{{css}}" rel="stylesheet" type="text/css">-->
<link href="http://wx.quantcent.com/assets/css/public.css" rel="stylesheet" type="text/css">
<link href="http://wx.quantcent.com/assets/css/frozen.css" rel="stylesheet" type="text/css">
<script>
    $(window).load(function () {
        $("#status").fadeOut();
        $("#preloader").delay(350).fadeOut("slow");
    })
</script>
<style>
    .demo{width:300px;margin:40px auto 0 auto;}
    .demo .lie{margin:0 0 20px 0;}
    .news_index {width: 90%}
    #name { margin: 8 0 10 30px; background: #f8f9fa}
    #name img { width: 30px; height: 30px}
    #name label {margin-left: 40px; margin-top: -25px; display: block; color: #999; font-size: 16px}
    table{text-align: left;}  
    table tr{ border-bottom:1px solid #CCC; height:40px; text-indent:1em;}
    table tr td { width:50%;} 
    .sub{ border: none;float:left;margin-top: 50px; font-size:17px;color:#fff; background:#d34a4f; border-radius:5px; padding:10px; text-align:center; width:90%; margin-left:5%}
    select{ color:#999}
    input{ color:#999}
</style>
</head>

<body>
    <div class="mobile">
        <!--页面加载 开始-->
        <form action="" id="personform" method="post">
            <div class="news_index w" style="width:100%">
                <table style="width:100%;margin:0 auto">
                    <tr>
                        <td>昵称</td>
                        <td><input name="name" value="{{{name}}}" type="text" placeholder="请输入昵称" /></td>
                    </tr>
                    <tr>
                        <td>姓名</td>
                        <td><input name="full_name" value="{{{full_name}}}" type="text" placeholder="请输入真实姓名" /></td>
                    </tr>
                    <tr>
                        <td>性别</td>
                        <td>
                            <select name="sex" id="sexselect">
                                {{{sex}}}
                            </select>
                        </td>
                    </tr>
                </table>
                <div id="datePlugin"></div>
                <div style="width:100%; height:15px; background:#dddddd"></div>
                <table style="width:100%;margin:0 auto">
                    <tr>
                        <td>支付宝</td>
                        <td><input name="zfb" value="{{{zfb}}}" type="text" placeholder="请输入支付宝" /></td>
                    </tr>
                    <tr>
                        <td>手机号</td>
                        <td><input name="mobile" value="{{{mobile}}}" type="text" placeholder="请输入手机号码" /></td>
                    </tr>
                    <tr>
                        <td>微信</td>
                        <td><input name="wechat_no" value="{{{wechat_no}}}" type="text" placeholder="请输入微信号" /></td>
                    </tr>
                </table>
                <div style="width:100%; height:15px; background:#dddddd"></div>
            </div>
            <input class="mySubForm sub" data-id="SaveForm" type="button" value="确定" />
        </form>
    </div>

</body>
</html>