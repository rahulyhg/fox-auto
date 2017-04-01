/**
 * Created by jqh on 2017/3/10.
 */
Fox.define('views/fields/imgs', 'views/fields/file', function (Dep) {
    return Dep.extend({
        getDetailPreview: function (name, type, id) {
            var preview = name;

            var src = this.getImageUrl(id)

            switch (type) {
                case 'image/png':
                case 'image/jpeg':
                case 'image/gif':
                    preview = '<a data-action="showImagePreview" data-id="' + id + '" href="' + src + '"><img src="' + src + '"></a>';
            }
            return preview;
        },

        getImageUrl: function (id, size) {
            return "/client/img/orders/" + id + ".jpg"
        },

        getValueForDisplay: function () {
            if (this.mode == 'detail' || this.mode == 'list') {
                var name = this.model.get(this.nameName);
                var type = this.model.get(this.typeName) || this.defaultType;
                var ids = this.model.attributes[this.name]//this.model.get(this.name);

                if (!ids) {
                    return false;
                }

                var string = '';

                for(var i in ids) {
                    string += '<div class="attachment-preview" style="max-width:300px;max-height: 300px;">' + this.getDetailPreview(name, 'image/jpeg', ids[i]) + '</div>';
                }
                return string;
            }
        },

    })
})