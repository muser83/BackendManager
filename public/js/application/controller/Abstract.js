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
            selector: '[region=center]'
        }, {
            ref: 'SouthRegion',
            selector: '[region=south]'
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
        centerView = this.injectToolbar(centerView);
        centerRegion.removeAll();
        centerRegion.add(centerView);

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     * @param {App.view.*} view View to add to the toolbar to.
     * @returns {App.view.*} View with toolbar.
     */
    injectToolbar: function(view)
    {
        var toolbar,
            store,
            isGrid = (view.self.getName().indexOf('.grid.') >= 0),
            allToolbarConfig = this.application.systemModel.get('toolbar'),
            toolbarName = this.self.getName().replace(/\.|App.controller/g, ''),
            toolbarConfig = allToolbarConfig[toolbarName] || {
        };

        if (isGrid) {
            store = view.getStore();
            Ext.apply(toolbarConfig, {
                store: store,
                displayInfo: false,
                enableOverflow: true,
                prependButtons: true
            });

            toolbarConfig.items.push('->');

            toolbar = Ext.create('Ext.PagingToolbar', toolbarConfig);
        } else {
            toolbar = Ext.create('Ext.toolbar.Toolbar', toolbarConfig);
        }

        view.addDocked(toolbar);

        // End.
        return view;
    },
    /**
     * COMMENTME
     * @param {Ext.data.Store} store To the grid binded store.
     * @return {Ext.PagingToolbar} Configured paging toolbar.
     */
    getPagingToolbar: function(store)
    {
        // End.
        return Ext.create('Ext.PagingToolbar', {
            store: store,
            displayInfo: true
        });
    }

});