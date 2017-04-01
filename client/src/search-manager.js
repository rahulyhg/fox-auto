
Fox.define('search-manager', [], function () {

    var SearchManager = function (collection, type, storage, dateTime, defaultData, emptyOnReset) {
        this.collection = collection;
        this.scope = collection.name;
        this.storage = storage;
        this.type = type || 'list';
        this.dateTime = dateTime;
        this.emptyOnReset = emptyOnReset;

        this.emptyData = {
            textFilter: '',
            bool: {},
            advanced: {},
            primary: null,
        };

        if (defaultData) {
            this.defaultData = defaultData;
            for (var p in this.emptyData) {
                if (!(p in defaultData)) {
                    defaultData[p] = Fox.Utils.clone(this.emptyData[p]);
                }
            }
        }

        this.data = Fox.Utils.clone(defaultData) || this.emptyData;

        this.sanitizeData();
    };

    _.extend(SearchManager.prototype, {

        data: null,

        sanitizeData: function () {
            if (!('advanced' in this.data)) {
                this.data.advanced = {};
            }
            if (!('bool' in this.data)) {
                this.data.bool = {};
            }
            if (!('textFilter' in this.data)) {
                this.data.textFilter = '';
            }
        },

        getWhere: function () {
            var where = [];

            if (this.data.textFilter && this.data.textFilter != '') {
                where.push({
                    type: 'textFilter',
                    value: this.data.textFilter
                });
            }

            if (this.data.bool) {
                var o = {
                    type: 'bool',
                    value: [],
                };
                for (var name in this.data.bool) {
                    if (this.data.bool[name]) {
                        o.value.push(name);
                    }
                }
                if (o.value.length) {
                    where.push(o);
                }
            }

            if (this.data.primary) {
                var o = {
                    type: 'primary',
                    value: this.data.primary,
                };
                if (o.value.length) {
                    where.push(o);
                }
            }

            if (this.data.advanced) {
                for (var name in this.data.advanced) {
                    var defs = this.data.advanced[name];
                    if (!defs) {
                        continue;
                    }
                    var part = this.getWherePart(name, defs);
                    where.push(part);
                }
            }

            return where;
        },

        getWherePart: function (name, defs) {
            var field = name;

            if ('where' in defs) {
                return defs.where;
            } else {
                var type = defs.type;

                if (type == 'or' || type == 'and') {
                    var a = [];
                    var value = defs.value || {};
                    for (var n in value) {
                        a.push(this.getWherePart(n, value[n]));
                    }
                    return {
                        type: type,
                        value: a
                    };
                }
                if ('field' in defs) {
                    field = defs.field;
                }
                if (defs.dateTime) {
                    return {
                        type: type,
                        field: field,
                        value: defs.value,
                        dateTime: true,
                        timeZone: this.dateTime.timeZone || 'UTC'
                    };
                } else {
                    value = defs.value;
                    return {
                        type: type,
                        field: field,
                        value: value,
                    };
                }
            }
        },

        loadStored: function () {
            this.data = this.storage.get(this.type + 'Search', this.scope) || Fox.Utils.clone(this.defaultData) || Fox.Utils.clone(this.emptyData);
            this.sanitizeData();
            return this;
        },

        get: function () {
            return this.data;
        },

        setAdvanced: function (advanced) {
            this.data = Fox.Utils.clone(this.data);
            this.data.advanced = advanced;
        },

        setBool: function (bool) {
            this.data = Fox.Utils.clone(this.data);
            this.data.bool = bool;
        },

        setPrimary: function (primary) {
            this.data = Fox.Utils.clone(this.data);
            this.data.primary = primary;
        },

        set: function (data) {
            this.data = data;
            if (this.storage) {
                this.storage.set(this.type + 'Search', this.scope, data);
            }
        },

        empty: function () {
            this.data = Fox.Utils.clone(this.emptyData);
            if (this.storage) {
                this.storage.clear(this.type + 'Search', this.scope);
            }
        },

        reset: function () {
            if (this.emptyOnReset) {
                this.empty();
                return;
            }
            this.data = Fox.Utils.clone(this.defaultData) || Fox.Utils.clone(this.emptyData);
            if (this.storage) {
                this.storage.clear(this.type + 'Search', this.scope);
            }
        },

        getDateTimeWhere: function (type, field, value) {
            var where = {
                field: field
            };
            if (!value && ~['on', 'before', 'after'].indexOf(type)) {
                return null;
            }

            switch (type) {
                case 'today':
                    where.type = 'between';
                    var start = this.dateTime.getNowMoment().startOf('day').utc();

                    var from = start.format(this.dateTime.internalDateTimeFormat);
                    var to = start.add(1, 'days').format(this.dateTime.internalDateTimeFormat);
                    where.value = [from, to];
                    break;
                case 'past':
                    where.type = 'before';
                    where.value = this.dateTime.getNowMoment().utc().format(this.dateTime.internalDateTimeFormat);
                    break;
                case 'future':
                    where.type = 'after';
                    where.value = this.dateTime.getNowMoment().utc().format(this.dateTime.internalDateTimeFormat);
                    break;
                case 'on':
                    where.type = 'between';
                    var start = moment(value, this.dateTime.internalDateFormat, this.timeZone).utc();

                    var from = start.format(this.dateTime.internalDateTimeFormat);
                    var to = start.add(1, 'days').format(this.dateTime.internalDateTimeFormat);

                    where.value = [from, to];
                    break;
                case 'before':
                    where.type = 'before';
                    where.value = moment(value, this.dateTime.internalDateFormat, this.timeZone).utc().format(this.dateTime.internalDateTimeFormat);
                    break;
                case 'after':
                    where.type = 'after';
                    where.value = moment(value, this.dateTime.internalDateFormat, this.timeZone).utc().format(this.dateTime.internalDateTimeFormat);
                    break;
                case 'between':
                    where.type = 'between';
                    if (value[0] && value[1]) {
                        var from = moment(value[0], this.dateTime.internalDateFormat, this.timeZone).utc().format(this.dateTime.internalDateTimeFormat);
                        var to = moment(value[1], this.dateTime.internalDateFormat, this.timeZone).utc().format(this.dateTime.internalDateTimeFormat);
                        where.value = [from, to];
                    }
                    break;
                default:
                    where.type = type;
            }

            return where;
        },
    });

    return SearchManager;

});
