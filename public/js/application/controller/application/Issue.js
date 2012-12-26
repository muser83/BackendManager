/**
 * Issue.js
 * Created on Dec 27, 2012 12:17:48 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
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