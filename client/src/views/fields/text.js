

Fox.define('views/fields/text', 'views/fields/base', function (Dep) {

    return Dep.extend({

        type: 'text',

        listTemplate: 'fields/text/detail',

        detailTemplate: 'fields/text/detail',

        editTemplate: 'fields/text/edit',

        searchTemplate: 'fields/text/search',

        detailMaxLength: 400,

        detailMaxNewLineCount: 10,

        seeMoreText: false,

        rowsDefault: 4,

        events: {
            'click a[data-action="seeMoreText"]': function (e) {
                this.seeMoreText = true;
                this.reRender();
            }
        },

        setup: function () {
            Dep.prototype.setup.call(this);
            this.params.rows = this.params.rows || this.rowsDefault;
            this.detailMaxLength = this.params.lengthOfCut || this.detailMaxLength;
        },

        setupSearch: function () {
            this.searchParams.typeOptions = ['startsWith', 'contains', 'equals', 'isEmpty', 'isNotEmpty'];
            this.events = _.extend({
                'change select.search-type': function (e) {
                    var type = $(e.currentTarget).val();
                    this.handleSearchType(type);
                },
            }, this.events || {});
        },

        handleSearchType: function (type) {
            if (~['isEmpty', 'isNotEmpty'].indexOf(type)) {
                this.$el.find('input.main-element').addClass('hidden');
            } else {
                this.$el.find('input.main-element').removeClass('hidden');
            }
        },

        getValueForDisplay: function () {
            var text = this.model.get(this.name);

            if (text && (this.mode == 'detail' || this.mode == 'list') && !this.seeMoreText && !this.params.seeMoreDisabled) {
                var maxLength = this.detailMaxLength;

                var isCut = false;

                if (text.length > this.detailMaxLength) {
                    text = text.substr(0, this.detailMaxLength);
                    isCut = true;
                }

                var nlCount = (text.match(/\n/g) || []).length;
                if (nlCount > this.detailMaxNewLineCount) {
                    var a = text.split('\n').slice(0, this.detailMaxNewLineCount);
                    text = a.join('\n');
                    isCut = true;
                }

                if (isCut) {
                    text += ' ...\n[#see-more-text]';
                }
            }
            return text || '';
        },

        afterRender: function () {
            Dep.prototype.afterRender.call(this);
            if (this.mode == 'edit') {
                var text = this.getValueForDisplay();
                if (text) {
                    this.$element.val(text);
                }
            }
            if (this.mode == 'search') {
                var type = this.$el.find('select.search-type').val();
                this.handleSearchType(type);
            }
        },

        /*fetchSearch: function () {
            var value = this.$element.val();
            if (value) {
                var data = {
                    type: 'like',
                    value: '%' + value + '%',
                    valueText: value
                };
                return data;
            }
            return false;
        },*/

        fetchSearch: function () {

            var type = this.$el.find('[name="'+this.name+'-type"]').val() || 'startsWith';

            var data;

            if (~['isEmpty', 'isNotEmpty'].indexOf(type)) {
                if (type == 'isEmpty') {
                    data = {
                        typeFront: type,
                        where: {
                            type: 'or',
                            value: [
                                {
                                    type: 'isNull',
                                    field: this.name,
                                },
                                {
                                    type: 'equals',
                                    field: this.name,
                                    value: ''
                                }
                            ]
                        }
                    }
                } else {
                    data = {
                        typeFront: type,
                        where: {
                            type: 'and',
                            value: [
                                {
                                    type: 'notEquals',
                                    field: this.name,
                                    value: ''
                                },
                                {
                                    type: 'isNotNull',
                                    field: this.name,
                                    value: null
                                }
                            ]
                        }
                    }
                }
                return data;
            } else {
                var value = this.$element.val().toString().trim();
                value = value.trim();
                if (value) {
                    data = {
                        value: value,
                        type: type,
                        typeFront: type
                    }
                    return data;
                }
            }
            return false;
        }

    });
});

