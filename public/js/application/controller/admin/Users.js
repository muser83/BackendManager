/**
 * Users.js
 * Created on Dec 28, 2012 5:29:22 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.controller.admin.Users', {
    extend: 'App.controller.Abstract',
    models: [
//        'admin.Users'
    ],
    stores: [
//        'admin.Users'
    ],
    views: [
        'admin.users.grid.Users'
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
        var translateGrid = this.getAdminUsersGridUsersView().create({
            tbar: this.getToolbar()
        });

        this.setCenter(translateGrid);

        // End.
        return true;
    }

});