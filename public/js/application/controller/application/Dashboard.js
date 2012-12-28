/**
 * Dashboard.js
 * Created on Dec 27, 2012 12:17:48 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
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
    listners: {
    },
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
        var centerRegion = this.getCenterRegion();
        centerRegion.removeAll();

        // End.
        return true;
    }

});