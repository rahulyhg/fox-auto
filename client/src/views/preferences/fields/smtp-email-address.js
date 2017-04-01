 
Fox.define('Views.Preferences.Fields.SmtpEmailAddress', 'Views.Fields.Varchar', function (Dep) {

    return Dep.extend({
    
        detailTemplate: 'preferences.fields.smtp-email-address.detail',
        
        data: function () {
            return _.extend({
                isAdmin: this.getUser().isAdmin()
            }, Dep.prototype.data.call(this));
        },
        
    });
    
});
