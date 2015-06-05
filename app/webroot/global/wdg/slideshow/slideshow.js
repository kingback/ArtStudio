/**
 * 幻灯片
 */

YUI.add('slideshow', function(Y) {
    
    var SHOW_TEMP = '<li data-id="{id}" data-index="{index}"><p><img src="{src}" title="{alt}" alt="{alt}" /></p></li>',
        NAV_TEMP = '<li data-id="{id}" data-index="{index}"><span><img src="{src}" title="{alt}" alt="{alt}" /></span></li>',
        INFO_TEMP = '<h3>{title}</h3><p></p>';
    
    Y.SlideShow = Y.Base.create('slideshow', Y.Widget, [
        Y.WidgetPosition,
        Y.WidgetPositionAlign,
        Y.WidgetModality,
        Y.WidgetStack
    ], {
        
        initializer: function() {
            this._data = this.get('data');
            this.publish('select', {
                defaultFn: this._defSelectFn
            });
        },
        
        destructor: function() {
            
        },
        
        renderUI: function() {
            this._domCache();
            this._renderWin();
            this._renderNav();
            this._renderInfo();
            this._renderBtns();
            this._renderClose();
        },
        
        bindUI: function() {
            this.after('dataChange', this._afterDataChange);
            this.after('selectedItemChange', this._afterSelectedItemChange);
            this._cb.delegate('click', this._onItemClick, '.yui3-slideshow-nav li', this);
            this._prev.on('click', this.prev, this);
            this._next.on('click', this.next, this);
            this._close.on('click', this.hide, this);
        },
        
        syncUI: function() {
            this.select(this.get('selected'), false);
        },
        
        select: function(item, anim) {
            if (Y.Lang.isString(item)) {
                item = this._getItemById(item);
            } else if (Y.Lang.isNumber(item)) {
                item = this._getItemByIndex(item);
            }
            
            if (!item) {
                item = this._nav.one('li');
            }
            
            this.set('selectedItem', item, {
                anim: anim === false ? false : true
            });
        },
        
        prev: function(e) {
            var items = this._nav.all('li'),
                size = items.size(),
                selectedItem = this.get('selectedItem'),
                prevItem = selectedItem && selectedItem.previous('li') || items.item(size - 1);
            
            e && e.preventDefault();
            
            if (prevItem && size > 1) {
                this.select(prevItem);
            }
        },
        
        next: function(e) {
            var items = this._nav.all('li'),
                size = items.size(),
                selectedItem = this.get('selectedItem'),
                nextItem = selectedItem && selectedItem.next('li') || items.item(0);
            
            e && e.preventDefault();
            
            if (nextItem && size > 1) {
                this.select(nextItem);
            }
        },
        
        _domCache: function() {
            this._bb = this.get('boundingBox');
            this._cb = this.get('contentBox');
        },
        
        _createElem: function(tag, cls) {
            var elem = document.createElement(tag),
                node = Y.one(elem);
            
            node.addClass(this.getClassName(cls));
            
            return node;
        },
        
        _renderWin: function() {
            var html = '';
            
            if (!this._win) {
                this._win = this._createElem('ul', 'win');
                this._cb.append(this._win);
            } else {
                this._win.empty(true);
            }
            
            if (!this._data) { return; }
            
            Y.Array.each(this._data.images, function(image, index) {
                html += Y.Lang.sub(SHOW_TEMP, {
                    src: image.large,
                    alt: image.desc,
                    id: image.id,
                    index: index
                });
            }, this);
            
            this._win.append(html);
        },
        
        _renderNav: function() {
            var html = '';
            
            if (!this._nav) {
                this._nav = this._createElem('ul', 'nav');
                this._nav.addClass('clearfix');
                this._cb.append(this._nav);
            } else {
                this._nav.empty(true);
            }
            
            if (!this._data) { return; }
            
            Y.Array.each(this._data.images, function(image, index) {
                html += Y.Lang.sub(NAV_TEMP, {
                    src: image.small,
                    alt: image.desc,
                    id: image.id,
                    index: index
                });
            }, this);
            
            this._nav.append(html);
        },
        
        _renderInfo: function() {
            if (!this._info) {
                this._info = this._createElem('div', 'info');
                this._info.addClass('clearfix');
                this._cb.append(this._info);
            } else {
                this._info.setContent('');
            }
            
            if (!this._data) { return; }
            
            this._info.append(Y.Lang.sub(INFO_TEMP, {
                title: this._data.title
            }));
        },
        
        _renderBtns: function() {
            this._prev = this._createElem('a', 'prev');
            this._prev.setAttribute('href', '#');
            this._next = this._createElem('a', 'next');
            this._next.setAttribute('href', '#');
            this._cb.append(this._prev);
            this._cb.append(this._next);
        },
        
        _renderClose: function() {
            this._close = this._createElem('span', 'close');
            this._close.setContent('×');
            this._cb.append(this._close);
        },
        
        _getItemById: function(id) {
            var node = null;
            
            this._nav.all('li').some(function(item) {
                if (item.getAttribute('data-id') === id) {
                    node = item;
                    return true;
                }
            });
            
            return node;
        },
        
        _getItemByIndex: function(index) {
            return this._nav.all('li').item(index);  
        },
        
        _getWinByItem: function(item) {
            return item ? this._win.all('li').item(Number(item.getAttribute('data-index'))) : null;
        },
        
        _getDataByItem: function(item) {
            return item ? this._data.images[Number(item.getAttribute('data-index'))] : null;
        },
        
        _onItemClick: function(e) {
            this.select(e.currentTarget, true);
        },
        
        _afterDataChange: function(e) {
            this._data = e.newVal;
            
            this.set('selected', '');
            this.set('selectedItem', null, {
                reset: true
            });
            
            this._renderWin();
            this._renderNav();
            this._renderInfo();
            this.syncUI();
        },
        
        _afterSelectedItemChange: function(e) {
            if (!e.reset) {
                this.fire('select', {
                    prevData: this._getDataByItem(e.preVal),
                    prevWin: this._getWinByItem(e.prevVal),
                    prevItem: e.prevVal,
                    data: this._getDataByItem(e.newVal),
                    win: this._getWinByItem(e.newVal),
                    item: e.newVal,
                    anim: e.anim
                });
            }
        },
        
        _defSelectFn: function(e) {
            if (e.prevItem) {
                e.prevItem.removeClass('yui3-slideshow-selected');
            }
            
            if (e.item) {
                e.item.addClass('yui3-slideshow-selected');
            }
            
            if (e.prevWin) {
                e.prevWin.removeClass('yui3-slideshow-show');
                if (e.anim) {
                    e.prevWin.transition({
                        opacity: 0,
                        duration: 0.25
                    });
                } else {
                    e.prevWin.setStyle('opacity', 0);
                }
            }
            
            if (e.win) {
                e.win.addClass('yui3-slideshow-show');
                if (e.anim) {
                    e.win.transition({
                        opacity: 1,
                        duration: 0.25
                    });
                } else {
                    e.win.setStyle('opacity', 1);
                }
            }
            
            if (e.data) {
                //this._info.one('p').setContent(e.data.desc);
            }
        }
        
    }, {
        
        ATTRS: {
            
            data: {
                value: null,
                validator: function(v) {
                    return !!v;
                }
            },
            
            selectedItem: {
                value: null
            },
            
            selected: {
                value: ''
            }
            
        }
        
    });
    
}, '0.0.1', {
    requires: ['slideshow-skin', 'base', 'widget', 'widget-stack', 'widget-position', 'widget-position-align', 'widget-modality', 'transition']
});