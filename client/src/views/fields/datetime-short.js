

Fox.define('views/fields/datetime-short', 'views/fields/datetime', function (Dep) {

    return Dep.extend({

        getValueForDisplay: function () {
            if (this.mode == 'list' || this.mode == 'detail') {
                var value = this.model.get(this.name)
                if (value) {
                    var string;

                    var d = this.getDateTime().toMoment(value);

                    var now = moment().tz(this.getDateTime().timeZone || 'UTC');

                    if (d.unix() > now.clone().startOf('day').unix() && d.unix() < now.clone().add(1, 'days').startOf('day').unix()) {
                        string = d.format(this.getDateTime().timeFormat);
                        return string;
                    }

                    var readableFormat = this.getDateTime().getReadableShortDateFormat();

                    if (d.format('YYYY') == now.format('YYYY')) {
                        string = d.format(readableFormat);
                    } else {
                        string = d.format(readableFormat + ', YY');
                    }

                    return string;
                }
            }

            return Dep.prototype.getValueForDisplay.call(this);
        }

    });
});

