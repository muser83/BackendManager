/**
 * Messages.js
 * Created on Feb 27, 2013 10:50:52 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   license.wittestier.nl
 * @copyright 2013 WitteStier - copyright.wittestier.nl
 */

Ext.define('App.controller.application.Messages', {
    extend: 'App.controller.Abstract',
    models: [],
    stores: [],
    views: [],
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

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     * @return Boolean Void
     */
    startupAction: function()
    {
        alert('messages');

        // End.
        return true;
    }

});