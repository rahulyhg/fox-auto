

Fox.define('crm:views/dashlets/opportunities-by-stage', 'crm:views/dashlets/abstract/chart', function (Dep) {

    return Dep.extend({

        name: 'OpportunitiesByStage',

        setupDefaultOptions: function () {
            this.defaultOptions['dateFrom'] = this.defaultOptions['dateFrom'] || moment().format('YYYY') + '-01-01';
            this.defaultOptions['dateTo'] = this.defaultOptions['dateTo'] || moment().format('YYYY') + '-12-31';
        },

        url: function () {
            return 'Opportunity/action/reportByStage?dateFrom=' + this.getOption('dateFrom') + '&dateTo=' + this.getOption('dateTo');
        },

        prepareData: function (response) {
            var d = [];
            for (var label in response) {
                var value = response[label];
                d.push({
                    stage: label,
                    value: value
                });
            }

            this.stageList = [];

            var data = [];
            var i = 0;
            d.forEach(function (item) {
                var o = {
                    data: [[item.value, d.length - i]],
                    label: this.getLanguage().translateOption(item.stage, 'stage', 'Opportunity'),
                }
                if (item.stage == 'Closed Won') {
                    o.color = this.successColor;
                }
                data.push(o);
                this.stageList.push(this.getLanguage().translateOption(item.stage, 'stage', 'Opportunity'));
                i++;
            }, this);

            return data;
        },

        setup: function () {
            this.currency = this.getConfig().get('defaultCurrency');
            this.currencySymbol = '';
        },

        drow: function () {
            var self = this;
            this.flotr.draw(this.$container.get(0), this.chartData, {
                colors: this.colors,
                shadowSize: false,
                bars: {
                    show: true,
                    horizontal: true,
                    shadowSize: 0,
                    lineWidth: 1,
                    fillOpacity: 1,
                    barWidth: 0.5,
                },
                grid: {
                    horizontalLines: false,
                    outline: 'sw',
                    color: this.outlineColor
                },
                yaxis: {
                    min: 0,
                    showLabels: false,
                },
                xaxis: {
                    min: 0,
                    tickFormatter: function (value) {
                        if (value != 0) {
                            return self.formatNumber(value) + ' ' + self.currency;
                        }
                        return '';
                    },
                },
                mouse: {
                    track: true,
                    relative: true,
                    position: 's',
                    trackFormatter: function (obj) {
                        return self.formatNumber(obj.x) + ' ' + self.currency;
                    },
                },
                legend: {
                    show: true,
                    noColumns: 5,
                    container: this.$el.find('.legend-container'),
                    labelBoxMargin: 0
                },
            });
        },

    });
});


