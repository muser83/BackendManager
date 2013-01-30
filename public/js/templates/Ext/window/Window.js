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

var window = {
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
    defaults: {
    },
    items: [],
    initComponent: function()
    {
        this.callParent();
    }
};
Ext.define('App.view.window.Window', {
    extend: 'Ext.window.Window',
    /* Ext.window.Window*/
    animateTarget: null,
    autoRender: true,
    baseCls: 'x-window',
    closable: true,
    collapsed: false,
    collapsible: false,
    constrain: false,
    constrainHeader: false,
    defaultFocus: undefined,
    draggable: true,
    expandOnShow: true,
    ghost: undefined, // Function
    hidden: true,
    hideMode: 'offsets',
    hideShadowOnDeactivate: false,
    maximizable: false,
    maximized: false,
    minHeight: 50,
    minWidth: 50,
    minimizable: false,
    modal: false,
    onEsc: undefined, // Function
    overlapHeader: true,
    plain: false,
    resizable: true,
    x: undefined,
    y: undefined,
    /* Ext.panel.Panel */
    animCollapse: true,
    bbar: undefined,
    buttonAlign: undefined,
    buttons: undefined,
    closeAction: 'destroy',
    collapseDirection: 'top',
    collapseFirst: true,
    collapseMode: undefined,
    collapsedCls: 'collapsed',
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
    placeholder: undefined,
    placeholderCollapseHideMode: undefined,
    rbar: undefined,
    tbar: undefined,
    title: '',
    titleAlign: 'left',
    titleCollapse: false,
    tools: undefined,
    /* Ext.panel.AbstractPanel */
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
    floating: false,
    formBind: false,
    overflowX: 'hidden',
    overflowY: 'hidden',
    region: undefined,
    resizeHandles: 'all',
    toFrontOnShow: true,
    /* Ext.AbstractComponent */
    autoEl: undefined,
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
    html: '',
    id: undefined,
    itemId: undefined,
    loader: undefined,
    margin: undefined,
    maxHeight: undefined,
    maxWidth: undefined,
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
        top: {
            render: 1,
            visual: 1
        },
        left: {
            render: 3,
            visual: 5
        },
        right: {
            render: 5,
            visual: 7
        },
        bottom: {
            render: 7,
            visual: 3
        }
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