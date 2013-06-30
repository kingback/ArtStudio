

YUI.add('mytabview', function(Y) {
    
    var NAME = 'mytabview';
    
    function MyTabView() {
        MyTabView.superclass.constructor.apply(this, arguments);
    }
    
    MyTabView.NAME = NAME;
    
    MyTabView.ATTRS = {
        circular: {
            value: false
        },
        defSelection: {
            value: 0
        },
        panelSelector: {
            value: ''
        },
        panelNodes: {
            value: null
        },
        render: {
            value: false
        },
        selection: {
            value: -1
        },
        srcNode: {
            setter: Y.one,
            writeOnce: true
        },
        tabSelector: {
            value: ''
        },
        tabNodes: {
            value: null
        },
        hoverDelay: {
            value: -1
        },
        triggerEvent: {
            value: 'click'
        }
    };
    
    Y.extend(MyTabView, Y.Base, {
        
        // ----------------------------- LifeCyle 方法 ------------------------------
        
        initializer: function(cfg) {
            
            this._srcNode = this.get('srcNode');
            
            this.publish('switch');
            
            this._tabEvents = [];
            
            this._panelSelector = this.get('panelSelector');
            this._tabSelector = this.get('tabSelector');
            
            this.set('panelNodes', this._srcNode.all(this._panelSelector));
            this.set('tabNodes', this._srcNode.all(this._tabSelector));
            
            this._CLS_TAB_VIEW = Y.ClassNameManager.getClassName(NAME);
            this._CLS_TAB = Y.ClassNameManager.getClassName(NAME, 'tab');
            this._CLS_TAB_LIST = Y.ClassNameManager.getClassName(NAME, 'tab', 'list');
            this._CLS_TAB_SELECTED = Y.ClassNameManager.getClassName(NAME, 'tab', 'selected');
            this._CLS_PANEL = Y.ClassNameManager.getClassName(NAME, 'panel');
            this._CLS_PANEL_LIST = Y.ClassNameManager.getClassName(NAME, 'panel', 'list');
            this._CLS_PANEL_SHOW = Y.ClassNameManager.getClassName(NAME, 'panel', 'show');
            
            this.rendered = false;
            
            if (this.get('render')) {
                this.render();
            }
        },
        
        destructor: function() {
            while (this._tabEvents.length) {
                this._tabEvents.pop().detach();
            }
        },
        
        render: function(cfg) {
            if (cfg) {
                this.setAttrs(cfg);
                this._panelSelector = this.get('panelSelector');
                this._tabSelector = this.get('tabSelector');
                this.set('panelNodes', this._srcNode.all(this._panelSelector));
                this.set('tabNodes', this._srcNode.all(this._tabSelector));
            }
            
            this.renderUI();
            this.bindUI();
            this.syncUI();
            this.rendered = true;
        },
        
        renderUI: function() {
            this._renderCls();
        },
        
        bindUI: function() {
            this._bindSelectionChange();
            this._bindTrigger();
            return this;
        },
        
        syncUI: function() {
            this._syncDefSelection();
        },
        
        
        
        // ----------------------------- 公用 API ------------------------------
        
        
        
        next: function(circular) {
            var selection = this.get('selection'),
                max = this.get('panelNodes').size() - 1,
                index = selection + 1;
                
            if (typeof circular === 'undefined') {
                circular = this.get('circular');
            }
            
            index = index <= max ? index : (circular ? 0 : selection);
            
            this.switchTo(index);
        },
        
        prev: function(circular) {
            var selection = this.get('selection'),
                max = this.get('panelNodes').size() - 1,
                index = selection - 1;
                
            if (typeof circular === 'undefined') {
                circular = this.get('circular');
            }
            
            index = index >= 0 ? index : (circular ? max : 0);
            
            this.switchTo(index);
        },
        
        switchTo: function(index) {
            this.set('selection', index);
        },
        
        
        
        // ----------------------------- 私有方法 ------------------------------
        
        
        
        _bindSelectionChange: function() {
            this._tabEvents.push(
                this.after('selectionChange', this._afterSelectionChange, this)
            );
        },
        
        _bindTrigger: function() {
            var triggerEvent = this.get('triggerEvent');
            
            if (triggerEvent === 'hover') {
                this._hoverTimer = null;
                this._tabEvents.push(
                    this._srcNode.delegate(triggerEvent, Y.bind(this._onTriggerMouseEnter, this), Y.bind(this._onTriggerMouseLeave, this), this._tabSelector)
                );
            } else {
                this._tabEvents.push(
                    this._srcNode.delegate(triggerEvent, this._onTriggerOtherEvent, this._tabSelector, this)
                );
            }
        },
        
        _hidePrevSelection: function(e) {
            e.prevTab && e.prevTab.removeClass(this._CLS_TAB_SELECTED);
            e.prevPanel && e.prevPanel.removeClass(this._CLS_PANEL_SHOW);
        },
        
        _renderCls: function() {
            var srcNode = this.get('srcNode'),
                tabNodes = this.get('tabNodes'),
                panelNodes = this.get('panelNodes');
            
            srcNode.addClass(this._CLS_TAB_VIEW);       
            tabNodes.addClass(this._CLS_TAB);
            tabNodes.item(0).ancestor().addClass(this._CLS_TAB_LIST);
            panelNodes.addClass(this._CLS_PANEL);
            panelNodes.item(0).ancestor().addClass(this._CLS_PANEL_LIST);
            
            return this;
        },
        
        _showNewSelection: function(e) {
            e.newTab && e.newTab.addClass(this._CLS_TAB_SELECTED);
            e.newPanel && e.newPanel.addClass(this._CLS_PANEL_SHOW);
        },
        
        _switchSelection: function(e) {
            this._hidePrevSelection(e);
            this._showNewSelection(e);
        },
        
        _switchTo: function(e) {
            var tabNodes = this.get('tabNodes'),
                panelNodes = this.get('panelNodes'),
                prevTab = e.prevVal < 0 ? null : tabNodes.item(e.prevVal),
                prevPanel = e.prevVal < 0 ? null : panelNodes.item(e.prevVal),
                newTab = tabNodes.item(e.newVal),
                newPanel = panelNodes.item(e.newVal),
                eventTarget = {
                    prevSelection: e.prevVal,
                    newSelection: e.newVal,
                    prevTab: prevTab,
                    newTab: newTab,
                    prevPanel: prevPanel,
                    newPanel: newPanel
                };
            
            this._switchSelection(eventTarget);
            
            this.fire('switch', eventTarget);
        },
        
        _syncDefSelection: function() {
            var defSelection = this.get('defSelection');
            if (defSelection >= 0) {
                this.switchTo(defSelection);
            }
        },
        
        
        // ----------------------------- 私有回调函数 ------------------------------
        
        
        _afterSelectionChange: function(e) {
            this._switchTo(e);
        },
        
        _onTriggerOtherEvent: function(e) {
            var target = e.currentTarget,
                tabNodes = this.get('tabNodes'),
                index = tabNodes.indexOf(target);
                
            this.switchTo(index);
        },
        
        _onTriggerMouseEnter: function(e) {
            var target = e.currentTarget,
                tabNodes = this.get('tabNodes'),
                hoverDelay = this.get('hoverDelay'),
                index = tabNodes.indexOf(target),
                that = this;
                
            if (hoverDelay > 0) {
                this._hoverTimer && clearTimeout(this._hoverTimer);
                this._hoverTimer = setTimeout(function() {
                    that.switchTo(index);
                }, hoverDelay);
            } else {
                this.switchTo(index);
            }
        },
        
        _onTriggerMouseLeave: function(e) {
            this._hoverTimer && clearTimeout(this._hoverTimer);
            this._hoverTimer = null;
        }
        
        
    });
    
    Y.MyTabView = MyTabView;

}, '1.0.0', {
    requires: ['base', 'classnamemanager', 'node', 'event', 'event-delegate']
});