<div class="header page-header">
    <h3><a href="#Admin">管理</a> » 微信设置</h3>
</div>
<div class="record">
    <div class="edit" id="wechat-edit">
        <div class="detail-button-container button-container record-buttons clearfix">
            <div class="btn-group" role="group">
                <button class="btn btn-primary action" data-action="save" type="button">保存</button>
            </div>
        </div><div style="height: 21px; display: none;">&nbsp;</div>


        <div class="row">
            <div class=" col-md-12">
                <div class="middle">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h4 class="panel-title">公众号配置</h4></div>
                        <div class="panel-body">

                            <div class="row">
                                <label class="control-label" data-name="siteUrl">
                                    dispatch_mode
                                </label>
                                <div class="field" data-name="siteUrl">
                                    <select name="dispatch_mode" class="form-control main-element">
                                        <option value="0" {{#ifEqual data.dispatch_mode '0'}} selected {{/ifEqual}}>轮流分派</option>
                                        <option value="1" {{#ifEqual data.dispatch_mode '1'}} selected {{/ifEqual}}>补齐分派</option>
                                        <option value="2" {{#ifEqual data.dispatch_mode '2'}} selected {{/ifEqual}}>随机分派</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <label class="control-label" data-name="siteUrl">
                                    session_time
                                </label>
                                <div class="field" data-name="siteUrl">
                                    <input type="text" class="main-element form-control" name="session_time" value="{{data.session_time}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <label class="control-label" data-name="siteUrl">
                                    welcome_msg
                                </label>
                                <div class="field" data-name="siteUrl">
                                    <input type="text" class="main-element form-control" name="welcome_msg" value="{{data.welcome_msg}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <label class="control-label" data-name="siteUrl">
                                    end_msg
                                </label>
                                <div class="field" data-name="siteUrl">
                                    <input type="text" class="main-element form-control" name="end_msg" value="{{data.end_msg}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <label class="control-label" data-name="siteUrl">
                                    reply_mode
                                </label>
                                <div class="field" data-name="reply_mode">
                                    <select name="reply_mode" class="form-control main-element">
                                        <option value="1" {{#ifEqual data.reply_mode '1'}} selected {{/ifEqual}}>客服繁忙时开启知识库自动回复</option>
                                        <option value="2" {{#ifEqual data.reply_mode '2'}} selected {{/ifEqual}}>只开启自动回复</option>
                                        <option value="3" {{#ifEqual data.reply_mode '3'}} selected {{/ifEqual}}>不开启自动回复</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <label class="control-label" data-name="siteUrl">
                                    tp_appid
                                </label>
                                <div class="field" data-name="siteUrl">
                                    <input type="text" class="main-element form-control" name="tp_appid" value="{{data.tp_appid}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <label class="control-label" data-name="siteUrl">
                                    tp_token
                                </label>
                                <div class="field" data-name="siteUrl">
                                    <input type="text" class="main-element form-control" name="tp_token" value="{{data.tp_token}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <label class="control-label" data-name="siteUrl">
                                    tp_account
                                </label>
                                <div class="field" data-name="siteUrl">
                                    <input type="text" class="main-element form-control" name="tp_account" value="{{data.tp_account}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <label class="control-label" data-name="siteUrl">
                                    tp_encoding_aes_key
                                </label>
                                <div class="field" data-name="siteUrl">
                                    <input type="text" class="main-element form-control" name="tp_encoding_aes_key" value="{{data.tp_encoding_aes_key}}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-md-12">
                <div class="middle">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h4 class="panel-title">企业号配置</h4></div>
                        <div class="panel-body">

                            <div class="row">
                                <label class="control-label" data-name="siteUrl">
                                    企业号corpid
                                </label>
                                <div class="field" data-name="siteUrl">
                                    <input type="text" class="main-element form-control" name="qy_corpid" value="{{data.qy_corpid}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <label class="control-label" data-name="siteUrl">
                                    企业号外部客服服务secret
                                </label>
                                <div class="field" data-name="siteUrl">
                                    <input type="text" class="main-element form-control" name="qy_secret" value="{{data.qy_secret}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <label class="control-label" data-name="siteUrl">
                                    企业号外部客服服务token
                                </label>
                                <div class="field" data-name="siteUrl">
                                    <input type="text" class="main-element form-control" name="qy_token" value="{{data.qy_token}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <label class="control-label" data-name="siteUrl">
                                    企业号外部客服服务EncodingAESKey
                                </label>
                                <div class="field" data-name="siteUrl">
                                    <input type="text" class="main-element form-control" name="qy_encoding_aes_key" value="{{data.qy_encoding_aes_key}}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
