Ext.define('App.controller.admin.Users', {
    extend: 'App.controller.Abstract',
    models: [
//        'admin.Users.'
    ],
    stores: [
//        'admin.Users'
    ],
    views: [
//        'admin.users.grid.Users'
    ],
    listners: {},
    /**
     * COMMENTME
     *
     * @param {Ext.app.Application} application
     * @return Boolean Void
     */
    init: function(application)
    {
        this.control({
        });
        return true;
    },
    /**
     * COMMENTME
     *
     * @return Boolean Void
     */
    startupAction: function()
    {
        // End.
        return true;
    }

});