<style>
    .t{float:left;margin:10px 0 0 20px; font-size:20px; color:#000}

    .img{width: 8px;
        position: relative;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-top: 5px;
        float: left;
        margin-left: 20px;
        margin-right: auto;
        margin-bottom: 0px;
    }
</style>
        {{#each rows}}
        <div class="baoliao w" style="margin-bottom:10px;">
            <div class="ui-tab" >
                <div class="ui-tab-content">
                    <a>
                        <div class="baoliao_content" style=" border-bottom: none">
                            <div class="top_l">
                                <img class="img" src="{{this.avatar}}">
                                <div class="t">{{this.name}}</div>

                               <br/>
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

