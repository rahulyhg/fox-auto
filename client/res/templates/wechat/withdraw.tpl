
    <!--<link href="{{css}}" rel="stylesheet" type="text/css">-->

    <style>
    .ft{position:fixed;bottom:0px;left:0; background:#ffffff; width:100%; height:60px;}
    a{text-decoration:none;}
    .ft .l{ float:left;color:#666666; margin-top:10px; margin-left:10%; background:#329def; width:80%; border-radius:5px; padding:10px; text-align:center; color:#fff}
    .ft .l img{background-repeat: no-repeat; width:30px;}
    .ft .r{ float:right;color:#666666; margin-right:90px; margin-top:5px;}
    .ft .r img{background-repeat: no-repeat; width:30px;}
    .t{float:left; margin:30px 0 0 10px; font-size:20px; color:#FFF}
    .ts{float:right; margin-top:25px; margin-right:20px; color:#FFF; font-size:35px;}
    .s{float:right;color:#fff; margin-right:2%; margin-top:10px; background:#d34a4f; padding:5px; border-radius:5px;}
    .cont {
        width: 80%;border: none;height: 40px;margin-right: 10%;margin-left: 10%;border-color:#f8f8f8;
    }
    input {
        font-size: 15px;
    }
    .bg{background-color: #666666;width: 100%;height: 100%;left: 0px;top: 0px;opacity: 0.8;z-index: 1;position: fixed; display: none}
    .show_div { display: none; position: absolute; width: 500px;  top: 20px; left: 400px; z-index: 999;background: #ccc;}
    .share { width: 100%; height: 120px; background: #fff; text-align: center; position: fixed; bottom: 0; left: 0}
    .share p { line-height: 25px; color: #000}
    .share p img { width: 60px; height: 60px}
    .share tr td{ width: 25%}
    .enchashment{color:#fff; background:#5184b0; border-radius:0px; padding:10px; text-align:center; width:80%; margin-left:9%; margin-right:9%;display: block;border:none}
    .disable{background:#ddd;color: #0e0e0e}
</style>
</head>

<body>
<div class="mobile">
    <div class="user_nav_list w" style=" width:99.5%">
        <ul>
            <li style="height:230px;">
                <a>
                    <div class="u_nav_icon" style="font-size:16px; color:#5184b0; width:50px;">注意：</div>
                    <p>&nbsp;</p>
                    <p style=" margin-left:2%; margin-right:2%">
                        1、用户在成功申请提现后，本平台运营人员核对无误的情况下，提现金额1-3个工作日通过微信红包发放，请24小时内访问“量讯流量共享”公众号领取。
                    </p>
                    <p style=" margin-left:2%; margin-right:2%">
                        2、提现金额<label style="color:red">1元</label>起提。
                    </p>
                    <p style=" margin-left:2%; margin-right:2%">
                        3、提现金额不可超过您的可提现金额。
                    </p>
                </a>
            </li>
            <li style="height:160px;">
                <form action="" method="post">
                <p style="color:#d34a4f; text-align:center">可提现金额<br/><b>￥{{getMoney money}}</b></p>

                <p >
                    <input name="cash" class="cont" required="required" placeholder="请输入提现金额(元)" type="text" onkeyup="">
                </p>
                <p><input type="submit" value="提现" class="enchashment disable"></p>
                </form>
            </li>
        </ul>
    </div>

    <div class="user_nav_list w" style="margin-top:20px; width:99.5%;font-size:13px">
        <ul>
            <li style="height:40px;">
                <a>
                    <div class="u_nav_icon" style=" font-size:16px; width:100px;color:#5184b0">提现详情：</div>
                </a>
            </li>
        </ul>
        <table style="width:100%; text-align:center;">
            <tr>
                <td style="width: 33%;border-bottom: 1px solid EBEBEB;">时间</td>
                <td style="width: 33%;border-bottom: 1px solid EBEBEB;">金额</td>
                <td style="width: 33%;border-bottom: 1px solid EBEBEB;">状态</td>
            </tr>
            {{#each list}}
            <tr>
                <td style="width: 33%;border-bottom: 1px solid EBEBEB;color: #5e5e5e">
                    {{this.created_at}}
                </td>
                <td style="width: 33%;border-bottom: 1px solid EBEBEB;color: #5e5e5e">
                    {{getMoney this.money}}
                </td>
                <td style="width: 33%;border-bottom: 1px solid EBEBEB;color: #5e5e5e">
                    {{arrKey ../statusL this.status}}
                </td>
            </tr>
            {{/each}}
        </table>
    </div>
</div>

