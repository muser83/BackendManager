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
        var centerRegion = this.getCenterRegion();
        centerRegion.removeAll();
        centerRegion.add(
            this.injectToolbar(centerView)
            );

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
        var allToolbarConfig = this.application.systemInfo.toolbarConfig;
        var toolbarName = this.self.getName().replace(/\.|App.controller/g, '');

        if (undefined === allToolbarConfig[toolbarName]) {
            this.application.debug(
                'No toolbar config found for controller `' + toolbarName + '`.'
                );
        }

        view.addDocked(
            this.getView('Toolbar').create(allToolbarConfig[toolbarName])
            );

        // End.
        return view;
    }

});