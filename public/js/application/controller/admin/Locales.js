Ext.define('App.controller.admin.Locales', {
    extend: 'App.controller.Abstract',
    models: [
//        'admin.Locales'
    ],
    stores: [
//        'admin.Locales'
    ],
    views: [
        'admin.locales.grid.Locales'
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
        var localesGrid = this.getAdminLocalesGridLocalesView().create();

        this.addToCenter(localesGrid, toolbarConfig);

        // End.
        return true;
    }

});