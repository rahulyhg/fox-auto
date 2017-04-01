<select class="form-control e-reason" >
    {{#if reasons}}
        {{#each reasons}}
        <option value="{{this.id}}" data-val="{{this.name}}">{{this.name}}</option>
        {{/each}}
    {{else}}
        <option value="" data-val="">无</option>
    {{/if}}
</select>
<br/>
<br/>
<button class="btn btn-primary" data-action="selected">选择</button>
<button class="btn btn-default" data-action="create">创建审核理由</button>