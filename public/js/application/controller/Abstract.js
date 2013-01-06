/**
 * Abstract.js
 * Created on Dec 27, 2012 12:17:48 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.controller.Abstract', {
    extend: 'Ext.app.Controller',
    refs: [{
            ref: 'CenterRegion',
            selector: 'viewport [region=center]'
        }],
    listners: {
    },
    /**
     * COMMENTME
     *
     * @param {App.view.*} centerView View to add to the viewport center region.
     * @returns {Boolean} Void
     */
    addToCenter: function(centerView)
    {
        var centerRegion = this.getCenterRegion();
        centerRegion.removeAll(true);
        centerRegion.add(centerView);

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     * @returns {App.view.*} View with toolbar.
     */
    getToolbar: function()
    {
        var toolbarConfig = this.getToolbarConfig();

        Ext.apply(toolbarConfig, {
//            enableOverflow: true // This option causes errors on centerview.removeAll
        });

        // End.
        return Ext.create('Ext.toolbar.Toolbar', toolbarConfig);
    },
    /**
     * COMMENTME
     * @param {Ext.data.Store} store To the grid binded store.
     * @return {Ext.PagingToolbar} Configured paging toolbar.
     */
    getPagingToolbar: function(store)
    {
        var toolbarConfig = this.getToolbarConfig();
        Ext.apply(toolbarConfig, {
            store: store,
//            enableOverflow: true, // This option causes errors on centerview.removeAll
            displayInfo: false,
            prependButtons: true
        });

        toolbarConfig.items.push('->');

        Ext.apply(toolbarConfig, {
        });

        // End.
        return Ext.create('Ext.toolbar.Paging', toolbarConfig);
    },
    /**
     * COMMENTME
     *
     * @return {Object} toolbar configuration.
     */
    getToolbarConfig: function()
    {
        var allToolbarConfig = this.application.systemModel.get('toolbar'),
            toolbarName = this.self.getName().replace(/\.|App.controller/g, '');

        // End.
        return allToolbarConfig[toolbarName] || {
        };
    },
    /**
     * COMMENTME
     *
     *
     * @public
     * @return {Ext.grid.plugin.RowEditing} RowEditor plugin.
     */
    getRowEditor: function()
    {
        // End.
        return Ext.create('Ext.grid.plugin.RowEditing', {
            clicksToMoveEditor: 1,
            errorSummary: false,
            autoCancel: false
        });
    },
});