/**
 * SimpleSlide
 */

YUI.add('simpleslide', function(Y) {
    
    Y.SimpleSlide = Y.Base.create('simpleslide', Y.Base, [], {
        
        initializer: function() {
            this.publish('slide', {
                defaultFn: this._defSlideFn 
            });
        },
        
        destructor: function() {
            
        },
        
        render: function() {
            this.renderUI();
            this.bindUI();
            this.syncUI();
        },
        
        renderUI: function() {
            this.tabs = this.get('tabs');
            this.panels = this.get('panels'); 
            this.prevBtn = this.get('prevBtn'); 
            this.nextBtn = this.get('nextBtn'); 
            this.delay = this.get('delay');
            this.tabSelectedClass = this.get('tabSelectedClass');
            this.panelSelectedClass = this.get('panelSelectedClass');
            this.total = this.panels.size();
        },
        
        bindUI: function() {
            var event = this.get('event');
            
            this.after('indexChange', this._afterIndexChange);
            
            this.after({
                tabsChange: this._afterAttrChange,
                panelsChange: this._afterAttrChange,
                delayChange: this._afterAttrChange,
                prevBtnChange: this._afterAttrChange,
                nextBtnChange: this._afterAttrChange
            });
            
            if (this.tabs && this.tabs.size()) {
                if (event === 'click') {
                    this.tabs.on('click', this._onTabClick, this);
                } else if (event === 'hover') {
                    this.tabs.on('mouseenter', this._onTabMouseEnter, this);
                    this.tabs.on('mouseleave', this._onTabMouseLeave, this);
                }
            }
            
            if (this.prevBtn) {
                this.prevBtn.on('click', this.prev, this);
            }
            
            if (this.nextBtn) {
                this.nextBtn.on('click', this.next, this);
            }
        },
        
        syncUI: function() {
            this.go(this.get('selected'), false);
        },
        
        go: function(index, anim) {
            this.set('index', index, {
                anim: anim === false ? false : true 
            });
        },
        
        prev: function(e) {
            var index = this.get('index');
            e && e.preventDefault();
            if (index > 0) {
                this.go(index - 1);                
            }
        },
        
        next: function(e) {
            var index = this.get('index');
            e && e.preventDefault();
            if (index < this.total - 1) {
                this.go(index + 1);                
            }
        },
        
        _goToTab: function(tab) {
            this.go(this.tabs.indexOf(tab));
        },
        
        _onTabClick: function(e) {
            e.preventDefault();
            this._goToTab(e.currentTarget);
        },
        
        _onTabMouseEnter: function(e) {
            var self = this;
            
            clearTimeout(this.delayTimer);
            this.delayTimer = setTimeout(function() {
                self._goToTab(e.currentTarget);
            }, this.delay);
        },
        
        _onTabMouseLeave: function() {
            clearTimeout(this.delayTimer);    
        },
        
        _defSlideFn: function(e) {
            if (e.prevTab) {
                e.prevTab.removeClass(this.tabSelectedClass);
            }
            if (e.prevPanel) {
                e.prevPanel.removeClass(this.panelSelectedClass);
            }
            if (e.tab) {
                e.tab.addClass(this.tabSelectedClass);
            }
            if (e.panel) {
                e.panel.addClass(this.panelSelectedClass);
            }
        },
        
        _afterAttrChange: function(e) {
            this[attrName] = e.newVal;
        },
        
        _afterIndexChange: function(e) {
            this.fire('slide', {
                prevIndex: e.prevVal,
                index: e.newVal,
                prevTab: this.tabs && this.tabs.item(e.prevVal),
                prevPanel: this.panels.item(e.prevVal),
                tab: this.tabs && this.tabs.item(e.newVal),
                panel: this.panels.item(e.newVal),
                anim: e.anim
            });
        }
        
    }, {
        
        ATTRS: {
            index: {
                value: -1
            },
            selected: {
                value: 0  
            },
            tabs: {
                setter: Y.all
            },
            panels: {
                setter: Y.all
            },
            prevBtn: {
                setter: Y.one
            },
            nextBtn: {
                setter: Y.one
            },
            event: {
                value: 'click'
            },
            delay: {
                value: 200
            },
            tabSelectedClass: {
                value: 'tab-selected'
            },
            panelSelectedClass: {
                value: 'panel-selected'
            }
        }
        
    });
    
    Y.SimpleSlide.Slide = Y.Base.create('simpleslide-slide', Y.SimpleSlide, [], {
          
        initializer: function() {
            Y.after(this._renderSlideCon, this, 'renderUI', this);
            this.after('slide', this._runSlideAnim);
            this.before('indexChange', this._checkAnimRunning);
            this.running = false;
        },
        
        _renderSlideCon: function() {
            var con = Y.Node.create('<div class="yui3-simpleslide-slidecon"></div>'),
                panelCon = this.panels.item(0).ancestor(),
                width = this.get('width'),
                height = this.get('height'),
                total = this.total,
                x = this.get('dir') === 'x';
                
            panelCon.setStyles({
                width: width + 'px',
                height: height + 'px',
                overflow: 'hidden',
                position: 'relative'
            });
            
            con.setStyles({
                width: (x ? width * total : width) + 'px',
                height: (x ? height : height * total) + 'px',
                overflow: 'hidden',
                position: 'absolute',
                top: '0',
                left: '0'
            });
            
            this.panels.setStyles({
                width: width + 'px',
                height: height + 'px',
                'float': x ? 'left' : 'none' 
            });
            
            this.panels.item(0).insert(con, 'before');
            con.appendChild(this.panels);
            
            this.con = con;
        },
        
        _checkAnimRunning: function(e) {
            if (this.running) {
                e.preventDefault();
            }  
        },
        
        _runSlideAnim: function(e) {
            var self = this,
                x = this.get('dir') === 'x',
                width = this.get('width'),
                height = this.get('height'),
                transCfg = {};
            
            transCfg[x ? 'left' : 'top'] = -(x ? width : height) * e.index + 'px';
            
            if (e.anim) {
                this.running = true;
                this.con.transition(Y.merge(this.get('transCfg'), transCfg), function() {
                    self.running = false;
                });
            } else {
                this.con.setStyles(transCfg);
            }
        }
          
    }, {
        ATTRS: {
            dir: {
                value: 'x'
            },
            transCfg: {
                value: {
                    duration: 0.25
                }
            },
            
            width: {
                value: 200
            },
            
            height: {
                value: 100
            }
        }
    });
    
}, '0.0.1', {
    requires: ['node', 'event', 'base', 'transition']
});
