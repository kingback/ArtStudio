/**
 * waterfall-loader
 */

YUI.add('waterfall-loader', function(Y) {
    
    var win = Y.one(Y.config.win);
    
    function WaterfallLoader() {
        Y.after(this.start, this, 'render', this);
    }
    
    WaterfallLoader.ATTRS = {
        loader: {}
    };
    
    WaterfallLoader.prototype = {
        
        initializer: function() {
            this._loader = this.get('loader');
            
            this.loading = false;
            
            this.publish('success');
            this.publish('fail');
        },
        
        bindLoader: function() {
            var self = this;
            
            if (this._loader) {
                this._loaderHandler = Y.on(['scroll', 'resize'], Y.throttle(function() {
                    self.check();
                }, 50), Y.config.win);
            }
        },
        
        unbindLoader: function() {
            if (this._loaderHandler) {
                this._loaderHandler.detach();
                delete this._loaderHandler;
            }
        },
        
        load: function() {
            var loader = this._loader;
            
            if (loader) {
                loader.call(this, Y.bind(this.success, this), Y.bind(this.fail, this));
            }
        },
        
        stop: function() {
            this.unbindLoader();
        },
        
        start: function() {
            this.bindLoader();
            this.check();
        },
        
        check: function() {
            if (this.loading || this.adding) { return; }
            
            var list = this.getShortList().node,
                listRegion = list.get('region'),
                winRegion = win.get('region');
            
            if (listRegion.bottom <= winRegion.bottom) {
                this.load();
            }
        },
        
        success: function(data) {
            this.fire('success', {
                data: data
            });
            this.add(data);
            this.loading = false;
        },
        
        fail: function(msg) {
            this.fire('fail', {
                msg: msg
            });
            this.loading = false;
        }
    };
    
    Y.WaterfallLoader = WaterfallLoader;
    
    Y.Base.mix(Y.Waterfall, [Y.WaterfallLoader]);
    
}, '0.0.1', {
    requires: ['waterfall']
});
