/**
 * Created by jqh on 2017/2/28.
 */
Fox.define('views/fields/money', 'views/fields/varchar', function (Dep) {
    return Dep.extend({
        listTemplate: 'fields/money/list',

        listLinkTemplate: 'fields/money/list-link',

        detailTemplate: 'fields/money/detail',

        editTemplate: 'fields/money/edit',

        searchTemplate: 'fields/money/search',
    })
})
