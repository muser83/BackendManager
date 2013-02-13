/**
 * Roles.js
 * Created on Dec 27, 2012 12:17:48 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */


Ext.define('App.controller.admin.Roles', {
    extend: 'App.controller.Abstract',
    models: [
//        'admin.Roles'
    ],
    stores: [
//        'admin.Roles'
    ],
    views: [
        'admin.roles.grid.Roles'
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
        var rolesGrid = this.getAdminRolesGridRolesView().create({
            tbar: this.getToolbar()
        });

        this.addView(rolesGrid, {
            region: 'center',
            flush: true,
            toolbar: true,
            pagingToolbar: true,
            searchFilter: true,
            documentation: true
        });

        // End.
        return true;
    }

});