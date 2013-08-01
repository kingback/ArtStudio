/**
 * 遮罩扩展
 * Y.WidgetMask
 * @module widget-mask
 * @author ningzbruc@gmail.com
 * @date 2013-07-19
 * @version 0.0.1
 */

YUI.add('widget-mask', function(Y) {
    
    var IE6 = Y.UA.ie === 6;
    
    function Mask() {}
    
    Mask.DEF_STYLES = {
        position: 'fixed',
        backgroundColor: '#000',
        opacity: 0.75,
        left: '-9999px',
        top: '-9999px',
        width: '100%',
        height: '100%',
        visibility: 'hidden'
    };
    
    Mask.ATTRS = {
        
        maskVisible: {
            value: false
        },
        
        maskStyles: {
            value: null
        },
        
        maskClass: {
            value: ''
        }       
    };
    
    Mask.CLASS = Y.ClassNameManager.getClassName('widget', 'mask');
    Mask.CLASS_HIDDEN = Y.ClassNameManager.getClassName('widget', 'mask', 'hidden');
    Mask.CLASS_SHIM = Y.ClassNameManager.getClassName('widget', 'mask', 'shim');
    
    Mask.prototype = {
        
        initializer: function() {
            Y.after(this.renderMask, this, 'render', this);
        },
        
        createMask: function() {
            var mask = Y.Node.create('<div />'),
                styles = this.get('maskStyles'),
                cls = this.get('maskClass');
                
            mask.setStyles(Y.merge(Mask.DEF_STYLES, styles));
            mask.addClass(cls);
            mask.addClass(Mask.CLASS);
            mask.addClass(Mask.CLASS_HIDDEN);
            
            return (this.mask = mask);
        },
        
        createShim: function() {
            var shim;
            if (IE6) {
                shim = Y.Node.create('<iframe class="' + Mask.CLASS_SHIM + '" frameborder="0" title="Widget Mask Shim" src="javascript:false" tabindex="-1" role="presentation"></iframe>');
                shim.setStyles({
                    display: 'none',
                    zIndex: this.mask.getStyle('zIndex') || 0
                });
            }
            return shim ? (this.shim = shim) : null;
        },
        
        renderMask: function() {
            var bb = this.get('boundingBox'),
                mask = this.createMask(),
                shim = this.createShim();
            
            bb.insert(mask);
            if (shim) {
                mask.insert(shim);
            }
            this.bindMask();
        },
        
        bindMask: function() {
            this.after('visibleChange', function(e) {
                if (e.newVal) {
                    this.showMask();
                } else {
                    this.hideMask();
                }
            });
            this.after('maskVisibleChange', function(e) {
                if (e.newVal) {
                    this._uiShowMask();
                } else {
                    this._uiHideMask();
                }
            });
        },
        
        showMask: function() {
            this.set('maskVisible', true);
            return this;
        },
        
        hideMask: function() {
            this.set('maskVisible', false);
            return this;
        },
        
        syncMask: function() {
            var docWidth = Y.DOM.docWidth() + 'px';
                docHeight = Y.DOM.docHeight() + 'px';
                
            this.mask.setStyles({
                width: docWidth,
                height: docHeight 
            });
            this.shim.setStyles({
                width: docWidth,
                height: docHeight
            });
            
            return this;
        },
        
        destructor: function() {
            this.mask.remove(true);
            delete this.mask;
        },
        
        _uiShowMask: function() {
            if (IE6) {
                this.syncMask();
                this.shim.setStyle('display', 'none');
            }
            this.setStyles({
                left: 0,
                top: 0,
                visible: 'visible' 
            });
            this.mask.removeClass(Mask.CLASS_HIDDEN);
        },
        
        _uiHideMask: function() {
            if (IE6) {
                this.shim.setStyle('display', 'block');
            }
            this.setStyles({
                left: '-9999px',
                top: '-9999px',
                visible: 'hidden' 
            });
            this.mask.addClass(Mask.CLASS_HIDDEN);
        }
        
    };
    
}, '0.0.1', {
    requires: ['widget-base']
});
