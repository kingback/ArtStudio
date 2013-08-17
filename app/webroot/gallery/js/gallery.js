/**
 * 相册展示页面
 */

YUI.add('gallery', function(Y) {
    
    function getHash(name) {
        var hash = location.hash.substring(1),
            arr = hash.split('&'),
            obj = {},
            item;
        
        while (arr.length) {
            item = arr.shift().split('=');
            if (item[0]) {
                obj[item[0]] = item[1] || '';
            }
        }
        
        if (name) {
            return obj[name] || '';
        } else {
            return obj;
        }
    }
    
    function setHash(name, value) {
        var obj = getHash(),
            arr = [],
            hash = '',
            key, item;
        
        if (value || value === 0) {
            obj[name] = value;
        } else {
            //delete obj[name];
            obj[name] = '';
        }
        
        for (key in obj) {
            if (obj.hasOwnProperty(key)) {
                arr.push(key + '=' + obj[key]);
            }
        }
        
        hash += arr.join('&');
        location.hash = hash;
    }
    
    Y.Gallery = {
        
        init: function() {
            this.id = false;
            this.data = {};
            this.initLoading();
            this.initTip();
            this.bindAlbums();
            
            this.showSelected();
        },
        
        initGalleria: function(data) {
            this.galleria = new Y.Galleria({
                source: data,
                zIndex: 1000,
                visible: false,
                render: true
            });
            this.galleria.on('select', function(e) {
                setHash('imageid', e.id);
            });
            this.galleria.after('visibleChange', function(e) {
                if (!e.newVal) {
                    setHash('albumid', '');
                    setHash('imageid', '');
                }
            });
        },
        
        showSelected: function() {
            var hash = getHash(),
                album = hash['albumid'],
                image = hash['imageid'];
            
            Y.Array.some(Y.all('.album-item').getDOMNodes(), function(node) {
                if (node.getAttribute('data-albumid') === album) {
                    this.showAlbum(album, image);                    
                    return true;
                }
            }, this);
        },
        
        showGalleria: function(data, imageid) {
            var remain = false;
            
            this.loading.setStyle('display', 'none');
            
            if (Y.Lang.isString(data)) {
                data = this.data[data];
                remain = true;
            }
            
            if (data && data.images && data.images.length) {
                if (!remain) {
                    if (!this.galleria) {
                        this.initGalleria(data);
                    } else {
                        this.galleria.set('source', data);
                    }
                }
                if (this.galleria) {
                    this.galleria.show();
                    this.galleria.showImage(imageid);
                }
            } else {
                this.showTip('这个相册还没有图片哦~');
                setHash('albumid', '');
                setHash('imageid', '');
            }
        },
        
        showAlbum: function(id, imageid) {
            
            setHash('albumid', id);
            this.hideTip();
            
            if (this.id && id === this.id && this.data[id]) {
                this.showGalleria(id, imageid);
                return this;
            }
            
            this.loading.setStyle('display', 'block');
            this.id = id;
            
            this.getAlbumData(id, function(data) {
                data && (this.data[id] = data);
                if (this.id === id) {
                    this.showGalleria(data, imageid);
                }
            });
            
            return this;
        },
        
        getAlbumData: function(id, fn) {
            var self = this;
            if (this.data[id]) {
                fn && fn.call(this, this.data[id]);
            } else {
                Y.io('/mainapi/albuminfo', {
                    method: 'GET',
                    data: {
                        id: id
                    },
                    on: {
                        complete: function(id, r) {
                            var data;
                            try {
                                data = Y.JSON.parse(r.responseText);
                            } catch (err) {}
                            if (data) {
                                data = self.parseData(data);
                                fn && fn.call(self, data || null);
                            } else {
                                self.loading.setStyle('display', 'none');
                                self.showTip('抱歉，相册加载失败，请稍后再试~');
                                setHash('albumid', '');
                                setHash('imageid', '');
                            }
                        }
                    }
                });
            }
        },
        
        parseData: function(data) {
            Y.Array.each(data.images, function(item, index) {
                data.images[index].small = '/images/' + data.images[index].small;
                data.images[index].large = '/images/' + data.images[index].large;
            });
            
            return data;
        },
        
        bindAlbums: function() {
            var bd = Y.one('body');
            bd.delegate('click', this.onAlbumClick, '.album-cover a', this);
            bd.delegate('click', this.onAlbumClick, '.album-show a', this);
        },
        
        initLoading: function() {
            this.loading = Y.Node.create('<div class="album-loading">正在加载相册...</div>');
            Y.one('body').prepend(this.loading);
        },
        
        onAlbumClick: function(e) {
            e.halt();
            this.showAlbum(e.currentTarget.ancestor('li').getAttribute('data-albumid'));
        },
        
        initTip: function() {
            this.tip = Y.Node.create('<div class="album-tip"></div>');
            Y.one('body').prepend(this.tip);
        },
        
        showTip: function(text) {
            var self = this;
            
            clearTimeout(this.tipTimer);
            this.tip.setContent(text);
            
            this.tip.setStyles({
                'left': '50%',
                'top': '50%',
                'marginLeft': -this.tip.get('offsetWidth') / 2 + 'px',
                'visibility': 'visible'
            });
            
            this.tipTimer = setTimeout(function() {
                self.hideTip();
            }, 3000);
        },
        
        hideTip: function() {
            var self = this;
            
            clearTimeout(this.tipTimer);
            this.tip.setContent('');
            
            this.tip.setStyles({
                'left': '-200%',
                'top': '-200%',
                'visibility': 'hidden'
            });
        }
          
    };
    
    Y.Gallery.init();
    
}, '0.0.1', {
    requires: ['galleria', 'io', 'json-parse']
});
