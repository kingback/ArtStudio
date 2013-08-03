/**
 * 相册展示页面
 */

YUI.add('gallery', function(Y) {
    
    var source = [
            {"small":"http://106.186.25.82/gridfs/b03a6770fe2aabeedf9312df70560642-584-820.png","large":"http://106.186.25.82/gridfs/b03a6770fe2aabeedf9312df70560642-584-820.png"},
            {"small":"http://106.186.25.82/gridfs/74931bdbd8774341b26d9c6c030fc41b-587-820.png","large":"http://106.186.25.82/gridfs/74931bdbd8774341b26d9c6c030fc41b-587-820.png"},
            {"small":"http://106.186.25.82/gridfs/5201733f84896ec608b40849b9cfcec5-591-820.png","large":"http://106.186.25.82/gridfs/5201733f84896ec608b40849b9cfcec5-591-820.png"},
            {"small":"http://106.186.25.82/gridfs/c5a24583f379caab3fc1a0ebd3a4bde8-583-820.png","large":"http://106.186.25.82/gridfs/c5a24583f379caab3fc1a0ebd3a4bde8-583-820.png"},
            {"small":"http://106.186.25.82/gridfs/444ae078389eaa444805fc082f562478-584-820.png","large":"http://106.186.25.82/gridfs/444ae078389eaa444805fc082f562478-584-820.png"},
            {"small":"http://106.186.25.82/gridfs/f9180fe7dcd24c6bf7e13a5ed562105a-583-820.png","large":"http://106.186.25.82/gridfs/f9180fe7dcd24c6bf7e13a5ed562105a-583-820.png"},
            {"small":"http://106.186.25.82/gridfs/90917713d3c8b21cbfc8f45e8cf77944-520-350.jpeg","large":"http://106.186.25.82/gridfs/90917713d3c8b21cbfc8f45e8cf77944-520-350.jpeg"},
            {"small":"http://106.186.25.82/gridfs/3a8e1bda303e345a58acb390792727f3-361-336.jpeg","large":"http://106.186.25.82/gridfs/3a8e1bda303e345a58acb390792727f3-361-336.jpeg"},
            {"small":"http://106.186.25.82/gridfs/37ceb25a917b31cefc18c2b861512ff9-320-276.gif","large":"http://106.186.25.82/gridfs/37ceb25a917b31cefc18c2b861512ff9-320-276.gif"},
            {"small":"http://106.186.25.82/gridfs/51e605f75ce09b91e521a46b882a43c2-400-400.jpeg","large":"http://106.186.25.82/gridfs/51e605f75ce09b91e521a46b882a43c2-400-400.jpeg"},
            {"small":"http://106.186.25.82/gridfs/b4de5e031c8e7d16473a39e6cc3c1553-378-317.jpeg","large":"http://106.186.25.82/gridfs/b4de5e031c8e7d16473a39e6cc3c1553-378-317.jpeg"},
            {"small":"http://106.186.25.82/gridfs/35b8743808ed19b07c849cea776ac3fd-311-308.jpeg","large":"http://106.186.25.82/gridfs/35b8743808ed19b07c849cea776ac3fd-311-308.jpeg"},
            {"small":"http://106.186.25.82/gridfs/d1a3153643643d1470ffeff18f672198-320-480.jpeg","large":"http://106.186.25.82/gridfs/d1a3153643643d1470ffeff18f672198-320-480.jpeg"},
            {"small":"http://106.186.25.82/gridfs/8e730b3a07cf9693dd4c4dde4a37ce1e-609-852.png","large":"http://106.186.25.82/gridfs/8e730b3a07cf9693dd4c4dde4a37ce1e-609-852.png"}
        ];
    
    Y.Gallery = {
        
        init: function() {
            this.id = false;
            this.data = {};
            this.bindAlbums();
            this.data['4'] = source;
            this.data['5'] = source;
        },
        
        initGalleria: function(data) {
            this.galleria = new Y.Galleria({
                source: data,
                zIndex: 1000,
                visible: false,
                render: true
            });
        },
        
        showGalleria: function(data) {
            if (data) {
                if (!this.galleria) {
                    this.initGalleria(data);
                } else {
                    this.galleria.set('source', data);
                }
            }
            this.galleria.show();
        },
        
        showAlbum: function(id) {
            
            if (this.id && id === this.id) {
                this.showGalleria();
                return this;
            }
            
            this.getAlbumData(id, function(data) {
                this.id = id;
                this.data[id] = data;
                this.showGalleria(data);
            });
            
            return this;
        },
        
        getAlbumData: function(id, fn) {
            var self = this;
            if (this.data[id]) {
                fn && fn.call(this, this.data[id]);
            } else {
                Y.io('http://106.186.25.82/mainapi/albuminfo?id=' + id, {
                    method: 'GET',
                    data: {
                        id: id
                    },
                    on: {
                        complete: function(id, r) {
                            var data;
                            try {
                                data = Y.JSON.parse(r.responseText);
                                data = self.parseData(data);
                            } catch (err) {}
                            if (data) {
                                fn && fn.call(self, data.images);
                            }
                        }
                    }
                });
            }
        },
        
        parseData: function(data) {
            Y.Array.each(data, function(item, index) {
                data[index].small = 'http://106.186.25.82/gridfs/' + data[index].small;
                data[index].large = 'http://106.186.25.82/gridfs/' + data[index].large;
            });
            
            return data;
        },
        
        bindAlbums: function() {
            Y.one('body').delegate('click', function(e) {
                this.showAlbum(e.currentTarget.ancestor().getAttribute('data-albumid'));
            }, '.album-cover', this);
        }
          
    };
    
    Y.Gallery.init();
    
}, '0.0.1', {
    requires: ['galleria', 'io', 'json-parse']
});
