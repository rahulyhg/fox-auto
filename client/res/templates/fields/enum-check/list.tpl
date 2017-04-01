<button class="
    {{#ifEqual value 0}}btn btn-default{{/ifEqual}}
    {{#ifEqual value 1}}btn btn-info{{/ifEqual}}
    {{#ifEqual value 2}}btn btn-danger red{{/ifEqual}}
    {{#ifEqual value 3}}btn btn-primary{{/ifEqual}}
    {{#ifEqual value 5}}btn btn-default{{/ifEqual}}
">
    {{translateOption value scope=scope field=name translatedOptions=translatedOptions}}
</button>

