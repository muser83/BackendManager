/**
 * Settings.js
 * Created on Nov 5, 2012 11:17:56 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.controller.account.Settings', {
    extend: 'App.controller.Abstract',
    models: [
//        'account.Settings'
    ],
    stores: [
//        'account.Settings'
    ],
    views: [
//        'account.settings.form.Settings'
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