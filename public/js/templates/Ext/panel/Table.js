/**
 * HIERARCHY:
 * Ext.Base
 * - Ext.AbstractComponent
 * -- Ext.Component
 * --- Ext.container.AbstractContainer
 * ---- Ext.container.Container
 * ----- Ext.panel.AbstractPanel
 * ------ Ext.panel.Panel
 * ------- Ext.panel.Table
 *
 * MIXINS:
 *
 * INHERITED MIXINS:
 * Ext.container.DockingContainer
 * Ext.state.Statefull
 * Ext.util.Animate
 * Ext.util.ElementContainer
 * Ext.util.Floating
 * Ext.util.Observable
 * Ext.util.Renderable
 */

var table = {
    icon: '',
    title: '',
    forceFit: false,
    allowDeselect: false,
    disableSelection: false,
    columnLines: false,
    rowLines: true,
    enableColumnHide: true,
    enableColumnMove: true,
    enableColumnResize: true,
    enableLocking: false,
    sealedColumns: false,
    sortableColumns: true,
    scroll: true,
    shrinkWrap: 2,
    height: undefined,
    width: undefined,
    tools: [],
    defaults: {},
    emptyText: '',
    columns: [],
    initComponent: function()
    {
        this.callParent();
    }
};

Ext.define('App.view.panel.Table', {
    extend: 'Ext.panel.Table',
    /* Ext.panel.Table */
    allowDeselect: false,
    columnLines: undefined,
    columns: undefined,
    deferRowRender: true,
    disableSelection: false,
    emptyText: '',
    enableColumnHide: true,
    enableColumnMove: true,
    enableColumnResize: true,
    enableLocking: false,
    features: undefined,
    forceFit: undefined,
    hideHeaders: false,
    layout: 'fit',
    rowLines: true,
    scroll: true,
    sealedColumns: false,
    selModel: undefined,
    selType: 'rowmodel',
    sortableColumns: true,
    verticalScroller: undefined,
    view: undefined,
    viewConfig: undefined,
    /* Ext.panel.Panel */
    animCollapse: true,
    bbar: undefined,
    buttonAlign: undefined,
    buttons: undefined,
    closable: false,
    closeAction: 'destroy',
    collapseDirection: 'top',
    collapseFirst: true,
    collapseMode: undefined,
    collapsed: false,
    collapsedCls: 'collapsed',
    collapsible: false,
    dockedItems: undefined,
    fbar: undefined,
    floatable: true,
    frame: false,
    frameHeader: true,
    header: undefined,
    headerPosition: 'top',
    hideCollapseTool: false,
    icon: '',
    iconCls: undefined,
    lbar: undefined,
    manageHeight: true,
    minButtonWidth: 75,
    overlapHeader: undefined,
    placeholder: undefined,
    placeholderCollapseHideMode: undefined,
    rbar: undefined,
    tbar: undefined,
    title: '',
    titleAlign: 'left',
    titleCollapse: false,
    tools: undefined,
    /* Ext.panel.AbstractPanel */
    baseCls: 'x-panel',
    bodyBorder: undefined,
    bodyCls: undefined,
    bodyPadding: undefined,
    bodyStyle: undefined,
    border: true,
    /* Ext.container.Container */
    anchorSize: undefined,
    /* Ext.container.AbstractContainer */
    activeItem: undefined,
    autoDestroy: true,
    bubbleEvents: ['add', 'remove'],
    defaultType: 'panel',
    defaults: undefined,
    detachOnRemove: true,
    items: undefined,
    suspendLayout: false,
    /* Ext.Component */
    autoScroll: false,
    columnWidth: undefined,
    constrainTo: undefined,
    defaultAlign: 'tl-bl?',
    draggable: false,
    floating: false,
    formBind: false,
    overflowX: 'hidden',
    overflowY: 'hidden',
    region: undefined,
    resizable: false,
    resizeHandles: 'all',
    toFrontOnShow: true,
    /* Ext.AbstractComponent */
    autoEl: undefined,
    autoRender: false,
    autoShow: false,
    childEls: undefined,
    cls: '',
    componentCls: undefined,
    componentLayout: undefined,
    contentEl: undefined,
    data: undefined,
    disabled: false,
    disabledCls: 'x-item-disabled',
    height: undefined,
    hidden: false,
    hideMode: 'display',
    html: '',
    id: undefined,
    itemId: undefined,
    loader: undefined,
    margin: undefined,
    maxHeight: undefined,
    maxWidth: undefined,
    minHeight: undefined,
    minWidth: undefined,
    overCls: '',
    padding: undefined,
    plugins: undefined,
    renderData: undefined,
    renderSelectors: undefined,
    renderTo: undefined,
    shrinkWrap: 2,
    style: undefined,
    styleHtmlCls: 'x-html',
    styleHtmlContent: false,
    tpl: undefined,
    tplWriteMode: 'overwrite',
    ui: 'default',
    width: undefined,
    xtype: undefined,
    /*
     * MIXINS
     */
    /* Ext.container.DockingContainer */
    defaultDockWeights: {
        top: {render: 1, visual: 1},
        left: {render: 3, visual: 5},
        right: {render: 5, visual: 7},
        bottom: {render: 7, visual: 3}
    },
    /* Ext.util.Floating */
    focusOnToFront: true,
    shadow: 'sides',
    shadowOffset: undefined,
    /* Ext.state.Statefull */
    saveDelay: 100,
    stateEvents: undefined,
    stateId: undefined,
    stateful: false,
    /* Ext.util.Animate */

    /* Ext.util.ElementContainer */

    /* Ext.util.Observable */
    listeners: undefined,
    /* Ext.util.Renderable */

    /* */
    initComponent: function()
    {
        this.callParent();
    }
});