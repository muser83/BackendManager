/**
 * Locales.js
 * Created on Dec 27, 2012 12:17:48 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
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

        this.addToCenter(localesGrid);

        // End.
        return true;
    }

});