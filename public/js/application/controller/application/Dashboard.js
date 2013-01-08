/**
 * Dashboard.js
 * Created on Dec 28, 2012 4:55:35 PM
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
    stores: [
//        'application.Dashboard'
    ],
    views: [
        'application.dashboard.panel.Dashboard'
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
        var dashboardPanel = this.getApplicationDashboardPanelDashboardView().create({
            tbar: this.getToolbar()
        });

        this.setCenter(dashboardPanel);
        return true;
    }

});