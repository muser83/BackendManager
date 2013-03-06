/**
 * Account.js
 * Created on Feb 27, 2013 10:50:40 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   license.wittestier.nl
 * @copyright 2013 WitteStier - copyright.wittestier.nl
 */

Ext.define('App.controller.application.Account', {
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
        alert('Account');

        // End.
        return true;
    }

});