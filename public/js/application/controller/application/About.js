/**
 * About.js
 * Created on Feb 27, 2013 10:51:07 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   license.wittestier.nl
 * @copyright 2013 WitteStier - copyright.wittestier.nl
 */

Ext.define('App.controller.application.About', {
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
        return true;
    },
    /**
     * COMMENTME
     *
     * @return Boolean Void
     */
    startupAction: function()
    {
        alert('About');
        return true;
    }

});