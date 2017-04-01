

Fox.define('crm:views/dashlets/calendar', 'views/dashlets/abstract/base', function (Dep) {

    return Dep.extend({

        name: 'Calendar',

        noPadding: true,

        _template: '<div class="calendar-container">{{{calendar}}} </div>',

        init: function () {
            Dep.prototype.init.call(this);
            this.optionsFields['enabledScopeList'].options = this.getMetadata().get('clientDefs.Calendar.scopeList') || this.optionsFields['enabledScopeList'].options;
        },

        afterRender: function () {
            this.createView('calendar', 'crm:views/calendar/calendar', {
                mode: this.getOption('mode'),
                el: this.options.el + ' > .calendar-container',
                header: false,
                enabledScopeList: this.getOption('enabledScopeList'),
                containerSelector: this.options.el
            }, function (view) {
                view.render();
                this.on('resize', function () {
                    setTimeout(function() {
                        view.adjustSize();
                    }, 50);
                });
            }, this);
        }
    });
});


