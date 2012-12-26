/**
 * Component template rules:
 * Always add an docblock with the Hierarchy and Mixins.
 * Use the Mixins to seperate the config options.
 *
 * If this component can be used as xtype, make an variable with an object with
 * the most used config options and declare this config object on top of the
 * component.
 *
 * If there is no default value for an config option use undefined as default.
 */

/**
 * HIERARCHY:
 * Ext.Base
 * - Ext.AbstractComponent
 * -- Ext.Component
 *
 * MIXINS:
 * Ext.util.Floating
 *
 * INHERITED MIXINS:
 * Ext.state.Statefull
 * Ext.util.Animate
 * Ext.util.ElementContainer
 * Ext.util.Observable
 * Ext.util.Renderable
 */

var component, box = {

};

Ext.define('App.view.Component', {
    extend: 'Ext.Component',
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
    baseCls: 'x-component',
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