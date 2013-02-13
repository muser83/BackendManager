/**
 * Locales.js
 * Created on Dec 27, 2012 12:17:48 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.controller.admin.Locales', {
    extend: 'App.controller.Abstract',
    models: [
        'admin.Locales'
    ],
    stores: [
        'admin.Locales',
        'admin.Languages',
        'admin.Charsets'
    ],
    views: [
        'admin.locales.grid.Locales'
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
            '#adminLocalesToolbar button[action=add]': {
                'click': function()
                {
                    alert('Yepa');
                }
            }
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
        var rowEditor = this.getRowEditor(),
            localesStore = this.getAdminLocalesStore().load();
        var localesGrid = this.getAdminLocalesGridLocalesView().create({
            store: localesStore,
            plugins: [rowEditor]
        });

        rowEditor.on('edit', function(editor, e) {
            e.record.save();
        }, this);

        this.addView(localesGrid, {
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