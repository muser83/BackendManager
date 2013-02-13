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
            ref: 'EastRegion',
            selector: 'viewport [region=east]'
        }, {
            ref: 'SouthRegion',
            selector: 'viewport [region=south]'
        }, {
            ref: 'WestRegion',
            selector: 'viewport [region=west]'
        }, {
            ref: 'CenterRegion',
            selector: 'viewport [region=center]'
        }],
    listners: {
    },
    /**
     * Return this current controller name without the App.controller prefix.
     *
     * @public
     * @return {String} Element id prefix.
     */
    getName: function()
    {
        // End.
        return this.self.getName().replace(/\.|App.controller/g, '');
    },
    /**
     * COMMENTME
     *
     * @public
     * @param {App.view.*} view description1
     * @param {Object} options description2
     * @return {Boolean} Void.
     */
    addView: function(view, options)
    {
        var isGrid = this.isGrid(view),
            regionContainer,
            store,
            toolbar;

        options = Ext.apply(
            {
                region: 'center', // center, east, south, west // North is private.
                flush: true,
                toolbar: true,
                pagingToolbar: isGrid,
                searchFilter: isGrid,
                documentation: false
            },
        options);

        switch (options.region) {
            case 'east':
                regionContainer = this.getEastRegion();
                break;
            case 'south':
                regionContainer = this.getSouthRegion();
                break;
            case 'west':
                regionContainer = this.getWestRegion();
                break;
            default:
                regionContainer = this.getCenterRegion();
        }

        if (options.flush) {
            // Remove and destroy all components on this region container.
            regionContainer.removeAll(true);
        }

        if (isGrid) {
            store = view.getStore();
        }

        if (options.toolbar) {
            // Add a toolbar to the view.
            if (options.pagingToolbar && isGrid) {
                // Add a paging toolbar to the grid.
                toolbar = this.getPagingToolbar(store);
            } else {
                toolbar = this.getToolbar();
                toolbar.add('->');
            }

            if (options.searchFilter && isGrid) {
                // Add a grid search bar.
                toolbar.add(
                    this.getToolbarSearchButton(store));
            }

            if (options.documentation) {
                // Add a documentation button to the toolbar.
                toolbar.add(
                    this.getToolbarDocumentationButton());
            }
        }

        view.addDocked(toolbar);

        regionContainer.add(view);

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     * @public
     * @return {Ext.panel.Panel} Void.
     */
    getSouthView: function()
    {
        // End.
        return this.getSouthRegion().down('panel');
    },
    /**
     * COMMENTME
     *
     * @public
     * @return {Ext.panel.Panel} Void.
     */
    getEastView: function()
    {
        // End.
        return this.getEastRegion().down('panel');
    },
    /**
     * COMMENTME
     *
     * @public
     * @return {Ext.panel.Panel} Void.
     */
    getWestView: function()
    {
        // End.
        return this.getWestRegion().down('panel');
    },
    /**
     * COMMENTME
     *
     * @public
     * @return {Ext.panel.Panel} Void.
     */
    getCenterView: function()
    {
        // End.
        return this.getCenterRegion().down('panel');
    },
    /**
     * COMMENTME
     *
     * @public
     * @param {App.view.*} view description1
     * @param {Object} options description2
     * @return {Boolean} Void.
     */
    addWindow: function(view, options)
    {
        // End.
        return true;
    },
    /**
     * Get the toolbar instance for this current controller
     *
     * @public
     * @return {Ext.toolbar.Toolbar} Void.
     */
    getToolbar: function()
    {
        var toolbarConfig = this.getToolbarConfig(),
            toolbarName = this.getName(),
            toolbar;

        toolbar = Ext.getCmp('#' + toolbarName);

        if (this.isToolbar(toolbar)) {
            // End.
            return toolbar;
        }

        // End.
        return Ext.create('Ext.toolbar.Toolbar', toolbarConfig);
    },
    /**
     * Get the paging toolbar instance for this current controller.
     *
     * @public
     * @param {Ext.data.Store} store description1
     * @return {Boolean} Void.
     */
    getPagingToolbar: function(store)
    {
        var toolbarConfig = this.getToolbarConfig(),
            toolbarName = this.getName(),
            pagingToolbar;

        pagingToolbar = Ext.getCmp('#' + toolbarName);

        if (this.isToolbar(pagingToolbar)) {
            // End.
            return pagingToolbar;
        }

        // Set default toolbar configuration.
        Ext.apply(toolbarConfig, {
            store: store,
            displayInfo: false,
            prependButtons: true
        });

        toolbarConfig.items.push('->');

        pagingToolbar = Ext.create('Ext.toolbar.Paging', toolbarConfig);

        // End.
        return pagingToolbar;
    },
    /**
     * Return a toolbar button configuration object.
     * When the search button is clicked a search field appears which removes
     * all grid rows where the search value does not match the row values.
     *
     * @public
     * @param {Ext.data.Store} store description1
     * @return {Boolean} Void.
     */
    getToolbarSearchButton: function(store)
    {
        var filterValue,
            filterQuery,
            allFieldsFilter,
            searchMatch;
        // End.
        return {
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
        };
    },
    /**
     * Return a toolbar button configuration object.
     *
     * @public
     * @return {Object} Void.
     */
    getToolbarDocumentationButton: function()
    {
        var documentId = this.getName();

        // End.
        return {
            icon: '/images/icons/black/book_icon&16.png',
            listeners: {
                click: {
                    scope: this,
                    fn: function()
                    {
                        this.application.openDocs(documentId);

                        // End.
                        return true;
                    }
                }
            }
        };
    },
    /**
     * Return whatever the toolbar contains an item with this action.
     *
     * @public
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
     * Disable the given toolbar item.
     *
     * @public
     * @param {Ext.Component} component description
     * @return {Boolean} Void.
     */
    disableToolbarItem: function(component)
    {
        var centerView = this.getCenterView(),
            IsGrid = this.isGrid(centerView);

        // Disable the toolbar item.
        component.disable();

        if (IsGrid) {
            // enable the toolbar item on grid selection change.
            centerView.addListener('selectionchange', function(grid, selected)
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
     * Get the toolbar configuration from the system data storage.
     *
     * @private
     * @return {Boolean} Void.
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
     * Return whatever the given component matches the selector string.
     *
     * @private
     * @param {Ext.Component} component description1
     * @param {String} selector description2
     * @return {Boolean} Void.
     */
    componentIs: function(component, selector)
    {
        if (!component) {
            // End.
            return false;
        }

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
    },
    /**
     * Return whatever the given component is a toolbar.
     *
     * @private
     * @param {Ext.Component} component description
     * @return {Boolean} Void.
     */
    isToolbar: function(component)
    {
        // End.
        return this.componentIs(component, 'toolbar');
    }
});