/**
 * HIERARCHY:
 * Ext.Base
 * - Ext.AbstractComponent
 * -- Ext.Component
 * --- Ext.container.AbstractContainer
 * ---- Ext.container.Container
 * ----- Ext.panel.AbstractPanel
 * ------ Ext.panel.Panel
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

var panel = {
    icon: '',
    title: '',
    shrinkWrap: 2,
    height: undefined,
    width: undefined,
    margin: undefined,
    padding: undefined,
    maxHeight: undefined,
    maxWidth: undefined,
    layout: undefined,
    tools: [],
    defaults: {},
    items: [],
    initComponent: function()
    {
        this.callParent();
    }
};
Ext.define('App.view.panel.Panel', {
    extend: 'Ext.panel.Panel',
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
    layout: undefined,
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