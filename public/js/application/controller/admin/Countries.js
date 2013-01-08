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
                'click': this.addAction
            },
            '#adminCountriesToolbar button[action=edit]': {
                'click': this.editAction
            },
            '#adminCountriesToolbar button[action=delete]': {
                'click': this.deleteAction
            },
            '#adminCountriesToolbar button[action=continents]': {
                'click': this.continentsAction
            },
            '#adminCountriesToolbar button[action=currencies]': {
                'click': this.currenciesAction
            }
        });
        return true;
    },
    /**
     * COMMENTME
     *
     * @return Boolean Void
     */
    startupAction: function(action)
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

        this.setCenter(countriesGrid);

        console.log(action);

        this[action]();

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     * @public
     * @return {Boolean} Void.
     */
    addAction: function()
    {
        var countriesGrid = this.getCenter(),
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
     * @public
     * @return {Boolean} Void.
     */
    editAction: function()
    {
        var countriesGrid = this.getCenter(),
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
     * @public
     * @return {Boolean} Void.
     */
    deleteAction: function()
    {
        var countriesGrid = this.getCenter(),
            rowEditor = countriesGrid.getPlugin('adminCountriesEditor'),
            countriesStore = countriesGrid.getStore(),
            countryModel = countriesGrid.getSelectionModel();

        rowEditor.cancelEdit(countryModel.getLastSelected());

        countriesStore.remove(countryModel.getLastSelected());

        // SETTING
//        if (countriesStore.getCount() > 0) {
//            countryModel.select(0);
//        }

        countriesStore.sync();
        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     * @public
     * @return {Boolean} Void.
     */
    continentsAction: function()
    {
        /**
         * Open a window with this.openWindow(view)
         * Get a open window with this.getWindow([viewQuery])
         *  current open window.down(viewQuery)
         */

        console.log('view continents action.')

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     * @public
     * @return {Boolean} Void.
     */
    currenciesAction: function()
    {
        console.log('view Currencies action.')


        // End.
        return true;
    }
});