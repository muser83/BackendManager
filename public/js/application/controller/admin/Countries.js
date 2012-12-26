Ext.define('App.controller.admin.Countries', {
    extend: 'App.controller.Abstract',
    models: [
        'admin.Countries'
    ],
    stores: [
        'admin.Countries'
    ],
    views: [
        'admin.countries.grid.Countries'
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
        var store = this.getAdminCountriesStore().load();
        var countriesGrid = this.getAdminCountriesGridCountriesView().create({
            store: store
        });
        var rowEditor = countriesGrid.getPlugin('adminCountriesEditor');

        rowEditor.on('edit', function(editor, e) {
            console.log(e.record);
        }, this);

        this.addToCenter(countriesGrid);
        // End.
        return true;
    }

});