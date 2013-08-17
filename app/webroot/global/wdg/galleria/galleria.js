/**
 * 查看相册
 */

//TODO 相册无照片处理

YUI.add('galleria', function(Y) {
    
    var DEF_HEADER = '<div>' + 
                         '<div class="yui3-galleria-share"><a href="javascript:void(0);" target="_self">分享</a></div>' +
                         '<div class="yui3-galleria-amplify"><a href="#" title="查看原图">查看原图</a></div>' +
                         '<div class="yui3-galleria-close"><a href="javascript:void(0);" target="_self" title="关闭">关闭</a></div>' + 
                     '</div>',
                     
        DEF_BODY = '<div>' + 
                       '<div class="yui3-galleria-loading"></div>' +
                       '<div class="yui3-galleria-image"></div>' + 
                   '</div>',
        
        DEF_FOOTER = '<div>' + 
                         '<div class="yui3-galleria-prev"><a href="javascript:void(0);" target="_self">前一张</a></div>' + 
                         '<div class="yui3-galleria-thumb"><a href="javascript:void(0);" target="_self">所有图片</a></div>' + 
                         '<div class="yui3-galleria-next"><a href="javascript:void(0);" target="_self">后一张</a></div>' + 
                         '<div class="yui3-galleria-num">第<strong>0</strong>张（共<em>0</em>张）</div>' + 
                     '</div>',
                     
        DEF_NAV = '<div class="yui3-galleria-nav">' + 
                      '<div class="yui3-galleria-total"><span>所有照片（<strong>0</strong>）</span><a href="javascript:void(0);" target="_self">关闭</a></div>' + 
                      '<div class="yui3-galleria-all"><div class="yui3-galleria-scroller"><ul class="yui3-galleria-list"></ul></div></div>' + 
                  '</div>',
        DEF_MASK = '<div class="yui3-galleria-mask"></div>',
        
        DEF_THUMB = '<li data-large="{large}" data-index="{index}" data-id="{id}"><a href="javascript:void(0);" target="_self"><img src="{small}" title="{title}" /></a></li>',
        
        //TODO 周达头像              
        DEF_INFO = '<div>' + 
                        '<div class="yui3-galleria-infocon">' + 
                            '<h3><img src="/gridfs/921dc26e07ed2436a6cb001ed05323e2-180-180.jpeg" width="48" height="48" /><strong>周达点评</strong></h3>' + 
                            '<div class="yui3-galleria-review"></div>' + 
                            '<div class="yui3-galleria-like"><a href="javascript:void(0);" target="_self">喜欢</a><span><strong>113</strong><b></b></span></div>' + 
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
                        '</div>' + 
                    '</div>';
    
    var storage = (function() {
        return {
            _cache: {},
            getItem: function(name) {
                return this._cache[name] || '';
            },
            setItem: function(name, val) {
                this._cache[name] = val;
                return val;
            },
            removeItem: function(name) {
                delete this._cache[name];
            }
        };
    })();
    
    
    Y.Galleria = Y.Base.create('galleria', Y.Widget, [
        Y.WidgetStack
    ], {
        
        initializer: function() {
            Y.one('body').addClass('yui3-skin-sam');
            
            this._navHeight = 180;
            this._nextImage = null;
            
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
            
            cb.delegate('click', this.showNav, '.yui3-galleria-thumb a', this);
            cb.delegate('click', this.hideNav, '.yui3-galleria-total a', this);
            cb.delegate('click', this._onShareClick, '.yui3-galleria-share a', this);
            cb.delegate('click', this._onCloseClick, '.yui3-galleria-close a', this);
            cb.delegate('click', this._onItemClick, '.yui3-galleria-list li a', this);
            cb.delegate('click', this._onPrevClick, '.yui3-galleria-prev a', this);
            cb.delegate('click', this._onNextClick, '.yui3-galleria-next a', this);
            cb.delegate('click', this._onNextClick, '.yui3-galleria-image img', this);
            cb.delegate('click', this._onLikeBtnClick, '.yui3-galleria-like a', this);
            Y.on('resize', this._onWinResize, Y.config.win, this);
            
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
            this._imageCon = this._cb.one('.yui3-galleria-image');
            this._nextBtn = this._cb.one('.yui3-galleria-next');
            this._prevBtn = this._cb.one('.yui3-galleria-prev');
            this._review = this._cb.one('.yui3-galleria-review');
            this._like = this._cb.one('.yui3-galleria-like strong');
            this._likeBtn = this._cb.one('.yui3-galleria-like a');
            this._htmlEl = Y.one('html');
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
            Y.Get.js('http://v3.jiathis.com/code/jia.js?uid=1375524945718704');
        },
        
        _showAnim: function() {
            var self = this,
                duration = 0.2,
                easing = 'ease-out';
                
            self._infoNode.setStyle('right', '-25%');
            self._cb.setStyle('opacity', 0);
            self._bb.setStyles({
                top: '-100%',
                opacity: 0
            });
            
            self._bb.transition({
                top: 0,
                opacity: 1,
                duration: duration
            }, function() {
                self._cb.transition({
                    opacity: 1,
                    duration: duration
                });
                self._infoNode.transition({
                    right: 0,
                    duration: duration,
                    easing: easing
                });
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
            
            delete this._thumbItems;
            this.reset();
            list.empty();
            this._imageCon.empty();
            
            Y.Array.each(source.images, function(item, index) {
                size = this.getImageSize(item.small);
                node = Y.Node.create(Y.Lang.sub(DEF_THUMB, {
                    index: index + 1,
                    id: item.id || '',
                    small: item.small,
                    large: item.large,
                    title: item.title || ''
                }));
                node.setData('imageData', item);
                if (size[0] > size[1]) {
                    node.addClass('yui3-galleria-short');
                }
                list.append(node);
            }, this);
            
            this._thumbItems = list.all('li');
            
            current.setContent(source.images.length ? 1 : 0);
            num.setContent(source.images.length);
            total.setContent(source.images.length);
            
            this.scrollview.syncUI();
            this.showImage(this._thumbItems.item(0));
        },
        
        _getImageRealSize: function(src) {
            var size = this.getImageSize(src),
                width = this._imageCon.get('offsetWidth'),
                height = this._imageCon.get('offsetHeight'),
                wRatio = size[0]/width,
                hRatio = size[1]/height,
                ratio = Math.max(wRatio, hRatio);
            
            if (ratio > 1) {
                size[0] = Math.round(size[0] / ratio);
                size[1] = Math.round(size[1] / ratio);
            }
            
            return {
                width: size[0],
                height: size[1],
                ratio: ratio,
                cWidth: width,
                cHeight: height
            };
        },
        
        _posImage: function(img) {
            var size = this._getImageRealSize(img.src),
                top = 0;
                
            if (size.height < size.cHeight) {
                top = Math.round((size.cHeight - size.height) / 2);
            }
            
            img.style['marginTop'] = top + 'px';
        },
        
        _getItemById: function(id) {
            var items = this._thumbItems.getDOMNodes(),
                item = null;
            
            if (id) {
                Y.Array.some(items, function(node, index) {
                    if (node.getAttribute('data-id') === id) {
                        item = this._thumbItems.item(index);
                        return true;
                    }
                }, this);
            }
            
            return item;
        },
        
        _getNavHeight: function() {
            this._navHeight = Math.max(180, Math.round(this._bb.get('offsetHeight') / 3));
            return this._navHeight;
        },
        
        _updateImageSize: function() {
            var visible = this.get('visible'),
                img = this._imageCon.one('img');
                
            if (visible && img) {
                this._posImage(img._node);
            }
        },
        
        _updateNavSize: function() {
            var visible = this.get('visible'),
                height = this._getNavHeight(),
                h = this._navNode.get('offsetHeight');
            
            if (visible) {
                if (h) {
                    this._navNode.setStyle('height', height);
                }
                this.scrollview.set('height', height - 64);
                this.scrollview.syncUI();
            }
        },
        
        _initScrollView: function() {
            this.scrollview = new Y.ScrollView({
                srcNode: this._navNode.one('.yui3-galleria-scroller'),
                height: this._navHeight - 64,
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
        
        _onLikeBtnClick: function(e) {
            var btn = this._likeBtn,
                albumid = btn.getAttribute('data-albumid'),
                imageid = btn.getAttribute('data-imageid'),
                cache = storage.getItem(imageid),
                data = this.get('selectedItem').getData('imageData');
            
            if (cache) {
                alert('您已经点击过喜欢了，感谢您的支持~');
            } else {
                new Image().src = '/mainapi/likePic?albumId=' + albumid + '&imgId=' + imageid;
                this._like.setContent(++data.like);
                storage.setItem(imageid, true);
            }
        },
        
        _onItemClick: function(e) {
            this.showImage(e.currentTarget.ancestor('li'));
        },
        
        _onWinResize: function(e) {
            this._updateImageSize();
            this._updateNavSize();
        },
        
        _afterVisibleChange: function(e) {
            this._htmlEl.toggleClass('yui3-galleria-lock', e.newVal);  
            if (!e.newVal) {
                this.hideNav();
                this._updateJiaThis();
            } else {
                this._updateImageSize();
                this._updateNavSize();
                this._showAnim();
            }
        },
        
        _afterSelectedItemChange: function(e) {
            var prevItem = e.prevVal,
                item = e.newVal;
            
            if (item) {
                this.fire('select', {
                    prevItem: prevItem,
                    item: item,
                    data: item.getData('imageData'),
                    index: item.getAttribute('data-index'),
                    id: item.getAttribute('data-id'),
                    src: e.src
                });
            }
        },
        
        _defSelectFn: function(e) {
            this._set('selectedId', e.id);
            this._showImage(e);
            this._checkSibling(e);
            this._updateReview(e);
            this._updateLike(e);
            this._updateJiaThis(e);
        },
        
        _showImage: function(e) {
            var cb = this.get('contentBox'),
                imageCon = cb.one('.yui3-galleria-image'),
                current = cb.one('.yui3-galleria-num strong'),
                large = e.item.getAttribute('data-large'),
                img;
            
            if (e.src === 'next' && this._nextImage) {
                img = this._nextImage;
            } else {
                img = document.createElement('img');
                img.src = large;
            }
            
            imageCon.empty();
            imageCon.appendChild(img);
            
            this._posImage(img);
            
            this._amplifyBtn.setAttribute('href', large);
            
            if (e.prevItem && e.prevItem._node) {
                e.prevItem.removeClass('yui3-galleria-selected');
            }
            e.item.addClass('yui3-galleria-selected');
            current.setContent(e.index);
            
            this.hideNav();
            
            this._preload();
        },
        
        _updateReview: function(e) {
            this._review.setContent('“' + (e && e.data && e.data.desc || '暂无点评') + "”");
        },
        
        _updateLike: function(e) {
            var source = this.get('source');
            this._like.setContent(e && e.data && e.data.like || 0);
            this._likeBtn.setAttribute('data-albumid', source && source.id || '');
            this._likeBtn.setAttribute('data-imageid', e && e.data && e.data.id || '');
        },
        
        _updateJiaThis: function(e) {
            window.jiathis_config = window.jiathis_config || {};
            window.jiathis_config.pic = e && e.item.getAttribute('data-large') || '';
        },
        
        _preload: function() {
            var item = this.get('selectedItem'),
                img = null,
                next;
            
            if (item && (next = item.next('li'))) {
                img = document.createElement('img');
                img.src = next.getAttribute('data-large');
            }
            
            this._nextImage = img;
        },
        
        reset: function() {
            this.set('selectedItem', null);
            this._set('selectedId', '');
        },
        
        prevImage: function() {
            var current = Y.one('.yui3-galleria-selected'),
                prev = current.previous('li');
            
            if (prev) {
                this.showImage(prev, 'prev');
            }
        },
        
        nextImage: function() {
            var current = Y.one('.yui3-galleria-selected'),
                next = current.next('li');
            
            if (next) {
                this.showImage(next, 'next');
            }
        },
        
        getImageSize: function(src) {
            var dot = src.lastIndexOf('.'),
                s = src.substring(0, dot),
                a = s.split('-'),
                l = a.length;
            
            return [Number(a[l - 2]), Number(a[l - 1])];
        },
        
        showImage: function(item, dir) {
            if (Y.Lang.isNumber(item)) {
                item = this._thumbItems.item(item);
            } else if (Y.Lang.isString(item)) {
                item = this._getItemById(item);
            }
            
            if (!item) {
                item = this.get('selectedItem') || this._thumbItems.item(0);
            }
            
            this.set('selectedItem', item, {
                src: dir || 'select'
            });
        },
        
        showNav: function(e) {
            e && e.preventDefault();
            
            this._navNode.transition({
                opacity: 1,
                height: this._navHeight + 'px',
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
                duration: 0.25
            });
        },
        
        hideMask: function() {
            this._maskNode.transition({
                opacity: 0,
                duration: 0.25
            }, function() {
                this.setStyle('display', 'none');
            });
        }
        
    }, {
        ATTRS: {
            source: {},
            selectedItem: {},
            selectedId: {
                readOnly: true
            }
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
