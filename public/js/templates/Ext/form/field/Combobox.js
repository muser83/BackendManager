/**
 * Combobox.js
 * Created on Dec 17, 2012 8:28:42 PM
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
 * ---- Ext.form.field.Text
 * ----- Ext.form.field.Trigger
 * ------ Ext.form.field.Picker
 *
 * MIXINS:
 * Ext.util.Bindable
 *
 * INHERITED MIXINS:
 * Ext.form.Labelable
 * Ext.form.field.Field
 * Ext.state.Stateful
 * Ext.util.Animate
 * Ext.util.ElementContainer
 * Ext.util.Floating
 * Ext.util.Observable
 * Ext.util.Renderable
 */

var combobox, combo = {
xtype: 'combobox',
    store: undefined,
    displayField: 'name',
    valueField: 'id',
    name: undefined,
    value: undefined,
    fieldLabel: '',
    labelAlign: 'left',
    maxLength: 255,
    minChars: 4,
    multiSelect: false,
    forceSelection: false,
    editable: true,
    allowBlank: true,
    hideEmptyLabel: true,
    disabled: false,
    submitValue: true,
    readOnly: false,
    tabIndex: undefined,
    vtype: undefined, // alpha, alphanum, email, url
    invalidText: 'The value in this field is invalid'
    };

Ext.define('App.view.from.field.Combobox', {
    extend: 'Ext.from.field.Picker',
    /* Ext.form.field.ComboBox*/
    valueField: '',
    allQuery: '',
    autoSelect: true,
    componentLayout: 'combobox',
    defaultListConfig: {
        loadingHeight: 70,
        minWidth: 70,
        maxHeight: 300,
        shadow: 'sides'
    },
    delimiter: ', ',
    displayField: 'text',
    enableRegEx: false,
    fieldSubTpl: undefined, // See config.
    forceSelection: false,
    growToLongestValue: true,
    hiddenName: '',
    listConfig: undefined,
    minChars: 4,
    multiSelect: false,
    pageSize: 0,
    queryCaching: true,
    queryDelay: 500,
    queryMode: 'remote',
    queryParam: 'query',
    selectOnTab: true,
    store: undefined,
    transform: undefined,
    triggerAction: 'all',
    triggerCls: undefined,
    typeAhead: false,
    typeAheadDelay: 250,
    valueNotFoundText: undefined,
    /* Ext.form.field.Picker */
    editable: true,
    matchFieldWidth: true,
    openCls: undefined,
    pickerAlign: 'tl-bl?',
    pickerOffset: undefined,
    /* Ext.form.field.Trigger */
    hideTrigger: false,
    readOnly: false,
    repeatTriggerClick: false,
    selectOnFocus: false,
    triggerBaseCls: undefined,
    triggerNoEditCls: undefined,
    triggerWrapCls: undefined,
    /* Ext.form.field.Text*/
    allowBlank: true,
    allowOnlyWhitespace: true,
    blankText: 'This field is required',
    disableKeyFilter: false,
    emptyCls: undefined,
    emptyText: undefined,
    enableKeyEvents: false,
    enforceMaxLength: false,
    grow: false,
    growAppend: 'W',
    growMax: 800,
    growMin: 30,
    maskRe: undefined,
    maxLength: undefined,
    maxLengthText: 'The maximum length for this field is {0}',
    minLength: 0,
    minLengthText: 'The minimum length for this field is {0}',
    regex: undefined,
    regexText: '',
    requiredCls: undefined,
    size: 20,
    stripCharsRe: undefined,
    validator: undefined,
    vtype: undefined,
    vtypeText: undefined,
    /* Ext.form.field.Base */
    baseCls: undefined,
    checkChangeBuffer: 50,
    checkChangeEvents: undefined,
    dirtyCls: undefined,
    fieldCls: undefined,
    fieldStyle: undefined,
    focusCls: 'x-form-focus',
    inputId: undefined,
    inputType: 'text',
    invalidText: 'The value in this field is invalid',
    name: undefined,
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
    /* Ext.util.Bindable */
    bindStore: false,
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