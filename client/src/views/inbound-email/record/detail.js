

Fox.define('views/inbound-email/record/detail', 'views/record/detail', function (Dep) {

    return Dep.extend({

        setup: function () {
            Dep.prototype.setup.call(this);
            this.handleDistributionField();
        },

        afterRender: function () {
            Dep.prototype.afterRender.call(this);
            this.initSslFieldListening();

            if (this.wasFetched()) {
                this.setFieldReadOnly('fetchSince');
            }
        },

        wasFetched: function () {
            if (!this.model.isNew()) {
                return !!((this.model.get('fetchData') || {}).lastUID);
            }
            return false;
        },

        handleDistributionField: function () {
            var handleRequirement = function (model) {
                if (model.get('createCase') && ['Round-Robin', 'Least-Busy'].indexOf(model.get('caseDistribution')) != -1) {
                    this.getFieldView('team').setRequired();
                } else {
                    this.getFieldView('team').setNotRequired();
                }
            }.bind(this);

            this.listenTo(this.model, 'change:createCase', function (model) {
                if (!model.get('createCase')) {
                    if (this.model.get('caseDistribution') !== '') {
                        this.model.set('caseDistribution', 'Direct-Assignment');
                    }
                }
            }, this);

            this.on('render', function () {
                handleRequirement(this.model);
            }, this);

            this.listenTo(this.model, 'change:caseDistribution', function (model) {
                handleRequirement(model);
            });
        },

        initSslFieldListening: function () {
            var sslField = this.getFieldView('ssl');
            this.listenTo(sslField, 'change', function () {
                var ssl = sslField.fetch()['ssl'];
                if (ssl) {
                    this.model.set('port', '993');
                } else {
                    this.model.set('port', '143');
                }
            }, this);
        }

    });

});

