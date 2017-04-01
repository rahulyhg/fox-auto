

Fox.define('date-time', [], function () {

    var DateTime = function () {

    };

    _.extend(DateTime.prototype, {

        internalDateFormat: 'YYYY-MM-DD',

        internalDateTimeFormat: 'YYYY-MM-DD HH:mm',

        dateFormat: 'MM/DD/YYYY',

        timeFormat: 'HH:mm',

        timeZone: null,

        weekStart: 1,

        readableDateFormatMap: {
            'DD.MM.YYYY': 'DD MMM',
            'DD/MM/YYYY': 'DD MMM',
        },

        readableShortDateFormatMap: {
            'DD.MM.YYYY': 'D MMM',
            'DD/MM/YYYY': 'D MMM',
        },

        hasMeridian: function () {
            return (new RegExp('A', 'i')).test(this.timeFormat);
        },

        getDateFormat: function () {
            return this.dateFormat;
        },

        getDateTimeFormat: function () {
            return this.dateFormat + ' ' + this.timeFormat;
        },

        getReadableDateFormat: function () {
            return this.readableDateFormatMap[this.getDateFormat()] || 'MMM DD';
        },

        getReadableShortDateFormat: function () {
            return this.readableShortDateFormatMap[this.getDateFormat()] || 'MMM D';
        },

        fromDisplayDate: function (string) {
            if (!string) {
                return null;
            }
            var m = moment(string, this.dateFormat);
            if (!m.isValid()) {
                return -1;
            }
            return m.format(this.internalDateFormat);
        },

        toDisplayDate: function (string) {
            if (!string || (typeof string != 'string')) {
                return '';
            }

            var m = moment(string, this.internalDateFormat);
            if (!m.isValid()) {
                return '';
            }

            return m.format(this.dateFormat);
        },

        fromDisplay: function (string) {
            if (!string) {
                return null;
            }
            var m;
            if (this.timeZone) {
                m = moment.tz(string, this.getDateTimeFormat(), this.timeZone).utc();
            } else {
                m = moment.utc(string, this.getDateTimeFormat());
            }

            if (!m.isValid()) {
                return -1;
            }
            return m.format(this.internalDateTimeFormat) + ':00';
        },

        fromDisplayDateTime: function (string) {
            return this.fromDisplay(string);
        },

        toDisplayDateTime: function (string) {
            return this.toDisplay(string);
        },

        toDisplay: function (string) {
            if (!string) {
                return '';
            }
            return this.toMoment(string).format(this.getDateTimeFormat());
        },

        getNowMoment: function () {
            var m = moment();
            if (this.timeZone) {
                m = m.tz(this.timeZone);
            }
            return m;
        },

        toMomentDate: function (string) {
            var m = moment.utc(string, this.internalDateFormat);
            return m;
        },

        toMoment: function (string) {
            var m = moment.utc(string, this.internalDateTimeFormat);
            if (this.timeZone) {
                m = m.tz(this.timeZone);
            }
            return m;
        },

        fromIso: function (string) {
            if (!string) {
                return '';
            }
            var m = moment(string).utc();
            return m.format(this.internalDateTimeFormat);
        },

        toIso: function (string) {
            if (!string) {
                return null;
            }
            return this.toMoment(string).format();
        },

        getToday: function () {
            return moment.utc().format(this.internalDateFormat);
        },

        getNow: function (multiplicity) {
            if (!multiplicity) {
                return moment.utc().format(this.internalDateTimeFormat);
            } else {
                var unix = moment().unix();
                unix = unix - (unix % (multiplicity * 60));
                return moment.unix(unix).utc().format(this.internalDateTimeFormat);
            }
        },

        setSettingsAndPreferences: function (settings, preferences) {
            if (settings.has('dateFormat')) {
                this.dateFormat = settings.get('dateFormat');
            }
            if (settings.has('timeFormat')) {
                this.timeFormat = settings.get('timeFormat');
            }
            if (settings.has('timeZone')) {
                this.timeZone = settings.get('timeZone') || null;
                if (this.timeZone == 'UTC') {
                    this.timeZone = null;
                }
            }
            if (settings.has('weekStart')) {
                this.weekStart = settings.get('weekStart');
            }

            preferences.on('change', function (model) {
                if (model.has('dateFormat') && model.get('dateFormat') !== '') {
                    this.dateFormat = model.get('dateFormat');
                }
                if (model.has('timeFormat') && model.get('timeFormat') !== '') {
                    this.timeFormat = model.get('timeFormat');
                }
                if (model.has('timeZone') && model.get('timeZone') !== '') {
                    this.timeZone = model.get('timeZone');
                }
                if (model.has('weekStart') && model.get('weekStart') !== -1) {
                    this.weekStart = model.get('weekStart');
                }
                if (this.timeZone == 'UTC') {
                    this.timeZone = null;
                }
            }, this);
        },

        setLanguage: function (language) {
            moment.locale('en', {
                months: language.translate('monthNames', 'lists'),
                monthsShort: language.translate('monthNamesShort', 'lists'),
                weekdays: language.translate('dayNames', 'lists'),
                weekdaysShort: language.translate('dayNamesShort', 'lists'),
                weekdaysMin: language.translate('dayNamesMin', 'lists'),
            });
            moment.locale('en');
        },
    });

    return DateTime;

});

