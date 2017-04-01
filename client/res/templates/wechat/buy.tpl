<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
<!--<script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->
<style>
    * {
        margin: 0;
        padding: 0;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    /****************header******************/
    body{margin:0px;padding:0px;}
    .row, .col-sm-2, .col-sm-1, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10,     .col-sm-11, .col-sm-12{margin:0px; padding:0px;}
    .header{width:100%; height:94px; border-bottom:1px #c3e2ef solid;line-height:94px;}
    .flow-logo, .flow-nav{ text-align:center;}
    .flow-logo p{font-size:18px;font-weight:400;}
    .flow-nav li{margin-left:5%;padding-top:32px;}
    .flow-nav li a{ font-size:20px; font-weight:400;border-bottom:#79daff 4px solid; text-decoration:none;width:100%;color:#555555;}
    .flow-nav li a:hover{border-bottom:#FFF 5px solid;color:#000;}
    .flow-nav li a:focus{ outline:none;}
    .headTop{
        position: absolute;
        top: 0;
        height: 80px;
        width: 100%;
        background-color: white;
    }
    .line{
        position: absolute;
        height: 3px;
        width: 100%;
        background-color: #ACADAE;
        z-index: 2;
    }
    .logo{
        position: absolute;
        top: -70px;
        left: 150px;
        z-index: 1;
        height: 200px;
        width: 200px;
        border-radius: 46%;
        background-color: #ffffff;
    }
    .logo img{
        position: absolute;
        top: 80px;
        left: 50px;
        z-index: 3;
    }
    .myNav{
        position: absolute;
        bottom: 10px;
        right: 200px;
    }
    .myNav ul{
        list-style: none;
    }
    .myNav > ul > li{
        position: relative;
        float: left;
        margin-left: 30px;
    }
    .myNav ul li a{
        color: #696969;
        text-decoration: none;
        font-size: 18px;
    }
    .myNav ul li a:hover{
        color: #0ebb34;
    }

    .myNav button{
        position: absolute;
        top: -5px;
        color: #8a8a8a;
    }

    .payList{
        margin-left: 20px;
    }
    .payTable tr td{
        padding: 3px 5px;
    }

    .buyFlow{
        position: relative;
        margin: 50px auto;
        padding: 30px 30px 15px 50px;
        color: #5c5f5c;
        font-size: 18px;
        width: 90%;
        z-index: 2;
        background-color: #ffffff;
        border-radius:  0 20% 0 20%;
        border: solid 1px #aaaaaa;
    }
    .buyFlow-img{
        position: absolute;
        top: 150px;
        right: 34px;
        width: 280px;;
    }
    .buyFlow-img img{
        display: block;
        margin-left: auto;
        margin-right: auto;
        max-width: 250px;
    }
    .buyFlow-img img:nth-child(2){
        display: none;
    }
    .buyFlow-img img:nth-child(3){
        display: none;
    }
    .buyFlow ul{
        list-style: none;
    }

    .buyFlow ul li{
        width: 50px;
        float: left;
        margin-right: 10px;
        margin-top: 5px;
        font-size: 14px;
        border: solid 0px #959595;
        padding: 5px 8px;
        text-align: center;
    }
    #flowAllBox li{margin-bottom: 5px;}
    .start{background-color: #f0f0f0;}
    .current {background: #5184b0; color:#fff;}
    .point{cursor: pointer;}
    .act{
        border: solid 2px #dd0000 !important;
        padding: 4px 7px!important;
    }
    .buyFlow label{
        font-weight: 100;
        font-size: 14px;
        padding-top: 5px;
        margin-left: 20px;
        width: 100px;
    }
    .buyFlow button{
        background-color: #5184b0;
        border: solid thin #5184b0;
        color: #ffffff;
        height: 35px;
        border-radius: 0 20px 0 20px;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        -o-transition: all 0.3s;
        transition: all 0.3s;
        min-width: 250px;
    }
    .buyFlow button:hover{
        background-color: #5184b0;
        border-radius: 20px 0 20px 0;
    }
    /****************container******************/
    .container{
        max-width: 1300px;
    }
    .services-head{
        text-align: center;
        padding: 40px 0;
    }
    .service-section{
        padding: 20px 0 30px;
        text-align: center;
    }
    .service-section h4{
        color: #838383;
        font-weight: bold;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .service-section p{
        line-height: 25px;
        font-size: 14px;
        color: #8d8d8d;
        padding-left: 10px;
        padding-right: 10px;
    }
    .service-section button{
        width: 50%;
        background-color: transparent;
        border: solid thin #898989;
        color: #898989;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
        -ms-transition: all 0.5s;
        -o-transition: all 0.5s;
        transition: all 0.5s;
    }
    .service-section button:hover{
        color: #ffffff;
        background-color: #db3f38;
        border: solid thin #db3f38;
    }
    .second-section{
        background-image: url("../image/slide1.jpg");
        background-size: 100%;
        margin-top: 20px;
        margin-bottom: 40px;
        height: 500px;
    }
    .second-section div{
        width: 40%;
        height: 400px;
        background-color: #ffffff;
        opacity: 0.9;
        border-radius: 10px;
        float: left;
        margin: 5%;
    }
    .third-section{
        background-color: #f3f3f3;
        height: 200px;
        width: 100%;
        margin-top: 20px;
        margin-bottom: 80px;
        border-radius: 5px;
    }
    .firP{
        min-height: 130px;
    }
    @media screen and (max-width: 1200px) {
        .firP{
            min-height: 150px;
        }
    }
    .pic span{
        cursor:pointer;
    }
    .pic i {
        padding:0;
        width:48px;
        height:52px;
        background:url('../image/service-icons.png') no-repeat 0 0;
        display:inline-block;
    }
    .pic span i.pic1{
        background-position: -16px 0;
    }
    .pic:hover i.pic1{
        background-position: -16px -56px;
    }
    .pic span i.pic2{
        background-position: -64px 0;
    }
    .pic:hover i.pic2{
        background-position: -64px -56px;
    }
    .pic span i.pic3{
        background-position: -124px 0;
    }
    .pic:hover i.pic3{
        background-position: -124px -56px;
    }
    .pic span i.pic4{
        background-position: -180px 0;
    }
    .pic:hover i.pic4{
        background-position: -180px -56px;
    }
    /****************footer******************/
    .footer{
        height: 100px;
        width: 100%;
        background-color: #3e3e3e;
        color: #8d8d8d;
    }
    .footer p{
        padding-top: 40px;
    }

    #toTop{
        position: fixed;
        bottom: 125px;
        right: 30px;
        opacity: 0.5;
        display: none;
        cursor: pointer;
    }
    #toTop:hover{
        opacity: 0.8;
    }
    #contact{
        position: fixed;
        top: 15px;
        right: 30px;
        opacity: 0.6;
        cursor: pointer;
    }
    #contact span{font-size: 12px;}
    #contact:hover{opacity: 0.8;}


</style>
<div class="" >
        <div class="buyFlow">
    <!--<div class="buyFlowBg"></div>-->
    <form name="form1" onsubmit="return false;" class="form-horizontal" autocomplete="off">
        <div class="">
            <span class="" style="color: #ce4844;font-size: 20px;"><b>流量充值</b></span>
            &nbsp;&nbsp;
            <span class="" style="font-size: 14px;"><a href="{{buyRecordUrl}}">个人充值记录&gt;&gt;</a></span>
        </div>
        <div class="form-group has-feedback">
            <label for="phoneNum" class="col-sm-2 inputBox">手机号码：</label>
            <div class="col-sm-6 inputBox">
                <input name="phoneNum" type="text" class="form-control" id="phoneNum" maxlength="11" placeholder="输入充值的手机号" />
                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
            </div>
        </div>
        <div class="form-group">
            <label for="phoneBelong" class="col-sm-2 inputBox">号码归属：</label>
            <div class="col-sm-6 inputBox">
                <input name="phoneBelong" type="text" class="form-control" id="phoneBelong" value="" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 inputBox">充值类型：</label>
            <div class="col-sm-6 inputBox">
                <ul id="flowAllBoxStyle">
                    <li class="start current" data-value="100">全国</li>
                    <li class="start" data-value="1">省内</li>
                </ul>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 inputBox">充值流量：</label>
            <div class="col-sm-6 inputBox">
                <ul id="flowAllBox">
                    {{#each flows}}
                        {{#ifEqual @key 0}}
                        <li class="start current" data-value="{{@key}}">{{this}}</li>
                        {{else}}
                        <li class="start" data-value="{{@key}}">{{this}}</li>
                        {{/ifEqual}}
                    {{/each}}
                </ul>
            </div>
        </div>
        <div class="form-group">
            <!--<label class="col-sm-1 inputBox">市场价：</label>-->
            <!--<div class="col-sm-3 inputBox">-->
                <!--<input name="phoneMarket" type="text" class="form-control" id="phoneMarket" value="￥0.00" style="text-decoration: line-through;" readonly="">-->
            <!--</div>-->
            <label class="col-sm-1 inputBox">销售价：</label>
            <div class="col-sm-3 inputBox">
                <input name="phoneSell" type="text" class="form-control" id="phoneSell" value="￥0.00" readonly="">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 inputBox"></label>
            <button id="sendForm2" class="col-sm-6 " data-toggle="modal">立即充值</button>
        </div>
    </form>

</div>
</div>
