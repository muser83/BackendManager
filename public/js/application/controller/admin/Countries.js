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
            '#adminCountriesToolbar button[action=add]': {
                'click': this.addCountryAction
            },
            '#adminCountriesToolbar button[action=edit]': {
                'click': this.editCountryAction
            },
            '#adminCountriesToolbar button[action=delete]': {
                'click': this.deleteCountryAction
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
            countriesStore = this.getAdminCountriesStore().load();
        var countriesGrid = this.getAdminCountriesGridCountriesView().create({
            store: countriesStore,
            tbar: this.getPagingToolbar(countriesStore),
            plugins: [rowEditor]
        });

        rowEditor.on('edit', function(editor, e) {
            e.record.save();
        }, this);

        this.addToCenter(countriesGrid);

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     *
     * @public
     * @param {Ext.button.Button} button
     * @param {Event} event
     * @return {Boolean} Void.
     */
    addCountryAction: function(button, event)
    {
        var countriesGrid = button.up('grid'),
            rowEditor = countriesGrid.getPlugin('adminCountriesEditor'),
            countriesStore = countriesGrid.getStore(),
            countryModel = this.getAdminCountriesModel().create();

        rowEditor.cancelEdit();

        countriesStore.insert(0, countryModel);
        rowEditor.startEdit(0, 0);

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     *
     * @public
     * @param {Ext.button.Button} button
     * @param {Event} event
     * @return {Boolean} Void.
     */
    editCountryAction: function(button, event)
    {
        var countriesGrid = button.up('grid'),
            rowEditor = countriesGrid.getPlugin('adminCountriesEditor'),
            countriesStore = countriesGrid.getStore(),
            countryModel = countriesGrid.getSelectionModel();

        rowEditor.startEdit(countryModel.getLastSelected(), 0);

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     *
     * @public
     * @param {Ext.button.Button} button description1
     * @param {Event} event description2
     * @return {Boolean} Void.
     */
    deleteCountryAction: function(button, event)
    {
        var countriesGrid = button.up('grid'),
            rowEditor = countriesGrid.getPlugin('adminCountriesEditor'),
            countriesStore = countriesGrid.getStore(),
            countryModel = countriesGrid.getSelectionModel();

        rowEditor.cancelEdit(countryModel.getLastSelected());

        countriesStore.remove(countryModel.getLastSelected());

        if (countriesStore.getCount() > 0) {
            countryModel.select(0);
        }

        countriesStore.sync();
        // End.
        return true;
    }
});