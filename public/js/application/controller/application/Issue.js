/**
 * Controller.js
 * Created on Oct 3, 2012 12:26:02 PM
 *
 * @author     Boy van Moorsel <boyvanmoorsel@msi.com>
 * @copyright  (c) 2012 MSI EU - Product Marketing.
 */
Ext.define('App.controller.application.Issue', {
    extend: 'App.controller.Abstract',
    models: [
//        'application.Issue'
    ],
    store: [
//        'application.Issue'
    ],
    views: [
//        'application.issue.grid.Issue'
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
        return true;
    },
    /**
     * COMMENTME
     *
     * @return Boolean Void
     */
    reportAction: function()
    {
        // Create and form
        // Create an window and open the window.
    }

});