{{#each rows}}
<div class="baoliao w" style="margin-bottom:10px;">
    <div class="ui-tab" >
        <div class="ui-tab-content">
            <a>
                <div class="baoliao_content" style=" border-bottom: none">
                    <div class="top_l">
                        <p> 订单号：{{this.name}}</p>
                        <p> 创建时间：{{this.created_at}}</p>
                        <p> 收益：
                            <b style="color:#d34a4f">&yen;
                                {{getMoney this.money}}                                                </b>
                        </p>
                    </div>
                </div>

                <a href="javascript:">
                    <div class="user_nav_list w" style="width:99.4%; margin-top:10px; margin-bottom:10px; border-bottom: 1px solid #F2F2F2;border-top: 1px solid #F2F2F2">
                        <table style="width:100%; text-align:center; height:60px; ">
                            <tr>
                                <td style="text-align:left;font-size: 14px;">
                                    流量包：{{arrKey ../adresses this.flow_adress}}{{arrKey ../flowTypes this.flow_type}}
                                    {{this.flow}}M                                                                                      </td>
                            </tr>
                            <tr>
                                <td style="text-align:left; font-size:14px; ">
                                    充值号码：{{this.buyer_mobile}}                                                    </td>
                            </tr>
                        </table>
                    </div>
                </a>
                <div class="baoliao_content" style=" border-bottom: none">
                    <div class="top_r">
                        <a class="ord_status" href="#"> {{arrKey ../status this.status}} </a>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
{{/each}}