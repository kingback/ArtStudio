/**
 * 相册展示页面
 */

YUI.add('gallery', function(Y) {
    
    var source = {
            id: "a9c1671343227b4e40a68c9d1e213189",
            desc: "虎牙",
            title: "虎牙",
            cover: {
                large: "feacf24bbac61ba840b3d8824dbd955a-70-81.gif",
                small: "feacf24bbac61ba840b3d8824dbd955a-70-81.gif"
            },
            image_num: 14,
            images: [
                {"like":200,"id":"1","small":"http://106.186.25.82/gridfs/b03a6770fe2aabeedf9312df70560642-584-820.png","large":"http://106.186.25.82/gridfs/b03a6770fe2aabeedf9312df70560642-584-820.png"},
                {"like":200,"id":"2","small":"http://106.186.25.82/gridfs/74931bdbd8774341b26d9c6c030fc41b-587-820.png","large":"http://106.186.25.82/gridfs/74931bdbd8774341b26d9c6c030fc41b-587-820.png"},
                {"like":200,"id":"3","small":"http://106.186.25.82/gridfs/5201733f84896ec608b40849b9cfcec5-591-820.png","large":"http://106.186.25.82/gridfs/5201733f84896ec608b40849b9cfcec5-591-820.png"},
                {"like":200,"id":"4","small":"http://106.186.25.82/gridfs/c5a24583f379caab3fc1a0ebd3a4bde8-583-820.png","large":"http://106.186.25.82/gridfs/c5a24583f379caab3fc1a0ebd3a4bde8-583-820.png"},
                {"like":200,"id":"5","small":"http://106.186.25.82/gridfs/444ae078389eaa444805fc082f562478-584-820.png","large":"http://106.186.25.82/gridfs/444ae078389eaa444805fc082f562478-584-820.png"},
                {"like":200,"id":"6","small":"http://106.186.25.82/gridfs/f9180fe7dcd24c6bf7e13a5ed562105a-583-820.png","large":"http://106.186.25.82/gridfs/f9180fe7dcd24c6bf7e13a5ed562105a-583-820.png"},
                {"like":200,"id":"7","small":"http://106.186.25.82/gridfs/90917713d3c8b21cbfc8f45e8cf77944-520-350.jpeg","large":"http://106.186.25.82/gridfs/90917713d3c8b21cbfc8f45e8cf77944-520-350.jpeg"},
                {"like":200,"id":"8","small":"http://106.186.25.82/gridfs/3a8e1bda303e345a58acb390792727f3-361-336.jpeg","large":"http://106.186.25.82/gridfs/3a8e1bda303e345a58acb390792727f3-361-336.jpeg"},
                {"like":200,"id":"9","small":"http://106.186.25.82/gridfs/37ceb25a917b31cefc18c2b861512ff9-320-276.gif","large":"http://106.186.25.82/gridfs/37ceb25a917b31cefc18c2b861512ff9-320-276.gif"},
                {"like":200,"id":"10","small":"http://106.186.25.82/gridfs/51e605f75ce09b91e521a46b882a43c2-400-400.jpeg","large":"http://106.186.25.82/gridfs/51e605f75ce09b91e521a46b882a43c2-400-400.jpeg"},
                {"like":200,"id":"11","small":"http://106.186.25.82/gridfs/b4de5e031c8e7d16473a39e6cc3c1553-378-317.jpeg","large":"http://106.186.25.82/gridfs/b4de5e031c8e7d16473a39e6cc3c1553-378-317.jpeg"},
                {"like":200,"id":"12","small":"http://106.186.25.82/gridfs/35b8743808ed19b07c849cea776ac3fd-311-308.jpeg","large":"http://106.186.25.82/gridfs/35b8743808ed19b07c849cea776ac3fd-311-308.jpeg"},
                {"like":200,"id":"13","small":"http://106.186.25.82/gridfs/d1a3153643643d1470ffeff18f672198-320-480.jpeg","large":"http://106.186.25.82/gridfs/d1a3153643643d1470ffeff18f672198-320-480.jpeg"},
                {"like":200,"id":"14","small":"http://106.186.25.82/gridfs/8e730b3a07cf9693dd4c4dde4a37ce1e-609-852.png","large":"http://106.186.25.82/gridfs/8e730b3a07cf9693dd4c4dde4a37ce1e-609-852.png"}
            ]
        };
    
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
            
            //TODO remove
            this.data['huya1'] = Y.merge(source, {id:'huya1',title:"虎牙1"});
            this.data['huya2'] = Y.merge(source, {id:'huya2',title:"虎牙2"});
            
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
                Y.io('http://106.186.25.82/mainapi/albuminfo', {
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
                data.images[index].small = 'http://106.186.25.82/gridfs/' + data.images[index].small;
                data.images[index].large = 'http://106.186.25.82/gridfs/' + data.images[index].large;
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
