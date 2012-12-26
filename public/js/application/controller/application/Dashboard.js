/**
 * Controller.js
 * Created on Oct 3, 2012 12:26:02 PM
 *
 * @author     Boy van Moorsel <boyvanmoorsel@msi.com>
 * @copyright  (c) 2012 MSI EU - Product Marketing.
 */
Ext.define('App.controller.application.Dashboard', {
    extend: 'App.controller.Abstract',
    models: [
//        'application.Dashboard'
    ],
    store: [
//        'application.Dashboard'
    ],
    views: [
//        'application.dashboard.panel.Dashboard'
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