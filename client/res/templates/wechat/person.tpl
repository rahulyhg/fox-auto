        <!--<link href="{{css}}" rel="stylesheet" type="text/css">-->

<style>
    a{text-decoration:none;}
    .ft{position:fixed;bottom:0px;left:0; background:#ffffff; width:100%; height:50px;border-top:1px solid #EBEBEB}
    .t{float:left; margin:30px 0 0 10px; font-size:20px; color:#FFF}
    .ts{float:right; margin-top:25px; margin-right:20px; color:#FFF; font-size:35px;}
    .s{float:right;color:#fff; margin-right:2%; margin-top:10px; background:#5184b0; padding:5px 20px; border-radius:5px;border-radius:0px;}
    .lis{height:50px; margin-top:5px; font-size:15px;}
    .img{width: 15px;margin-top: 15px;display: inline-block;}
</style>


    <div class="mobile">
        <a href="{{{personalUrl}}}">
            <div class="user_top w" style="margin-bottom:0">
                <div class="user_logo">
                    <div class="img">
                        <img src="{{{avatar}}}">
                    </div>
                    <span class="t">{{{nickname}}}</span>
                    <label class="ts"> <img style="width: 15px;height: 15px;margin-top: 15px;" src="{{rightImg}}" /> </label>
                </div>
            </div>
        </a>

        <div class="user_nav_list w" style="width:99.5%">
            <ul>
                            <li class="lis">
                    <span style="float:left;color:#000; margin-left:2%; margin-top:15px;">
                        余额：<label style="color:#e45050;"><b>￥{{{getMoney money}}}</b></label>
                    </span>
                    <span class="s">
                        <a href="{{withdrawUrl}}" style="color:#fff">
                            提现
                        </a>
                    </span>
                </li>

                <li class="lis">
                    <span style="float:left;color:#000; margin-left:2%; margin-top:15px;">
                        冻结余额：<label style="color:#5e5e5e"><b>￥{{getMoney blockedMoney}}</b></label>
                    </span>

                </li>
                  
                <li class="lis">
                    <span style="float:left;color:#666666; margin-left:2%; margin-top:15px; color:#000">
                        我的订单
                    </span>
                    <span style="float:right;margin-right:2%; margin-top:15px; ">
                        <a href="{{allOrdersUrl}}" style=" font-size:15px; color:#999">全部订单
                            <img style="width: 15px;" src="{{rightImg1}}" />
                        </a>
                    </span>
                </li>

                <li style="height:60px; margin-top:10px;">
                    <table style=" text-align:center; width:100%">
                        <tr >
                            <td>
                                <a href="{{waitOrdersUrl}}" style=" font-size:14px; color:#999">
                                    <img style="width:30px" src="{{waitImg}}" /><br/>待处理
                                    <label style="color:red">{{waitOrders}}</label>
                                </a>
                            </td>
                            <td>
                                <a href="{{handledOrdersUrl}}" style=" font-size:14px; color:#999">
                                    <img style="width:30px" src="{{handledImg}}" /><br/>已处理
                                    <label style="color:red">{{handledOrders}}</label>
                                </a>
                            </td>
                            <td>
                                <a href="{{finishedOrdersUrl}}" style=" font-size:14px; color:#999">
                                    <img style="width:30px" src="{{finishedImg}}" /><br/>已完成
                                    <label style="color:red">{{finishedOrders}}</label>
                                </a>
                            </td>
                        </tr>
                    </table>
                </li>
            </ul>
        </div>

        <div class="user_nav_list w" style="width:99.4%; margin-top:10px;">
            <ul>
                <li>
                    <a href="{{incomeUrl}}">
                        <div class="u_nav_icon money"></div>
                        <div class="u_nav_name">收入详情</div>
                        <div class="u_money"><i style="color:#666666;margin-right:10px;"> <img class="img" src="{{rightImg1}}" /> </i></div>
                    </a>
                </li>

                                <li>
                    <a href="{{mymemberUrl}}">
                        <div class="u_nav_icon tixia"></div>
                        <div class="u_nav_name">我的粉丝</div>
                    <div class="u_money"><i style="color:#666666;margin-right:10px;"> <img class="img" src="{{rightImg1}}" /> </i></div>
                    </a>
                </li>

                <li>
                    <a href="{{shareUrl}}">
                        <div class="u_nav_icon tg"></div>
                        <div class="u_nav_name">我的二维码</div>
                        <div class="u_money"><i style="color:#666666;margin-right:10px;"> <img class="img" src="{{rightImg1}}" /> </i></div>
                    </a>
                </li>
                <li>
                    <a href="{{shareIncomeUrl}}">
                        <div class="u_nav_icon ti"></div>
                        <div class="u_nav_name">推广收入</div>
                        <div class="u_money"><i style="color:#666666;margin-right:10px;"> <img class="img" src="{{rightImg1}}" /> </i></div>
                    </a>
                </li>

                <!--<li>-->
                    <!--<a href="{{newsUrl}}">-->
                        <!--<div class="u_nav_icon tixian"></div>-->
                        <!--<div class="u_nav_name">我的消息</div>-->
                    <!--<div class="u_money"><i style="color:#666666;margin-right:10px;"> <img class="img" src="{{rightImg1}}" /> </i></div>-->
                    <!--</a>-->
                <!--</li>-->
                <!--<li>-->
                    <!--<a href="">-->
                        <!--<div class="u_nav_icon tixi"></div>-->
                        <!--<div class="u_nav_name">意见反馈</div>-->
                    <!--<div class="u_money"><i style="color:#666666;margin-right:10px;"> <img class="img" src="http://wx.quantcent.com/assets/images/tou.png" /> </i></div>-->
                    <!--</a>-->
                <!--</li>-->
                <!--<li>-->
                    <!--<a href="">-->
                        <!--<div class="u_nav_icon tix"></div>-->
                        <!--<div class="u_nav_name">商务合作</div>-->
                    <!--<div class="u_money"><i style="color:#666666;margin-right:10px;"> <img class="img" src="http://wx.quantcent.com/assets/images/tou.png" /> </i></div>-->
                    <!--</a>-->
                <!--</li>-->
            </ul>
        </div>
<div style="width:100%; float:left; height:60px;">&nbsp;</div>
<div class="ft">
    <table style="width:100%; text-align:center; margin-top:5px;border:none">
        <tr style="border:none">
            <td onclick=" window.location.href='home.html' " style="width:25%;border:none;border-right: 1px solid #EBEBEB">
                <a href="{{homeUrl}}" style="color:#999; font-size: 13px;">
                    <img style="width:20px;" src="{{homeImg}}" /><br/>流量转移
                </a>
            </td>
            <td onclick=" window.location.href='person.html' " style="width:25%;border:none">
                <a href="{{personUrl}}" style="color:#329DEF; font-size: 13px;">
                    <img style="width:20px;" src="{{personImg}}" /><br/>个人
                </a>
            </td>
        </tr>
    </table>
</div>
    </div>
    
    <script type="text/javascript">
var ScrollTime;
function ScrollAutoPlay(contID,scrolldir,showwidth,textwidth,steper){
    var PosInit,currPos;
    with($('#'+contID)){
        currPos = parseInt(css('margin-left'));
        if(scrolldir=='left'){
            if(currPos<0 && Math.abs(currPos)>textwidth){
                css('margin-left',showwidth);
            }
            else{
                css('margin-left',currPos-steper);
            }
        }
        else{
            if(currPos>showwidth){
                css('margin-left',(0-textwidth));
            }
            else{
                css('margin-left',currPos-steper);
            }
        }
    }
}
//--------------------------------------------左右滚动效果----------------------------------------------
/*
AppendToObj：        显示位置（目标对象）
ShowHeight：        显示高度
ShowWidth：        显示宽度
ShowText：        显示信息
ScrollDirection：    滚动方向（值：left、right）
Steper：        每次移动的间距（单位：px；数值越小，滚动越流畅，建议设置为1px）
Interval:        每次执行运动的时间间隔（单位：毫秒；数值越小，运动越快）
*/
function ScrollText(AppendToObj,ShowHeight,ShowWidth,ShowText,ScrollDirection,Steper,Interval){
    var TextWidth,PosInit,PosSteper;
    with(AppendToObj){
        html('');
        css('overflow','hidden');
        css('height',ShowHeight+'px');
        css('line-height',ShowHeight+'px');
        css('width',ShowWidth);
    }
    if (ScrollDirection=='left'){
        PosInit = ShowWidth;
        PosSteper = Steper;
    }
    else{
        PosSteper = 0 - Steper;
    }
    if(Steper<1 || Steper>ShowWidth){Steper = 1}//每次移动间距超出限制(单位:px)
    if(Interval<1){Interval = 10}//每次移动的时间间隔（单位：毫秒）
    var Container = $('<div></div>');
    var ContainerID = 'ContainerTemp';
    var i = 0;
    while($('#'+ContainerID).length>0){
        ContainerID = ContainerID + '_' + i;
        i++;
    }
    with(Container){
      attr('id',ContainerID);
      css('float','left');
      css('cursor','default');
      appendTo(AppendToObj);
      html(ShowText);
      TextWidth = width();
      if(isNaN(PosInit)){PosInit = 0 - TextWidth;}
      css('margin-left',PosInit);
      mouseover(function(){
          clearInterval(ScrollTime);
      });
      mouseout(function(){
          ScrollTime = setInterval("ScrollAutoPlay('"+ContainerID+"','"+ScrollDirection+"',"+ShowWidth+','+TextWidth+","+PosSteper+")",Interval);
      });
    }
    ScrollTime = setInterval("ScrollAutoPlay('"+ContainerID+"','"+ScrollDirection+"',"+ShowWidth+','+TextWidth+","+PosSteper+")",Interval);
}
</script>
<script type="text/javascript"> 
$(document).ready(function(e) {
    ScrollText($('#scrollText'),23,400,'','left',1,20);//滚动字幕

    $('#scrollText').css('margin-top','-1.1rem');
    $('#scrollText').css('margin-left','2.5rem');
    $('#scrollText').css('width','19rem');
});
</script>
