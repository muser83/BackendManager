/**
 * Report.js
 * Created on Jan 29, 2013 11:54:05 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.view.application.issue.form.Report', {
    extend: 'Ext.form.Panel',
//    icon: '',
//    title: '',
    border: false,
    shrinkWrap: 3,
//    height: 350,
//    width: 500,
//    padding: undefined,
//    margin: undefined,
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
//    tpl: undefined,
    listeners: {
    },
    defaults: {
    },
//    tools: [],
    items: [{
            xtype: 'fieldcontainer',
//            layout: '',
            fieldDefaults: {
                labelAlign: 'top',
                labelWidth: 450,
                width: 450,
                margin: 10
            },
            items: [{
                    xtype: 'combobox',
                    editable: false,
                    name: 'priority',
                    fieldLabel: 'Priority',
                    store: 'App.store.application.Priority',
                    queryMode: 'local',
                    displayField: 'desc',
                    valueField: 'id'
                }, {
                    xtype: 'textareafield',
                    name: 'description',
                    fieldLabel: 'Description',
                    emptyText: 'Describe the inappropriate behaviour or the error messages.'
                }, {
                    xtype: 'textareafield',
                    name: 'reproduce',
                    fieldLabel: 'How to reproduce',
                    emptyText: 'It\'s very important that you describe what you did before the bug appeared.'
                }, {
                    xtype: 'displayfield',
                    labelAlign: 'left',
                    labelWidth: 150,
                    name: '',
                    fieldLabel: 'This bug is reported by',
                    value: 'Boy van Moorsel'
                }, {
                    xtype: 'checkboxfield',
                    name: 'relaunch',
                    checked: true,
                    boxLabel: 'Include system configuration and personal settings.'
                }, {
                    xtype: 'checkboxfield',
                    name: 'relaunch',
                    checked: true,
                    boxLabel: 'Relaunch the system after the bug is reported.'
                }]
        }],
    /* Ext.form.Panel */
//    pollForChanges: false,
//    pollInterval: 500,
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
//    loader: undefined,
//    overCls: '',
//    renderSelectors: undefined,
//    styleHtmlCls: 'x-html',
//    styleHtmlContent: false,
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