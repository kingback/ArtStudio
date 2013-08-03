/**
 * 查看相册
 */

YUI.add('galleria', function(Y) {
    
    var DEF_HEADER = '<div>' + 
                         '<div class="yui3-galleria-share"><a href="javascript:void(0);">分享</a></div>' +
                         '<div class="yui3-galleria-amplify"><a href="#" title="查看原图">查看原图</a></div>' +
                         '<div class="yui3-galleria-close"><a href="javascript:void(0);" title="关闭">关闭</a></div>' + 
                     '</div>',
                     
        DEF_BODY = '<div>' + 
                       '<div class="yui3-galleria-image"></div>' + 
                   '</div>',
        
        DEF_FOOTER = '<div>' + 
                         '<div class="yui3-galleria-prev"><a href="javascript:void(0);">前一张</a></div>' + 
                         '<div class="yui3-galleria-thumb"><a href="javascript:void(0);">所有图片</a></div>' + 
                         '<div class="yui3-galleria-next"><a href="javascript:void(0);">后一张</a></div>' + 
                         '<div class="yui3-galleria-num">第<strong>1</strong>张（共<em>10</em>张）</div>' + 
                     '</div>',
                     
        DEF_NAV = '<div class="yui3-galleria-nav">' + 
                      '<div class="yui3-galleria-total"><span>所有照片（<strong>10</strong>）</span><a href="javascript:void(0);">关闭</a></div>' + 
                      '<div class="yui3-galleria-all"><div class="yui3-galleria-scroller"><ul class="yui3-galleria-list"></ul></div></div>' + 
                  '</div>',
        DEF_MASK = '<div class="yui3-galleria-mask"></div>',
        
        DEF_THUMB = '<li data-large="{large}" data-index="{index}"><a href="javascript:void(0);"><img src="{small}" title="{title}" /></a></li>',
                      
        DEF_INFO = '<div>' + 
                        '<h3><img src="http://106.186.25.82/gridfs/921dc26e07ed2436a6cb001ed05323e2-180-180.jpeg" width="48" height="48" /><strong>周达点评</strong></h3>' + 
                        '<div class="yui3-galleria-review">“青年女子素描胸像。整体块面黑白灰效果明显，头发表现得相当有体积轻松，五官重点塑造，头发表现得相是其突出自然。”</div>' + 
                        '<div class="yui3-galleria-like"><a href="javascript:void(0);">喜欢</a><span><strong>113</strong><b></b></span></div>' + 
                        '<div class="yui3-galleria-jiathis">' + 
                            '<span class="yui3-galleria-jiato">分享到：</span>' + 
                            '<div class="jiathis_style_24x24">' + 
                                '<a class="jiathis_button_qzone"></a>' + 
                                '<a class="jiathis_button_tsina"></a>' + 
                                '<a class="jiathis_button_tqq"></a>' + 
                                '<a class="jiathis_button_weixin"></a>' + 
                                '<a class="jiathis_button_renren"></a>' + 
                                '<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>' + 
                                '<a class="jiathis_counter_style"></a>' + 
                            '</div>' + 
                        '</div>' + 
                    '</div>';
    
    Y.Galleria = Y.Base.create('galleria', Y.Widget, [
        Y.WidgetStack
    ], {
        
        initializer: function() {
            Y.one('body').addClass('yui3-skin-sam');
            this.publish('select', {
                defaultFn: this._defSelectFn 
            });
        },
        
        renderUI: function() {
            this._renderUINode('hd');
            this._renderUINode('bd');
            this._renderUINode('ft');
            this._renderUINode('mask');
            this._renderUINode('nav');
            this._renderUINode('info');
            this._domCache();
            this._initScrollView();
            this._renderJiaThis();
        },
        
        bindUI: function() {
            var cb = this.get('contentBox');
            
            cb.delegate('click', this.showNav, '.yui3-galleria-thumb', this);
            cb.delegate('click', this.hideNav, '.yui3-galleria-total a', this);
            cb.delegate('click', this._onShareClick, '.yui3-galleria-share', this);
            cb.delegate('click', this._onCloseClick, '.yui3-galleria-close', this);
            cb.delegate('click', this._onItemClick, '.yui3-galleria-list li', this);
            cb.delegate('click', this._onPrevClick, '.yui3-galleria-prev', this);
            cb.delegate('click', this._onNextClick, '.yui3-galleria-next', this);
            
            this.after('sourceChange', this._updateThumbs, this);
            this.after('visibleChange', this._afterVisibleChange, this);
            this.after('selectedItemChange', this._afterSelectedItemChange, this);
        },
        
        syncUI: function() {
            this._updateThumbs();
        },
        
        _domCache: function(){
            this._bb = this.get('boundingBox');  
            this._cb = this.get('contentBox');
            this._amplifyBtn = this._cb.one('.yui3-galleria-amplify a');
            this._nextBtn = this._cb.one('.yui3-galleria-next');
            this._prevBtn = this._cb.one('.yui3-galleria-prev');
            this.htmlEl = Y.one('html');
        },
        
        _checkSibling: function() {
            var item = this.get('selectedItem');
            
            if (item) {
                this._nextBtn.toggleClass('yui3-galleria-disabled', !item.next('li'));
                this._prevBtn.toggleClass('yui3-galleria-disabled', !item.previous('li'));
            }
            
        },
        
        _renderUINode: function(name) {
            var cb = this.get('contentBox'),
                node = Y.Node.create(Y.Galleria['GALLERIA_' + name.toUpperCase()]);
            
            node.addClass(this.getClassName(name));
            
            cb.appendChild(node);
            this['_' + name + 'Node'] = node;
        },
        
        _renderJiaThis: function() {
            Y.Get.js('http://v3.jiathis.com/code/jia.js?uid=1375524945718704', function() {
                
            });
        },
        
        _updateThumbs: function() {
            var source = this.get('source'),
                cb = this.get('contentBox'),
                list = this._navNode.one('.yui3-galleria-list'),
                total = this._navNode.one('.yui3-galleria-total strong'),
                current = cb.one('.yui3-galleria-num strong'),
                num = cb.one('.yui3-galleria-num em'),
                items = [],
                node, size;
            
            list.empty();
            this.reset();
            
            Y.Array.each(source, function(item, index) {
                size = this.getImageSize(item.small);
                node = Y.Node.create(Y.Lang.sub(DEF_THUMB, {
                    index: index + 1,
                    small: item.small,
                    large: item.large,
                    title: item.title || ''
                }));
                if (size[0] > size[1]) {
                    node.addClass('yui3-galleria-short');
                }
                list.append(node);
            }, this);
            
            current.setContent(1);
            num.setContent(source.length);
            total.setContent(source.length);
            
            this.scrollview.syncUI();
            this.showImage(list.one('li'));
        },
        
        _initScrollView: function() {
            this.scrollview = new Y.ScrollView({
                srcNode: this._navNode.one('.yui3-galleria-scroller'),
                height: '116px',
                axis: 'y',
                flick: {
                    minDistance: 10,
                    minVelocity: 0.3,
                    axis: 'y'
                },
                render: true
            });
            
            this.scrollview.scrollbars.show(true);
        },
        
        _onShareClick: function(e) {
            var share = Y.one('.jiathis_button_tsina');
            if (share) {
                share.simulate('click');
            }
        },
        
        _onCloseClick: function(e) {
            this.hide();  
        },
        
        _onPrevClick: function(e) {
            this.prevImage();
        },
        
        _onNextClick: function(e) {
            this.nextImage();
        },
        
        _onItemClick: function(e) {
            this.showImage(e.currentTarget);
        },
        
        _afterVisibleChange: function(e) {
            this.htmlEl.toggleClass('yui3-galleria-lock', e.newVal);  
            if (!e.newVal) {
                this.hideNav();
            }
        },
        
        _afterSelectedItemChange: function(e) {
            var prevItem = e.prevVal,
                item = e.newVal;
            
            if (item) {
                this.fire('select', {
                    prevItem: prevItem,
                    item: item,
                    index: item.getAttribute('data-index')
                });
            }
        },
        
        _defSelectFn: function(e) {
            this._showImage(e);
            this._checkSibling(e);
            //this._updateReview();
            //this._updateLike();
            //this._updateHash();
            this._updateJiaThis(e);
        },
        
        _showImage: function(e) {
            var cb = this.get('contentBox'),
                imageCon = cb.one('.yui3-galleria-image'),
                current = cb.one('.yui3-galleria-num strong'),
                large = e.item.getAttribute('data-large'),
                img = new Image();
            
            img.src = large;
            imageCon.empty().appendChild(img);
            this._amplifyBtn.setAttribute('href', large);
            
            if (e.prevItem && e.prevItem._node) {
                e.prevItem.removeClass('yui3-galleria-selected');
            }
            e.item.addClass('yui3-galleria-selected');
            current.setContent(e.index);
            
            this.hideNav();
        },
        
        _updateJiaThis: function(e) {
            window.jiathis_config = window.jiathis_config || {};
            window.jiathis_config.pic = e.item.getAttribute('data-large');
        },
        
        reset: function() {
            this.set('selectedItem', null);
        },
        
        prevImage: function() {
            var current = Y.one('.yui3-galleria-selected'),
                prev = current.previous('li');
            
            if (prev) {
                this.showImage(prev);
            } else {
                
            }
        },
        
        nextImage: function() {
            var current = Y.one('.yui3-galleria-selected'),
                next = current.next('li');
            
            if (next) {
                this.showImage(next);
            } else {
                
            }
        },
        
        getImageSize: function(src) {
            var dot = src.lastIndexOf('.'),
                s = src.substring(0, dot),
                a = s.split('-'),
                l = a.length;
            
            return [a[l - 2], a[l - 1]];
        },
        
        showImage: function(item) {
            this.set('selectedItem', item);
        },
        
        showNav: function(e) {
            e && e.preventDefault();
            
            this._navNode.transition({
                opacity: 1,
                height: '180px',
                duration: 0.25
            });
            this.showMask();
            
            return this;
        },
        
        hideNav: function(e) {
            e && e.preventDefault();
            
            this._navNode.transition({
                opacity: 0,
                height: '0px',
                duration: 0.25
            });
            this.hideMask();
            
            return this;
        },
        
        showMask: function() {
            this._maskNode.setStyle('display', 'block');
            this._maskNode.transition({
                opacity: 0.75,
                height: '224px',
                duration: 0.25
            });
        },
        
        hideMask: function() {
            this._maskNode.transition({
                opacity: 0,
                height: '44px',
                duration: 0.25
            }, function() {
                this.setStyle('display', 'none');
            });
        }
        
    }, {
        ATTRS: {
            source: {},
            
            selectedItem: {}
        },
        
        GALLERIA_HD: DEF_HEADER,
        GALLERIA_BD: DEF_BODY,
        GALLERIA_FT: DEF_FOOTER,
        
        GALLERIA_NAV: DEF_NAV,
        GALLERIA_MASK: DEF_MASK,
        GALLERIA_INFO: DEF_INFO
    });
    
}, '0.0.1', {
    requires: ['galleria-skin', 'node-event-simulate', 'base', 'widget', 'widget-stdmod', 'widget-stack', 'scrollview']
});
