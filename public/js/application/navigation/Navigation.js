/**
 * Navigation.js
 * Created on Oct 29, 2012 7:48:09 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */

/**
 *
 */
Ext.define('App.navigation.Navigation', {
    navigationDOM: undefined,
    /**
     * Constructor
     *
     * @return {App.navigation.Navigation}
     */
    constructor: function()
    {
        this.navigationDOM = Ext.get('application-header-navigation');

        // End.
        return this;
    },
    /**
     * Initialize the navigation DOM for navigation use,
     * add classes, create new elements and set Event Handlers.
     *
     * @return {Boolean} Void
     */
    init: function()
    {
        var showTask = new Ext.util.DelayedTask(this.show, this);
        var hideTask = new Ext.util.DelayedTask(this.hide, this);
        var hideSiblingsTask = new Ext.util.DelayedTask(this.hideSiblings,
            this);

        this.navigationDOM.select('li').addCls('application-navigation-item');

        this.navigationDOM.select('>li').addCls('application-navigation-tab');

        this.navigationDOM.select('li>ul')
            .addCls('application-navigation-list')
            .hide();

        this.navigationDOM.select('li>ul').each(function(item)
        {
            item.last().select('a').addCls('application-navigation-anchor-last');
        });

        this.navigationDOM.select('a').each(function(anchor)
        {
            var anchorHref = anchor.dom.pathname;
            anchor.addCls('application-navigation-anchor');
            anchor.set({
                href: '#' + anchorHref
            });
        });

        this.navigationDOM.select('li:has(>ul)').each(function(item)
        {
            var minListWidth;
            var list = item.first('ul');

            item.first('a').on('click', function(event)
            {
                event.preventDefault();

                hideSiblingsTask.delay(10, false, false, [list.parent()]);
                showTask.delay(210, false, false, [list]);
            });

            item.first('a').createChild({
                tag: 'span',
                cls: 'application-arrow'
            });

            minListWidth = item.getWidth();

            list.setStyle('min-width', (minListWidth + 'px'));

            item.select('ul>li a').each(function(anchor)
            {
                var anchorHtml = anchor.getHTML();
                var anchorIcon = anchor.getAttribute('icon');
                // Clrear;
                anchor.setHTML('');

                anchor.insertFirst({
                    tag: 'div',
                    html: anchorHtml,
                    cls: 'application-navigation-anchor-icon icon-' + anchorIcon
                });
            });

            item.select('li:has(>ul)').each(function(list)
            {
                list.down('ul').setStyle('left',
                    ((minListWidth - 9) + 'px'));
            });

            item.hover(function()
            {
                hideSiblingsTask.delay(10, false, false, [list.parent()]);
                showTask.delay(210, false, false, [list]);
            }, function() {
                hideTask.delay(300, false, false, [list]);
            });

            list.hover(hideTask.cancel, function()
            {
                hideTask.delay(300, false, false, [list]);
            });
        });

        // End.
        return true;
    },
    /**
     * Highlight the loaded module tab(s).
     *
     * @param {String} url This url will be used to search the loaded module tab
     * @return {Boolean} true if the tab is highlighted, false otherwhise.
     */
    highlightTab: function(url)
    {
        var selectedAnchors;

        do {
            selectedAnchors = this.navigationDOM
                .select('a[href=#' + url + ']');

            url = url.slice(0, -1);

            if (url.length < 0) {
                // End.
                return false;
            }

        } while (selectedAnchors.elements.length < 1);

        this.hideOpen();

        this.navigationDOM.select('li.application-active')
            .removeCls('application-active');

        // It is possible to highlight multiple tabs.
        selectedAnchors.each(function(selectedAnchor)
        {
            selectedAnchor.parent('li.application-navigation-tab')
                .addCls('application-active');
        });

        // End.
        return true;

    },
    /**
     * Show the navigation list DOM.
     *
     * @param {Ext.CompositeElement} list Navigation list DOM.
     * @return {Boolean} Void
     */
    show: function(list)
    {
        list.prev().addCls('application-navigation-anchor-active');

        list.show();

        // End.
        return true;
    },
    /**
     * Hide the navigation list DOM.
     *
     * @param {Ext.CompositeElement} list Navigation list DOM.
     * @return {Boolean} Void
     */
    hide: function(list)
    {
        list.prev().removeCls('application-navigation-anchor-active');

        list.select('li:has(>ul)').each(function(item)
        {
            item.first('ul').hide();
        });

        list.hide();

        // End.
        return true;
    },
    /**
     * Hide all list DOM siblings and parent elements.
     *
     * @param {Ext.CompositeElement} list Navigation list DOM.
     * @return {Boolean} Void
     */
    hideSiblings: function(list)
    {
        list.parent().select('li:has(>ul)').each(function(sibling)
        {
            if (list.dom.id !== sibling.dom.id) {
                sibling.first('ul').hide();
                sibling.first('a')
                    .removeCls('application-navigation-anchor-active');
            }
        });

        // End.
        return true;
    },
    /**
     * Hide all open navigation lists
     *
     * @return {Boolean} Void
     */
    hideOpen: function()
    {
        this.navigationDOM.select('li>ul').hide();

        // End.
        return true;
    }
});