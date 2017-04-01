

Fox.define('views/fields/varchar', 'views/fields/base', function (Dep) {

    return Dep.extend({

        type: 'varchar',

        searchTemplate: 'fields/varchar/search',

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

        afterRender: function () {
            Dep.prototype.afterRender.call(this);
            if (this.mode == 'search') {
                var type = this.$el.find('select.search-type').val();
                this.handleSearchType(type);
            }
        },

        fetch: function () {
            var data = {};
            var value = this.$element.val();
            if (this.params.trim) {
                if (typeof value.trim === 'function') {
                    value = value.trim();
                }
            }
            data[this.name] = value;
            return data;
        },

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

