/**
 * Countries.js
 * Created on Dec 27, 2012 12:17:48 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.controller.admin.Countries', {
    extend: 'App.controller.Abstract',
    models: [
        'admin.Countries'
    ],
    stores: [
        'admin.Countries',
        'admin.Continents',
        'admin.Currencies'
    ],
    views: [
        'admin.countries.grid.Countries'
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
        var rowEditor,
            continentsStore = this.getAdminContinentsStore().load(),
            currenciesStore = this.getAdminCurrenciesStore().load(),
            countriesStore = this.getAdminCountriesStore().load();
        var countriesGrid = this.getAdminCountriesGridCountriesView().create({
            store: countriesStore,
            continentsStore: continentsStore,
            currenciesStore: currenciesStore,
            tbar: this.getPagingToolbar(countriesStore)
        });
        rowEditor = countriesGrid.getPlugin('adminCountriesEditor');
        rowEditor.on('edit', function(editor, e) {
            e.record.save();
        }, this);

        this.addToCenter(countriesGrid, countriesStore);
        // End.
        return true;
    }

});