/**
 * Window.js
 * Created on Dec 2, 2012 9:41:42 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.view.application.Window', {
    extend: 'Ext.window.Window',
//    icon: '',
//    title: '',
//    closable: true,
    draggable: true,
    resizable: false,
//    plain: false,
    modal: true,
    shrinkWrap: 3,
//    height: undefined,
//    width: undefined,
//    padding: undefined,
//    margin: undefined,
//    maxHeight: undefined,
//    maxWidth: undefined,
//    minHeight: 50,
//    minWidth: 50,
//    x: undefined,
//    y: undefined,
//    plugins: [],
//    tools: [],
//    buttonAlign: undefined,
    buttons: {
        icon: '/images/icons/black/cancel_icon&16.png',
        text: 'Cancel',
        action: ''
    },
    /* Ext.window.Window*/
//    animateTarget: null,
//    autoRender: true,
//    baseCls: 'x-window',
//    collapsed: false,
//    collapsible: false,
//    constrain: false,
//    constrainHeader: false,
//    defaultFocus: undefined,
//    expandOnShow: true,
//    ghost: undefined, // Function
//    hidden: true,
//    hideMode: 'offsets',
//    hideShadowOnDeactivate: false,
//    maximizable: false,
//    maximized: false,
//    minimizable: false,
//    onEsc: undefined, // Function
//    overlapHeader: true,
    /* Ext.panel.Panel */
//    animCollapse: true,
//    bbar: undefined,
//    closeAction: 'destroy',
//    collapseDirection: 'top',
//    collapseFirst: true,
//    collapseMode: undefined,
//    collapsedCls: 'collapsed',
//    dockedItems: undefined,
//    fbar: undefined,
//    floatable: true,
//    frame: false,
//    frameHeader: true,
//    header: undefined,
//    headerPosition: 'top',
//    hideCollapseTool: false,
//    iconCls: undefined,
//    lbar: undefined,
//    manageHeight: true,
//    minButtonWidth: 75,
//    placeholder: undefined,
//    placeholderCollapseHideMode: undefined,
//    rbar: undefined,
//    tbar: undefined,
//    titleAlign: 'left',
//    titleCollapse: false,
    /* Ext.panel.AbstractPanel */
//    bodyBorder: undefined,
//    bodyCls: undefined,
//    bodyPadding: undefined,
//    bodyStyle: undefined,
//    border: true,
    /* Ext.container.Container */
//    anchorSize: undefined,
    /* Ext.container.AbstractContainer */
//    activeItem: undefined,
//    autoDestroy: true,
//    bubbleEvents: ['add', 'remove'],
//    defaultType: 'panel',
//    defaults: undefined,
//    detachOnRemove: true,
//    items: undefined,
//    layout: undefined,
//    suspendLayout: false,
    /* Ext.Component */
//    autoScroll: false,
//    columnWidth: undefined,
//    constrainTo: undefined,
//    defaultAlign: 'tl-bl?',
//    floating: false,
//    formBind: false,
//    overflowX: 'hidden',
//    overflowY: 'hidden',
//    region: undefined,
//    resizeHandles: 'all',
//    toFrontOnShow: true,
    /* Ext.AbstractComponent */
//    autoEl: undefined,
//    autoShow: false,
//    childEls: undefined,
//    cls: '',
//    componentCls: undefined,
//    componentLayout: undefined,
//    contentEl: undefined,
//    data: undefined,
//    disabled: false,
//    disabledCls: 'x-item-disabled',
//    html: '',
//    id: undefined,
//    itemId: undefined,
//    loader: undefined,
//    overCls: '',
//    renderData: undefined,
//    renderSelectors: undefined,
//    renderTo: undefined,
//    style: undefined,
//    styleHtmlCls: 'x-html',
//    styleHtmlContent: false,
//    tpl: undefined,
//    tplWriteMode: 'overwrite',
//    ui: 'default',
//    xtype: undefined,
    /*
     * MIXINS
     */
    /* Ext.container.DockingContainer */
//    defaultDockWeights: {
//        top: {
//            render: 1,
//            visual: 1
//        },
//        left: {
//            render: 3,
//            visual: 5
//        },
//        right: {
//            render: 5,
//            visual: 7
//        },
//        bottom: {
//            render: 7,
//            visual: 3
//        }
//    },
    /* Ext.util.Floating */
//    focusOnToFront: true,
//    shadow: 'sides',
//    shadowOffset: undefined,
    /* Ext.state.Statefull */
//    saveDelay: 100,
//    stateEvents: undefined,
//    stateId: undefined,
//    stateful: false,
    /* Ext.util.Animate */
    /* Ext.util.ElementContainer */
    /* Ext.util.Observable */
//    listeners: undefined,
    /* Ext.util.Renderable */
    /* */
    initComponent: function()
    {
        this.callParent();
    }
});