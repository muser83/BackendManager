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
    listners: {},
    /**
     * COMMENTME
     *
     * @param {App.view.*} centerView View to add to the viewport center region.
     * @returns {Boolean} Void
     */
    addToCenter: function(centerView)
    {
        centerView = this.injectToolbar(centerView);
        var centerRegion = this.getCenterRegion();
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
        var allToolbarConfig = this.application.systemModel.get('toolbar');
        var toolbarName = this.self.getName().replace(/\.|App.controller/g, '');
        var toolbarConfig = allToolbarConfig[toolbarName] || {};

        view.addDocked(
            Ext.create('Ext.toolbar.Toolbar', allToolbarConfig[toolbarName])
            );

        // End.
        return view;
    }

});