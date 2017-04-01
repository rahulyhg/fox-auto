

Fox.define('views/fields/wysiwyg', ['views/fields/text', 'lib!Summernote'], function (Dep, Summernote) {

    return Dep.extend({

        type: 'wysiwyg',

        detailTemplate: 'fields/wysiwyg/detail',

        editTemplate: 'fields/wysiwyg/edit',

        height: 250,

        rowsDefault: 10,

        setup: function () {
            Dep.prototype.setup.call(this);

            if ('height' in this.params) {
                this.height = this.params.height;
            }

            if ('minHeight' in this.params) {
                this.minHeight = this.params.minHeight;
            }

            this.toolbar = this.params.toolbar || [
                ['style', ['style']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table', 'link', 'picture', 'hr']],
                ['misc',['codeview', 'fullscreen']]
            ];

            this.listenTo(this.model, 'change:isHtml', function (model) {
                if (this.mode == 'edit') {
                    if (this.isRendered()) {
                        if (!model.has('isHtml') || model.get('isHtml')) {
        		            var value = this.plainToHtml(this.model.get(this.name));
        		            this.model.set(this.name, value);
                            this.enableWysiwygMode();
                        } else {
        		            var value = this.htmlToPlain(this.model.get(this.name));
        		            this.model.set(this.name, value);
                            this.disableWysiwygMode();
                        }
                    }
                }
                if (this.mode == 'detail') {
                    if (this.isRendered()) {
                        this.reRender();
                    }
                }
            }.bind(this));

            this.once('remove', function () {
                $('body > .tooltip').remove();
            });
        },

        getValueForDisplay: function () {
            var value = Dep.prototype.getValueForDisplay.call(this);
            if (this.mode == 'edit' && value) {
                value = value.replace(/<[\/]{0,1}(base|BASE)[^><]*>/g, '');
            }
            return value || '';
        },

        afterRender: function () {
            Dep.prototype.afterRender.call(this);

            if (this.mode == 'edit') {
                this.$summernote = this.$el.find('.summernote');
            }

            var language = this.getConfig().get('language');

            if (!(language in $.summernote.lang)) {
                $.summernote.lang[language] = this.getLanguage().translate('summernote', 'sets');
            }

            if (this.mode == 'edit') {
                if (!this.model.has('isHtml') || this.model.get('isHtml')) {
                    this.enableWysiwygMode();
                } else {
                    this.$element.removeClass('hidden');
                }
            }

            if (this.mode == 'detail') {
                if (!this.model.has('isHtml') || this.model.get('isHtml')) {
                    this.$el.find('iframe').removeClass('hidden');

                    var $iframe = this.$el.find('iframe');
                    var iframe = this.iframe = $iframe.get(0);

                    if (!iframe) return;

                    $iframe.load(function () {
                        $iframe.contents().find('a').attr('target', '_blank');
                    });

                    var doc = iframe.contentWindow.document;

                    var link = '<link href="'+this.getBasePath()+'client/css/iframe.css" rel="stylesheet" type="text/css"></link>';

                    doc.open('text/html', 'replace');
                    var body = this.model.get(this.name) || '';
                    body += link;

                    doc.write(body);
                    doc.close();

                    var processHeight = function () {
                        var $body = $iframe.contents().find('html body');

                        var height = $body.height() + 30;
                        iframe.style.height = height + 'px';
                    };

                    setTimeout(function () {
                        processHeight();
                        $iframe.load(function () {
                            processHeight();
                        });
                    }, 50);

                } else {
                    this.$el.find('.plain').removeClass('hidden');
                }
            }
        },

        enableWysiwygMode: function () {
            if (!this.$element) {
                return;
            }

            this.$element.addClass('hidden');
            this.$summernote.removeClass('hidden');

            var contents = this.model.get(this.name);

            this.$summernote.html(contents);

            this.$summernote.find('style').remove();
            this.$summernote.find('link[ref="stylesheet"]').remove();

            var options = {
                lang: this.getConfig().get('language'),
                callbacks: {
                    onImageUpload: function (files) {
                        var file = files[0];
                        this.notify('Uploading...');
                        this.getModelFactory().create('Attachment', function (attachment) {
                            var fileReader = new FileReader();
                            fileReader.onload = function (e) {
                                $.ajax({
                                    type: 'POST',
                                    url: 'Attachment/action/upload',
                                    data: e.target.result,
                                    contentType: 'multipart/encrypted',
                                }).done(function (data) {
                                    attachment.id = data.attachmentId;
                                    attachment.set('name', file.name);
                                    attachment.set('type', file.type);
                                    attachment.set('role', 'Inline Attachment');
                                    attachment.set('global', true);
                                    attachment.set('size', file.size);
                                    attachment.once('sync', function () {
                                        var url = '?entryPoint=attachment&id=' + attachment.id;
                                        this.$summernote.summernote('insertImage', url);
                                        this.notify(false);
                                    }, this);
                                    attachment.save();
                                }.bind(this));
                            }.bind(this);
                            fileReader.readAsDataURL(file);

                        }, this);
                    }.bind(this),
                    onBlur: function () {
                        this.trigger('change')
                    }.bind(this),
                },
                toolbar: this.toolbar
            };

            if (this.height) {
                options.height = this.height;
            }

            if (this.minHeight) {
                options.minHeight = this.minHeight;
            }

            this.$summernote.summernote(options);
        },

        plainToHtml: function (html) {
        	html = html || '';
        	var value = html.replace(/\n/g, '<br>');
        	return value;
        },

        htmlToPlain: function (text) {
        	text = text || '';
            var value = text.replace(/<br\s*\/?>/mg, '\n');

            var $div = $('<div>').html(value);
            $div.find('style').remove();
            $div.find('link[ref="stylesheet"]').remove();

            value =  $div.text();

            return value;
        },

        disableWysiwygMode: function () {
            this.$summernote.summernote('destroy');

            this.$summernote.addClass('hidden');
            this.$element.removeClass('hidden');
        },

        fetch: function () {
            var data = {};
            if (!this.model.has('isHtml') || this.model.get('isHtml')) {
                data[this.name] = this.$summernote.summernote('code');
            } else {
                data[this.name] = this.$element.val();
            }

            if (this.model.has('isHtml')) {
            	if (this.model.get('isHtml')) {
            		data[this.name + 'Plain'] = this.htmlToPlain(data[this.name]);
            	} else {
            		data[this.name + 'Plain'] = data[this.name];
            	}
            }
            return data;
        }
    });
});

