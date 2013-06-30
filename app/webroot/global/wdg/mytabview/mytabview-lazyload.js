
YUI.add('mytabview-lazyload', function(Y) {

    function MyTabViewLazyload() {
        MyTabViewLazyload.superclass.constructor.apply(this, arguments);
    }

    MyTabViewLazyload.NS = 'mtvlazyload';
    
    MyTabViewLazyload.NAME = 'pluginMyTabViewLazyload';
    
    MyTabViewLazyload.ATTRS = {
        lazySelector: {
            value: '.yui3-mytabview-lazyload'
        },
        removeAfterLoaded: {
            value: false
        }
    };
    
    Y.extend(MyTabViewLazyload, Y.Plugin.Base, {
        
        initializer: function() {
            
            this._host = this.get('host');
            this._srcNode = this._host.get('srcNode');
            this._lazySelector = this.get('lazySelector');
            
            this._host.publish('lazyload');
            
            this.beforeHostMethod('_switchSelection', this._beforeSwitchSelection);
            
        },
        
        destructor: function() {
        
        },
        
        _beforeSwitchSelection: function(e) {
            var panel = e.newPanel, 
                that = this;
                
            if (!panel.hasClass('yui3-mytabview-panel-loaded')) {
                var lazyNodes = panel.all(this._lazySelector);
                lazyNodes.each(function(item) {
                    that._loadLazyContent(item);
                });
                panel.addClass('yui3-mytabview-panel-loaded');
            }
            
            this._host.fire('lazyload', e);
        },
        
        //Copy From Lazyload, to format
        _loadLazyContent: function(item) {
            var content = item.get('tagName').toUpperCase() == 'TEXTAREA' ? item.get('value') : item.get('innerHTML'),
                html = content.replace(/&lt;/ig,'<').replace(/&gt;/ig,'>'),
                re_script = new RegExp(/<script([^>]*)>([^<]*(?:(?!<\/script>)<[^<]*)*)<\/script>/ig),
                tmpNode = Y.Node.create('<div>' + (html + '').replace(re_script, '') + '</div>'),
                loading = item.ancestor('.yui3-mytabview-loading');
            
            item.insert(tmpNode.get('children').toFrag(), 'before');
            
            item.setStyle('display', 'none');
            
            if (loading) {
                loading.removeClass('yui3-mytabview-loading');
            }
            
            if (this.get('removeAfterLoaded')) {
                item.remove(true);
            }

            var hd = Y.Node.getDOMNode(Y.one('head')),
                match, attrs, srcMatch, charsetMatch,
                t, s, text,
                RE_SCRIPT_SRC = /\ssrc=(['"])(.*?)\1/i,
                RE_SCRIPT_CHARSET = /\scharset=(['"])(.*?)\1/i;

            re_script.lastIndex = 0;

            while ((match = re_script.exec(html))) {
                attrs = match[1];
                srcMatch = attrs ? attrs.match(RE_SCRIPT_SRC) : false;
                // script via src
                if (srcMatch && srcMatch[2]) {
                    s = document.createElement('script');
                    s.src = srcMatch[2];
                    // set charset
                    if ((charsetMatch = attrs.match(RE_SCRIPT_CHARSET)) && charsetMatch[2]) {
                        s.charset = charsetMatch[2];
                    }
                    s.async = true; // make sure async in gecko ??????
                    hd.appendChild(s);
                }
                // inline script
                else if ((text = match[2]) && text.length > 0) {
                    this._globalExecScript(text);
                }
            }

            return true;           
        },

        _globalExecScript: function(data) {
            if (data && /\S/.test(data)) {
                var head = document.getElementsByTagName('head')[0] || docElem,
                    script = document.createElement('script');

                // It works! All browsers support!
                script.text = data;

                head.insertBefore(script, head.firstChild);
                head.removeChild(script);
            }
        }
    });
    
    Y.namespace('Plugin').MyTabViewLazyload = MyTabViewLazyload;

}, '1.0.0', {
    requires: ['plugin', 'mytabview']
});