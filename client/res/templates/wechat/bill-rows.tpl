
        {{#each rows}}
        <div class="baoliao w" style="margin-bottom:10px;">
            <div class="ui-tab" >
                <div class="ui-tab-content">
                    <a>
                        <div class="baoliao_content" style=" border-bottom: none">
                            <div class="top_l">

                                <p>
                                    <b style="color:#d34a4f;font-size:18px">
                                        {{#ifEqual this.from 3}}-{{else}}+{{/ifEqual}}
                                        {{getMoney this.money}}     </b>                                           </b>
                                </p>
                                <p style="font-size:13px;">
                                    <span>{{arrKey ../froms this.from}}</span> -
                                    <span>{{this.created_at}}</span>
                                </p>
                            </div>
                        </div>


                        <div class="baoliao_content" style=" border-bottom: none">
                            <div class="top_r">

                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        {{/each}}

