/**
 * Base.js
 * Created on Dec 17, 2012 8:28:31 PM
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
 * --- Ext.form.field.Base
 *
 * MIXINS:
 * Ext.form.Labelable
 * Ext.form.field.Field
 *
 * INHERITED MIXINS:
 * Ext.state.Stateful
 * Ext.util.Animate
 * Ext.util.ElementContainer
 * Ext.util.Floating
 * Ext.util.Observable
 * Ext.util.Renderable
 */

var field = {
    xtype: 'field',
    inputType: 'text',
    name: undefined,
    value: undefined,
    fieldLabel: '',
    labelAlign: 'left',
    hideEmptyLabel: true,
    hideLabel: false,
    disabled: false,
    submitValue: true,
    readOnly: false,
    tabIndex: undefined,
    invalidText: 'The value in this field is invalid'
};

Ext.define('App.view.from.field.Base', {
    extend: 'Ext.Component',
    /* Ext.form.field.Base */
    baseCls: undefined,
    checkChangeBuffer: 50,
    checkChangeEvents: undefined,
    componentLayout: 'field',
    dirtyCls: undefined,
    fieldCls: undefined,
    fieldStyle: undefined,
    focusCls: 'x-form-focus',
    inputId: undefined,
    inputType: 'text',
    invalidText: 'The value in this field is invalid',
    name: undefined,
    readOnly: false,
    readOnlyCls: undefined,
    tabIndex: undefined,
    validateOnBlur: true,
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
    contentEl: undefined,
    data: undefined,
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
    /* Ext.form.Labelable */
    activeError: undefined,
    activeErrorsTpl: undefined,
    afterBodyEl: undefined,
    afterLabelTextTpl: undefined,
    afterLabelTpl: undefined,
    afterSubTpl: undefined,
    autoFitErrors: true,
    baseBodyCls: undefined,
    beforeBodyEl: undefined,
    beforeLabelTextTpl: undefined,
    beforeLabelTpl: undefined,
    beforeSubTpl: undefined,
    clearCls: undefined,
    errorMsgCls: undefined,
    fieldBodyCls: '',
    fieldLabel: undefined,
    formItemCls: undefined,
    hideEmptyLabel: true,
    hideLabel: false,
    invalidCls: undefined,
    labelAlign: 'left',
    labelAttrTpl: undefined,
    labelCls: undefined,
    labelClsExtra: undefined,
    labelPad: 5,
    labelSeparator: ':',
    labelStyle: undefined,
    labelWidth: 100,
    msgTarget: 'qtip',
    preventMark: false,
    /* Ext.form.field.Field */
    disabled: false,
    submitValue: true,
    validateOnChange: true,
    value: undefined,
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