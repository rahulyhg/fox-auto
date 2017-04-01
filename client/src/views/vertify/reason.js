/**
 * Created by jqh on 2017/3/10.
 */
Fox.define('views/vertify/reason', 'views/modal', function (Dep) {
    return Dep.extend({
        header: "选择审核理由",

        template: "vertify/reason",

        setup: function() {
            Dep.prototype.setup.call(this)

            if (this.options.status == 1) {
                this.header = '选择通过理由'
            } else {
                this.header = '选择拒绝理由'
            }
        },

        //添加理由弹出窗
        create: function () {
            var self = this;

            this.notify('Loading...');
            this.createView('quickCreate', 'Modals.Edit', {
                scope: "Reason",
                fullFormDisabled: true,
            }, function (view) {
                view.once('after:render', function () {
                    self.notify(false);
                });
                view.render();

                self.listenToOnce(view, 'leave', function () {
                    view.close();
                    self.close();
                });
                self.listenToOnce(view, 'after:save', function (model) {
                    view.close();
                    self.trigger('select', model);
                    setTimeout(function () {
                        self.close();
                    }, 10);

                    window.location.reload()

                }.bind(this));
            });
        },

        data: function() {
            var reasons = this.options.reasons
            return {
                reasons: reasons
            }
        },

        events: {
            'click button[data-action="create"]': function(e) {
                this.create()
            },
            'click button[data-action="selected"]': function(e) {
                var $r = $('.v-remark'), $e = $('.e-reason')
                var id = $e.val(), val = $e.find("option:selected").text()

                if (! id) {
                    this.notify('请先创建审核理由')
                    return setTimeout(function () {
                        this.notify(false)
                    }.bind(this), 5000)
                }

                $r.attr('data-id', id)
                $r.val(val)

                var $confirm = ''
                if (this.options.status == 1) {
                    $confirm = '通过'
                } else {
                    $confirm = '拒绝'
                }

                if (! confirm('您确定要' + $confirm + '审核？')) {
                    return;
                }

                this.trigger('selectedReasonSuccess', id)

                this.close()
            },
        }

    })
})