

Fox.define('views/modal', 'view', function (Dep) {

    return Dep.extend({

        cssName: 'modal-dialog',

        header: false,

        dialog: null,

        containerSelector: null,

        scope: null,

        backdrop: 'static',

        buttonList: [],

        // TODO remove it as depricated
        buttons: [],

        width: false,

        fitHeight: false,

        escapeDisabled: false,

        events: {
            'click .action': function (e) {
                var $target = $(e.currentTarget);
                var action = $target.data('action');
                var data = $target.data();
                if (action) {
                    var method = 'action' + Fox.Utils.upperCaseFirst(action);
                    if (typeof this[method] == 'function') {
                        e.preventDefault();
                        this[method].call(this, data);
                    }
                }
            }
        },

        init: function () {
            var id = this.cssName + '-container-' + Math.floor((Math.random() * 10000) + 1).toString();
            var containerSelector = this.containerSelector = '#' + id;

            this.header = this.options.header || this.header;

            this.options = this.options || {};
            this.options.el = this.containerSelector;

            this.buttonList = Fox.Utils.cloneDeep(this.buttonList);

            // TODO remove it as depricated
            this.buttons = Fox.Utils.cloneDeep(this.buttons);

            this.on('render', function () {
                if (this.dialog) {
                    this.dialog.close();
                }

                $(containerSelector).remove();
                $('<div />').css('display', 'none').attr('id', id).appendTo('body');

                var buttonListExt = [];

                // TODO remove it as depricated
                this.buttons.forEach(function (item) {
                    var o = Fox.Utils.clone(item);
                    if (!('text' in o) && ('label' in o)) {
                        o.text = this.getLanguage().translate(o.label);
                    }
                    buttonListExt.push(o);
                }, this);


                this.buttonList.forEach(function (item) {
                    var o = {};

                    if (typeof item === 'string') {
                        o.name = item;
                    } else if (typeof item === 'object') {
                        o = item;
                    } else {
                        return;
                    }

                    var text = o.text;
                    if (!o.text) {
                        if ('label' in o) {
                            o.text = this.translate(o.label, 'labels', this.scope)
                        } else {
                            o.text = this.translate(o.name, 'modalActions', this.scope);
                        }
                    }
                    o.onClick = o.onClick || (this['action' + Fox.Utils.upperCaseFirst(o.name)] || function () {}).bind(this);

                    buttonListExt.push(o);
                }, this);

                this.dialog = new Fox.Ui.Dialog({
                    backdrop: this.backdrop,
                    header: this.header,
                    container: containerSelector,
                    body: '',
                    buttons: buttonListExt,
                    width: this.width,
                    keyboard: !this.escapeDisabled,
                    fitHeight: this.fitHeight,
                    onRemove: function () {
                        this.onDialogClose();
                    }.bind(this)
                });
                this.setElement(containerSelector + ' .body');
            }, this);

            this.on('after:render', function () {
                $(containerSelector).show();
                this.dialog.show();
            });

            this.once('remove', function () {
                if (this.dialog) {
                    this.dialog.close();
                }
                $(containerSelector).remove();
            });
        },

        onDialogClose: function () {
            if (!this.isBeingRendered()) {
                this.trigger('close');
                this.remove();
            }
        },

        actionCancel: function () {
            this.trigger('cancel');
            this.dialog.close();
        },

        actionClose: function () {
            this.trigger('cancel');
            this.dialog.close();
        },

        close: function () {
            this.dialog.close();
        },

        disableButton: function (name) {
            this.buttonList.forEach(function (d) {
                if (d.name !== name) return;
                d.disabled = true;
            }, this);
            if (!this.isRendered()) return;
            this.$el.find('footer button[data-name="'+name+'"]').addClass('disabled');
        },

        enableButton: function (name) {
            this.buttonList.forEach(function (d) {
                if (d.name !== name) return;
                d.disabled = false;
            }, this);
            if (!this.isRendered()) return;
            this.$el.find('footer button[data-name="'+name+'"]').removeClass('disabled');
        },

        showButton: function (name) {
            this.buttonList.forEach(function (d) {
                if (d.name !== name) return;
                d.hidden = false;
            }, this);
            if (!this.isRendered()) return;
            this.$el.find('footer button[data-name="'+name+'"]').removeClass('hidden');
        },

        hideButton: function (name) {
            this.buttonList.forEach(function (d) {
                if (d.name !== name) return;
                d.hidden = true;
            }, this);
            if (!this.isRendered()) return;
            this.$el.find('footer button[data-name="'+name+'"]').addClass('hidden');
        },
    });
});

