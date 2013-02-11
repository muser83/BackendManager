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
    setCenter: function(centerView)
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
     * @protected
     * @return {App.view.*} To the viewport center region added view.
     */
    getCenter: function()
    {
        var centerRegion = this.getCenterRegion();

        // End.
        return centerRegion.down('panel');
    },
    /**
     * COMMENTME
     *
     * @return {Object} toolbar configuration.
     */
    getToolbarConfig: function()
    {
        var toolbarConfig,
            allToolbarConfig = this.application.systemModel.get('toolbar'),
            toolbarName = this.getName();

        toolbarConfig = allToolbarConfig[toolbarName] || {
        };

        Ext.apply(toolbarConfig, {
            itemId: toolbarName + 'Toolbar'
        });

        // End.
        return toolbarConfig;
    },
    /**
     * COMMENTME
     *
     * @returns {App.view.*} View with toolbar.
     */
    getToolbar: function()
    {
        var toolbarConfig = this.getToolbarConfig(),
            toolbar;

        // Set default toolbar configuration.
        Ext.apply(toolbarConfig, {
        });

        toolbar = Ext.create('Ext.toolbar.Toolbar', toolbarConfig);
        toolbar.add('->');
        this.addToolbarDocumentation(toolbar);

        // End.
        return toolbar;
    },
    /**
     * COMMENTME
     * @param {Ext.data.Store} store To the grid binded store.
     * @return {Ext.PagingToolbar} Configured paging toolbar.
     */
    getPagingToolbar: function(store)
    {
        var toolbarConfig = this.getToolbarConfig(),
            pagingToolbar;

        // Set default toolbar configuration.
        Ext.apply(toolbarConfig, {
            store: store,
            displayInfo: false,
            prependButtons: true
        });

        toolbarConfig.items.push('->');

        pagingToolbar = Ext.create('Ext.toolbar.Paging', toolbarConfig);

        this.addPagingSearchFilter(pagingToolbar);
        this.addToolbarDocumentation(pagingToolbar);

        // End.
        return pagingToolbar;
    },
    /**
     * COMMENTME
     *
     * @public
     * @param {Ext.toolbar.Toolbar} toolbar description
     * @return {Boolean} Void.
     */
    addToolbarDocumentation: function(toolbar)
    {
        toolbar.add({
            icon: '/images/icons/black/book_icon&16.png',
            listeners: {
                click: {
                    scope: this,
                    fn: this.showPageDocumentation
                }
            }
        });

        // End.
        return true;
    },
    /**
     * Add a search button as last item in the toolbar.
     * When the search button is clicked a search field appears which removes
     * all grid rows where the search value does not match the row values.
     *
     * @public
     * @param {Ext.toolbar.Paging} pagingToolbar description
     * @return {Boolean} Void.
     */
    addPagingSearchFilter: function(pagingToolbar)
    {
        var store = pagingToolbar.getStore(),
            filterValue,
            filterQuery,
            allFieldsFilter,
            searchMatch;

        pagingToolbar.add({
            icon: '/images/icons/black/zoom_icon&16.png',
            menu: [
                {
                    xtype: 'textfield',
                    width: 500,
                    listeners: {
                        change: {// specialkey
                            scope: this,
                            fn: function(textfield, event)
                            {
                                store.clearFilter();

                                filterValue = textfield.getValue();
                                filterQuery = RegExp(filterValue, 'i');
                                allFieldsFilter = new Ext.util.Filter({
                                    filterFn: function(model)
                                    {
                                        searchMatch = false;
                                        Ext.Object.each(model.getData(), function(fieldname, value)
                                        {
                                            searchMatch = searchMatch || filterQuery.test(String(value));
                                        }, this);

                                        // End.
                                        return searchMatch;
                                    }
                                });

                                store.filter(allFieldsFilter);

                                // End.
                                return true;
                            }
                        }
                    }
                }
            ]
        });

        // End.
        return true;
    },
    /**
     * Disable the given toolbar item.
     *
     * @public
     * @param {Ext.Component} component description
     * @return {Boolean} Void.
     */
    disableToolbarItem: function(component)
    {
        var centerIsGrid = this.isGrid(this.getCenter());

        // Disable the toolbar item.
        component.disable();

        if (centerIsGrid) {
            // enable the toolbar item on grid selection change.
            this.getCenter().addListener('selectionchange', function(grid, selected)
            {
                component.setDisabled(!selected.length);
            }, this);
        }

        // End.
        return true;
    },
    /**
     * Return a instance of the Ext.grid.plugin.RowEditing plugin.
     * If the toolbar config does not contain an item with a edit action
     * the editing will be stopped.
     *
     * @public
     * @return {Ext.grid.plugin.RowEditing} RowEditor plugin.
     */
    getRowEditor: function()
    {
        var hasEditAction = this.toolbarHasAction('edit');

        // End.
        return Ext.create('Ext.grid.plugin.RowEditing', {
            pluginId: this.getName() + 'Editor',
            clicksToMoveEditor: 1,
            errorSummary: false,
            listeners: {
                beforeedit: {
                    scope: this,
                    fn: function(editor)
                    {
                        if (!hasEditAction) {
                            // End. Return false to stop the editing.
                            return false;
                        }
                    }
                }
            }
        });
    },
    /**
     * COMMENTME
     *
     * @public
     * @return {Boolean} Void.
     */
    showPageDocumentation: function()
    {
        var documentId = this.getName();

        this.application.openDocs(documentId);

        // End.
        return true;
    },
    /**
     * Return whatever the toolbar contains an item with this action.
     *
     * @private
     * @param {String} action description
     * @return {Boolean} Whatever the toolbar has the action item or not.
     */
    toolbarHasAction: function(action)
    {
        var hasItem = false,
            toolbarConfig = this.getToolbarConfig(),
            toolbarItems = toolbarConfig.items,
            itemAction;

        Ext.Object.each(toolbarItems, function(index, itemConfig)
        {
            if ((itemConfig === Object(itemConfig))) {
                itemAction = itemConfig.action || '';

                if (itemAction === action) {
                    hasItem = true;

                    // End. Stop the iteration.
                    return false;
                }
            }
        }, this);

        // End.
        return hasItem;
    },
    /**
     * Return this current controller name without the App.controller prefix.
     *
     * @private
     * @return {String} Element id prefix.
     */
    getName: function()
    {
        // End.
        return this.self.getName().replace(/\.|App.controller/g, '');
    },
    /**
     * Return whatever the given component matches the selector string.
     *
     * @private
     * @param {Ext.Component} component description1
     * @param {String} selector description2
     * @return {Boolean} Void.
     */
    componentIs: function(component, selector)
    {
        // End.
        return component.is(selector);
    },
    /**
     * Return whatever the given component is a grid panel.
     *
     * @private
     * @param {Ext.Component} component description
     * @return {Boolean} Void.
     */
    isGrid: function(component)
    {
        // End.
        return this.componentIs(component, 'gridpanel');
    }
});