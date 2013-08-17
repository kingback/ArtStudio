
YUI.add('honour', function(Y) {
    
    
    Y.Honour = {
        
        init: function() {
            this.addSkinClass();
            this.domCache();
            this.initTabView();
        },
        
        addSkinClass: function() {
            Y.one('body').addClass('yui3-skin-sam');
        },
        
        domCache: function() {
            this.year = Y.one('h2 strong');    
        },
        
        initTabView: function() {
            this.tabView = new Y.MyTabView({
                srcNode: '.honour-tabview',
                tabSelector: '.honour-tab',
                panelSelector: '.honour-panel',
                triggerEvent: 'click',
                plugins: [
                    {
                        fn: Y.Plugin.MyTabViewLazyload, 
                        cfg: {
                            removeAfterLoaded: true
                        }
                    },
                    {
                        fn: Y.Plugin.MyTabViewFade,
                        cfg: {
                            fadeDuration: 0.2
                        }
                    }
                ]
            });
            
            this.tabView.on('switch', function(e) {
                this.switchYear(e.newTab);
                //if (e.newPanel.scrollView) { return; }
                //this.initScrollView(e.newPanel);
            }, this);
            
            this.tabView.render();

            Y.one('.honour-tabview').addClass('honour-tabview-fade');
        },
        
        initScrollView: function(panel) {
            panel.scrollView = new Y.ScrollView({
                srcNode: panel.one('.honour-scroller'),
                height: 500,
                flick: {
                    minDistance:10,
                    minVelocity:0.3,
                    axis: 'y'
                }
            });
            panel.scrollView.render();
            panel.on('hover', function(e) {
                panel.scrollView.scrollbars.show(true);
            }, function(e) {
                panel.scrollView.scrollbars.hide(true);
            });
        },
        
        switchYear: function(tab) {
            this.year.setContent(tab.one('strong').getContent());
        }
            
    };
    
    Y.Honour.init();
    
}, '0.0.1', {
    requires: ['event-hover', 'scrollview', 'mytabview', 'mytabview-fade', 'mytabview-lazyload']
});
