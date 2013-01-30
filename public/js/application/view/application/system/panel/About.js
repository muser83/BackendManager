/**
 * About.js
 * Created on Jan 29, 2013 6:53:05 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
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
Ext.define('App.view.application.system.panel.About', {
    extend: 'Ext.panel.Panel',
    border: false,
    shrinkWrap: 2,
    height: 330,
    width: 575,
//    padding: 0,
//    margin: 0,
//    maxHeight: undefined,
//    maxWidth: undefined,
//    minHeight: undefined,
//    minWidth: undefined,
//    style: undefined,
//    layout: undefined,
//    plugins: [],
//    renderData: undefined,
//    renderTo: undefined,
//    contentEl: undefined,
//    html: '',
//    data: undefine,
//    tpl: '',
//    listeners: {
//    },
//    defaults: {
//    },
//    tools: [],
//    items: [],
    /* Ext.panel.Panel */
//    animCollapse: true,
//    bbar: undefined,
//    buttonAlign: undefined,
//    buttons: undefined,
//    closable: false,
//    closeAction: 'destroy',
//    collapseDirection: 'top',
//    collapseFirst: true,
//    collapseMode: undefined,
//    collapsed: false,
//    collapsedCls: 'collapsed',
//    collapsible: false,
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
//    overlapHeader: undefined,
//    placeholder: undefined,
//    placeholderCollapseHideMode: undefined,
//    rbar: undefined,
//    tbar: undefined,
//    titleAlign: 'left',
//    titleCollapse: false,
    /* Ext.panel.AbstractPanel */
//    baseCls: 'x-panel',
//    bodyBorder: undefined,
//    bodyCls: undefined,
//    bodyPadding: undefined,
//    bodyStyle: undefined,
    /* Ext.container.Container */
//    anchorSize: undefined,
    /* Ext.container.AbstractContainer */
//    activeItem: undefined,
//    autoDestroy: true,
//    bubbleEvents: ['add', 'remove'],
//    defaultType: 'panel',
//    detachOnRemove: true,
//    suspendLayout: false,
    /* Ext.Component */
//    autoScroll: false,
//    columnWidth: undefined,
//    constrainTo: undefined,
//    defaultAlign: 'tl-bl?',
//    draggable: false,
//    floating: false,
//    formBind: false,
//    overflowX: 'hidden',
//    overflowY: 'hidden',
//    region: undefined,
//    resizable: false,
//    resizeHandles: 'all',
//    toFrontOnShow: true,
    /* Ext.AbstractComponent */
//    autoEl: undefined,
//    autoRender: false,
//    autoShow: false,
//    childEls: undefined,
//    cls: '',
//    componentCls: undefined,
//    componentLayout: undefined,
//    disabled: false,
//    disabledCls: 'x-item-disabled',
//    hidden: false,
//    hideMode: 'display',
//    id: undefined,
//    itemId: undefined,
    loader: {
        url: 'http://backendmanager.dev/~system/about',
        autoLoad: true,
        renderer: 'html'
    },
//    overCls: '',
//    renderSelectors: undefined,
//    styleHtmlCls: 'x-html',
    styleHtmlContent: true,
//    tplWriteMode: 'overwrite',
//    ui: 'default',
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
    /* Ext.util.Renderable */
    /* */
    initComponent: function()
    {
        this.callParent();
    }
});