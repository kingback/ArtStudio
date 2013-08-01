/**
 * waterfall
 */

YUI.add('waterfall', function(Y) {
    
    function defFormatter(data) {
        return data && data.toString && data.toString() || '';
    }
    
    Y.Waterfall = Y.Base.create('waterfall', Y.Base, [], {
        
        initializer: function() {
            this._listTag = this.get('listTag');
            this._itemTag = this.get('itemTag');
            this._formatter = this.get('formatter') || Y.Waterfall.DEF_FORMATTER;
            this._delay = this.get('delay');
            
            this._queue = new Y.Queue();
            
            this.adding = false;
            
            this.publish('add', {
                defaultFn: this._defAddFn
            });
            this.publish('done');
        },
        
        render: function() {
            this._container = this.get('container');
            this._container.addClass(Y.Waterfall.CON_CLASS);
            
            this.initList();
            this.add(this.get('data'));
            
            return this;
        },
        
        initList: function() {
            var col = this.get('col'),
                end = col - 1,
                i = 0;
                
            this._lists = [];
            
            for (; i < col; i++) {
                this.addList(i === end);
            }
            
            this._shortList = this._lists[0];
        },
        
        addList: function(last) {
            var container = this._container,
                list = Y.one(document.createElement(this._listTag));
                
            list.addClass(Y.Waterfall.LIST_CLASS);
            last && list.addClass(Y.Waterfall.LIST_CLASS_LAST);
            
            container.append(list);
            
            this._lists.push(list);
            
            return list;
        },
        
        addItem: function(data) {
            var list = this.getShortList(),
                item = this.createItem(data);
            
            list.node.append(item);
            
            this.fire('add', {
                index: list.index,
                list: list.node,
                item: item
            });
            
            return item;
        },
        
        createItem: function(data) {
            var item = Y.one(document.createElement(this._itemTag)),
                temp = this._formatter(data);
                
            item.addClass(Y.Waterfall.ITEM_CLASS);
            item.append(temp);
            
            return item;
        },
        
        getShortList: function() {
            var lists = this._lists,
                l = lists.length,
                i = 0,
                index = 0,
                height = -1,
                oheight, list;
            
            for (; i < l; i++) {
                oheight = lists[i].get('offsetHeight');
                if (!i || oheight < height) {
                    height = oheight;
                    list = lists[i];
                    index = i;
                }
            }
            
            this._shortList = list;
            
            return {
                index: index,
                node: list  
            };
        },
        
        add: function(data) {
            if (!Y.Lang.isArray(data)) {
                data = [data];
            }
            
            this._queue.add.apply(this._queue, data);
            
            if (!this.adding) {
                this.next();
            }
        },
        
        next: function() {
            var self = this;
            
            if (this._queue.size()) {
                this.adding = true;
                setTimeout(function() {
                    self.addItem(self._queue.next());
                }, this._delay);
            } else {
                this.adding = false;
                this.fire('done');
            }
            
            return this;
        },
        
        _defAddFn: function() {
            this.next();
        }
        
    }, {
        
        ATTRS: {
            container: {
                setter: Y.one
            },
            
            formatter: {},
            
            col: {
                value: 3  
            },
            
            listTag: {
                value: 'ul'
            },
            
            itemTag: {
                value: 'li'
            },
            
            delay: {
                value: 1
            },
            
            data: {}
        },
        
        DEF_FORMATTER: defFormatter,
        
        CON_CLASS: 'waterfall',
        LIST_CLASS: 'waterfall-list',
        LIST_CLASS_LAST: 'waterfall-list-last',
        ITEM_CLASS: 'waterfall-item'
        
    });
    
}, '0.0.1', {
    requires: ['node', 'event', 'base']
});
