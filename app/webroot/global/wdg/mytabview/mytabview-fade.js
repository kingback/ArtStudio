
YUI.add('mytabview-fade', function(Y) {

    function MyTabViewFade() {
        MyTabViewFade.superclass.constructor.apply(this, arguments);
    }

    MyTabViewFade.NS = 'mtvfade';
    
    MyTabViewFade.NAME = 'pluginMyTabViewFade';
    
    MyTabViewFade.ATTRS = {
        fadeDuration: {
            value: 0.3
        },
        fadeQueue: {
            value: true
        }
    };
    
    Y.extend(MyTabViewFade, Y.Plugin.Base, {
        
        initializer: function() {
            
            this._host = this.get('host');
            this._srcNode = this._host.get('srcNode');
            
            this._host.publish('fadeout');
            this._host.publish('fadein');
            
            this._host._CLS_PANEL_FADEOUT = Y.ClassNameManager.getClassName('mytabview', 'panel', 'fadeout');
            this._host._CLS_PANEL_FADEIN = Y.ClassNameManager.getClassName('mytabview', 'panel', 'fadein');
            
            this.beforeHostMethod('_switchSelection', this._beforeSwitchSelection);
            
        },
        
        destructor: function() {
        
        },
        
        _beforeSwitchSelection: function(e) {
            if (e.prevPanel) {
                this._fadeOutPrevSelection(e);
            } else {
                this._fadeInNewSelection(e);
            }
        },
        
        _fadeOutPrevSelection: function(e) {
            var that = this;
            e.prevPanel.addClass(that._host._CLS_PANEL_FADEOUT);
            e.prevPanel.transition({
                easing: 'ease-in-out',
                duration: that.get('fadeDuration'),
                opacity: 0
            }, function() {
                e.prevPanel.removeClass(that._host._CLS_PANEL_FADEOUT);
                that._fadeInNewSelection(e);
            });
            this._host.fire('fadeout', e);
        },
        
        _fadeInNewSelection: function(e) {
            var that = this;
            e.newPanel.addClass(that._host._CLS_PANEL_FADEIN);
            e.newPanel.transition({
                easing: 'ease-in-out',
                duration: that.get('fadeDuration'),
                opacity: 1
            }, function() {
                e.newPanel.removeClass(that._host._CLS_PANEL_FADEIN);
            });
            this._host.fire('fadein', e);
        }
    });
    
    Y.namespace('Plugin').MyTabViewFade = MyTabViewFade;

}, '1.0.0', {
    requires: ['plugin', 'mytabview']
});