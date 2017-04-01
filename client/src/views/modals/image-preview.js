

Fox.define('views/modals/image-preview', 'views/modal', function (Dep) {

    return Dep.extend({

        cssName: 'image-preview',

        header: true,

        template: 'modals/image-preview',

        size: 'x-large',

        backdrop: true,

        data: function () {
            return {
                name: this.options.name,
                url: this.getImageUrl(),
                originalUrl: this.getOriginalImageUrl()
            };
        },

        setup: function () {
            this.buttonList = [];
            this.header = '&nbsp;';

            this.navigationEnabled = (this.options.imageList && this.options.imageList.length > 1);

            this.imageList = this.options.imageList || [];
            this.url = this.options.src
        },

        getImageUrl: function () {
            var url = this.url//this.getBasePath() + '?entryPoint=image&id=' + this.options.id;
            //url += '&size=' + this.size;
            if (this.getUser().get('portalId')) {
                url += '&portalId=' + this.getUser().get('portalId');
            }
            return url;
        },

        getOriginalImageUrl: function () {
            var url = this.url//this.getBasePath() + '?entryPoint=image&id=' + this.options.id;
            if (this.getUser().get('portalId')) {
                url += '&portalId=' + this.getUser().get('portalId');
            }
            return url;
        },

        afterRender: function () {
            $container = this.$el.find('.image-container');
            $img = this.$el.find('.image-container img');

            if (this.navigationEnabled) {
                $img.css('cursor', 'pointer');
                $img.click(function () {
                    this.switchToNext();
                }.bind(this));
            }

            var manageSize = function () {
                var width = $container.width();
                $img.css('maxWidth', width);
            }.bind(this);

            $(window).on('resize', function () {
                manageSize();
            });

            setTimeout(function () {
                manageSize();
            }, 100);
        },

        switchToNext: function () {
            var index = -1;
            this.imageList.forEach(function (d, i) {
                if (d.id === this.options.id) {
                    index = i;
                }
            }, this);

            index++;
            if (index > this.imageList.length - 1) {
                index = 0;
            }

            this.options.id = this.imageList[index].id
            this.options.name = this.imageList[index].name;
            this.reRender();
        },

    });
});

