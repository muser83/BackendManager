/**
 * Viewport.js
 * Created on Oct 1, 2012 9:07:29 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */

Ext.define('App.view.Viewport', {
    extend: 'Ext.Viewport',
    /**
     * If true the container will automatically destroy any contained component
     * that is removed from it, else destruction must be handled manually.
     * Defaults to: true
     *
     * @type {Bool}
     */
    autoDestroy: true,
    /**
     * true to use overflow:'auto' on the components layout element and show
     * scroll bars automatically when necessary, false to clip any overflowing
     * content. This should not be combined with overflowX or overflowY.
     * Defaults to: false
     *
     * @type {Bool}
     */
    autoScroll: false,
    /**
     * True to automatically show the component upon creation. This config
     * option may only be used for floating components or components that use
     * autoRender. Defaults to false.
     * Defaults to: false
     *
     * @type {Bool}
     */
    autoShow: false,
    /**
     * Specifies the border size for this component. The border can be a single
     * numeric value to apply to all sides or it can be a CSS style
     * specification for each style, for example: '10 5 3 10'.
     *
     * For components that have no border by default, setting this won't make
     * the border appear by itself. You also need to specify border color and
     * style:
     * border: 5,
     * style: {
     *     borderColor: 'red',
     *     borderStyle: 'solid'
     * }
     * To turn off the border, use border: false.
     *
     * @type {Number | String | Bool}
     */
    border: false,
    /**
     * An array of events that, when fired, should be bubbled to any parent
     * container. See Ext.util.Observable.enableBubble.
     * Defaults to: ["add", "remove"]
     *
     * @type {String}
     */
    bubbleEvents: [],
    /**
     * The default xtype of child Components to create in this Container when a
     * child item is specified as a raw configuration object, rather than as an
     * instantiated Component.
     * Defaults to: "panel"
     *
     * @type {String}
     */
    defaultType: 'panel',
    /**
     * This option is a means of applying default settings to all added items
     * whether added through the items config or via the add or insert methods.
     * Defaults are applied to both config objects and instantiated components
     * conditionally so as not to override existing properties in the item
     * (see Ext.applyIf).If the defaults option is specified as a function, then
     * the function will be called using this Container as the scope
     * (this reference) and passing the added item as the first parameter.
     * Any resulting object from that call is then applied to the item as
     * default properties.For example, to automatically apply padding to the
     * body of each of a set of contained Ext.panel.Panel items, you could pass:
     * defaults: {bodyStyle:'padding:15px'}.
     *
     * defaults: { // defaults are applied to items, not the container
     *     autoScroll: true
     * },
     * items: [
     * // default will not be applied here, panel1 will be autoScroll: false
     * {
     *     xtype: 'panel',
     *     id: 'panel1',
     *     autoScroll: false
     * },
     * // this component will have autoScroll: true
     * new Ext.panel.Panel({
     *     id: 'panel2'
     * })]
     *
     * @type {Object/ Function}
     */
    defaults: {
        border: false
    },
    /**
     * A single item, or an array of child Components to be added to this
     * containerUnless configured with a layout, a Container simply renders
     * child Components serially into its encapsulating element and performs no
     * sizing or positioning upon them.
     * Example:
     * // specifying a single item
     * items: {...},
     * layout: 'fit', // The single items is sized to fit
     * // specifying multiple items
     * items: [{...}, {...}],
     * layout: 'hbox', // The items are arranged horizontally
     * Each item may be:
     * A Component
     * A Component configuration object
     *
     * If a configuration object is specified, the actual type of Component to
     * be instantiated my be indicated by using the xtype option.
     * Every Component class has its own xtype.If an xtype is not explicitly
     * specified, the defaultType for the Container is used, which by default
     * is usually panel.
     * Notes:
     * Ext uses lazy rendering. Child Components will only be rendered should it
     * become necessary. Items are automatically laid out when they are first
     * shown (no sizing is done while hidden), or in response to a doLayout call
     * Do not specify contentEl or html with items.
     *
     * @type {Object}
     */
    items: [
        {
            region: 'north',
            contentEl: 'application-header',
            height: 46
        }, {
            region: 'center',
            layout: 'fit',
            contentEl: 'application-content'
        }
    ],
    /**
     * Important: In order for child items to be correctly sized and positioned,
     * typically a layout manager must be specified through the layout
     * configuration option.
     * The sizing and positioning of child items is the responsibility of the
     * Container's layout manager which creates and manages the type of layout
     * you have in mind. For example: If the layout configuration is not
     * explicitly specified for a general purpose container
     * (e.g. Container or Panel) the default layout manager will be used which
     * does nothing but render child components sequentially into the Container
     * (no sizing or positioning will be performed in this situation).
     * layout may be specified as either as an Object or as a String:
     *
     * Specify as an Object
     * Example usage:
     * layout: {
     *     type: 'vbox',
     *     align: 'left'
     * }
     *
     * type
     * The layout type to be used for this container. If not specified, a
     * default Ext.layout.container.Auto will be created and used.
     * Valid layout type values are:
     * Auto - Default
     * card
     * fit
     * hbox
     * vbox
     * anchor
     * table
     * Layout specific configuration properties
     *
     * Additional layout specific configuration properties may also be specified
     * For complete details regarding the valid config options for each layout
     * type, see the layout class corresponding to the type specified.
     *
     * Specify as a String
     * Example usage:
     * layout: 'vbox'
     * layout
     * The layout type to be used for this container
     * (see list of valid layouttype values above).
     * Additional layout specific configuration properties. For complete details
     * regarding the valid config options for each layout type, see the layout
     * class corresponding to the layout specified.
     *
     * Configuring the default layout type
     * If a certain Container class has a default layout (For example a Toolbar
     * with a default `Box` layout), then to simply configure the default layout
     * use an object, but without the `type` property:
     * xtype: 'toolbar',
     * layout: {
     *     pack: 'center'
     * }
     *
     * @type {Object/ String}
     */
    layout: 'border'
});