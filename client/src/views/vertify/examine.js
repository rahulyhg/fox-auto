/**
 * Created by jqh on 2017/2/27.
 */
Fox.define('views/vertify/examine', 'views/modal', function (Dep) {
    return Dep.extend({
        header: "审核",

        template: "vertify/examine",

        events: {
            'click button[data-action="allow"]': function(e) {
                this.selectReason(1)
            },

            'click button[data-action="refuse"]': function(e) {
                this.selectReason(2)
            },
        },

        selectReason: function(status) {
            var reasons = this.getReasons()

            var self = this

            var allow = (status == 1 ? true : false)

            // this.send(true, $('.v-remark').val());
            this.notify('loading...')
            this.createView('reasons', 'views/vertify/reason', {
                reasons: reasons[status],
                status: status,
            }, function (view) {
                view.render();
                view.notify(false);

                this.listenToOnce(view, 'selectedReasonSuccess', function(reasonId) {
                    console.log('selected 123', reasonId)
                    this.send(allow, reasonId)
                }.bind(this))

            }.bind(this));
        },

        send: function(allow, id) {
            this.notify("loading...")
            var self = this
            var data = {
                ids: self.options.ids,
                allow: allow,
                reasonId: id,
            }

            var id = '';
            data.attrs = []
            if (this.options.c) {
                for (var i in this.options.ids) {
                    id = this.options.ids[i]
                    data.attrs.push(this.options.c.get(id).attributes)
                }
            }
            //console.log(123, data)
            //return;

            $.ajax({
                url: self.api,
                type: 'POST',
                data: JSON.stringify(data),
                success: function(d) {
                    self.notify(false)
                    if (d.status == 1) {
                        self.notify(d.msg, "success", 5000)
                        self.close()
                    } else {
                        self.notify(d.msg, "error", 5000)
                    }

                    window.location.reload()
                }
            })
        },

        getReasons: function() {
            if (this.reasons) {
                return this.reasons
            }

            var scope = this.options.scope
            var self = this
            this.wait(true)
            $.ajax({
                url: 'Reason/action/GetList?scope=' + scope,
                type: 'GET',
                async: false,
                success: function(data) {
                    self.reasons = data
                    console.log("get reason", data)
                },
            })

            return this.reasons
        },

        setup: function() {
            Dep.prototype.setup.call(this)

            this.api = "/" + this.options.scope + '/action/' + 'Examine'
        },

    })
})
