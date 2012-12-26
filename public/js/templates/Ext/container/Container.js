/**
 * HIERARCHY:
 * Ext.Base
 * - Ext.AbstractComponent
 * -- Ext.Component
 * --- Ext.container.AbstractContainer
 * ---- Ext.container.Container
 *
 * MIXINS:
 * INHERITED MIXINS:
 * Ext.state.Statefull
 * Ext.util.Animate
 * Ext.util.ElementContainer
 * Ext.util.Floating
 * Ext.util.Observable
 * Ext.util.Renderable
 */

var component, box = {

};

Ext.define('App.view.container.Container', {
    extend: 'Ext.container.Container',
    /* Ext.container.Container */
    anchorSize: undefined,
    /* Ext.container.AbstractContainer */
    activeItem: undefined,
    autoDestroy: true,
    baseCls: Ext.baseCSSPrefix + 'container',
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
    border: undefined,
    childEls: undefined,
    cls: '',
    componentCls: undefined,
    componentLayout: undefined,
    contentEl: undefined,
    data: undefined,
    disabled: false,
    disabledCls: 'x-item-disabled',
    frame: undefined,
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