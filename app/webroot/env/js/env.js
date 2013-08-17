/**
 * 画室环境
 */

YUI.add('env', function(Y) {
    
    var data = {
        id: "0cac34140af4b24edbce8b5577885d22",
        desc: "虎牙mixtape",
        title: "虎了个牙的",
        cover: {
            large: "f5763c91587cac9714af387ad91f9be5-451-600.jpeg",
            small: "499fc1e380234f9d56cf252ebf3e67f3-226-300.jpeg"
        },
        image_num: 8,
        images: [{
            large: "78a7223a53a1fda9b73556253c43052e-720-1018.jpeg",
            small: "ca8862e4f62c7fbde1c8a9b074fdf2d6-212-300.jpeg",
            name: "13Anniversary",
            desc: "13纪念日",
            id: "dfd225384b81a8b2c3a28f9cce109313"
        }, {
            large: "f5763c91587cac9714af387ad91f9be5-451-600.jpeg",
            small: "499fc1e380234f9d56cf252ebf3e67f3-226-300.jpeg",
            name: "anne.jpg",
            desc: "安妮.海瑟薇",
            id: "b7465b5838effea638667293f9fb07ca"
        }, {
            large: "0e067594c3be03841c1dfbbc72c0e6e6-1920-1200.jpeg",
            small: "1decfc54a492c2a7476978e9e75a7e9b-300-188.jpeg",
            name: "Illidan.Stormrage.full.172224.jpg",
            desc: "伊利丹",
            id: "5ed7c4476251baa12fdc9483e87caecb"
        }, {
            large: "cfad36afb232367f1fccb4b073f675ad-1044-772.jpeg",
            small: "d9888e6db5e663dbae6af5135d237a59-300-222.jpeg",
            name: "The Dark Knight Rises.jpeg",
            desc: "The Dark Knight Rises",
            id: "99fb96fe4955d1f3c50b835e258c07c4"
        }, {
            large: "06da024d60d95823fea9c85c693ab41f-1000-1481.jpeg",
            small: "18f1b463e9edeb08889e006f35dc3d6b-203-300.jpeg",
            name: "The_Hobbit__An_Unexpected_Journey_18.jpeg",
            desc: "甘道夫",
            id: "0196a38f789694828b26189035f2db77"
        }, {
            large: "937f2dc3d45f654a7e7283aac1fbe81d-1024-1024.jpeg",
            small: "d7419a8bf13d34231c4d94be0b311d0a-300-300.jpeg",
            name: "老鸦.jpg",
            desc: "老鸦.jpg",
            id: "4c008a04009ddcacdcedba299d3a5037"
        }, {
            large: "7b14dc10092f12cad2355c78dad53412-1000-480.png",
            small: "abce24f06b9e36d93d542f5fd2ff16eb-300-144.jpeg",
            name: "YUI3",
            desc: "KISSY虐我千百倍，我待YUI如初恋！",
            id: "b1a8859484702187ac6ffa8401f2cadb"
        }, {
            large: "c7afe6e37f4abf63926b5493a026af72-300-274.jpeg",
            small: "c7afe6e37f4abf63926b5493a026af72-300-274.jpeg",
            name: "ie6-dead-300x274.",
            desc: "Dead IE6",
            id: "115f2007f03dfc51997b1e591059907d"
        }]
    };   
    
    var debug = location.href.indexOf('zd.com') > -1;
    
    var Env = {
        
        init: function() {
            this._data = {};
            this._id = '';
            this._list = Y.one('.env-list');
            this.bind();
            if (debug) {
                this._data['0cac34140af4b24edbce8b5577885d22'] = this.parseData(data);
            }
        },
        
        bind: function() {
            this._list.delegate('click', this._onAlbumClick, '.env-image', this);
        },
        
        initSlideShow: function() {
            this.slideShow = new Y.SlideShow({
                width: 680,
                height: 440,
                modal: true,
                visible: false,
                //centered: true,
                zIndex: 3000,
                render: true
            });
            
            this.bindSlideShow();
        },
        
        bindSlideShow: function() {
            this.slideShow.after('visibleChange', this._afterSlideShowVisibleChange);
        },
        
        show: function(data) {
            if (!this.slideShow) {
                this.initSlideShow();
            }
            if (data) {
                this.slideShow.set('data', data);
            }
            this.slideShow.show();
        },
        
        get: function(id, fn) {
            var self = this;
            
            this._id = id;
            
            if (this._data[id]) {
                fn.call(this, this._data[id]);
            } else {
                self.showTip('正在加载图集...');
                Y.io('/mainapi/albuminfo', {
                    method: 'GET',
                    data: {
                        id: id
                    },
                    on: {
                        complete: function(iid, r) {
                            var data;
                            
                            try {
                                data = Y.JSON.parse(r.responseText);
                            } catch (err) {}
                            
                            if (data) {
                                data = self.parseData(data);
                                self._data[id] = data;
                                self.hideTip();
                                if (self._id === id) {
                                    fn.call(self, data);   
                                }
                            } else {
                                self.showTip('抱歉，图集加载失败，请稍后再试~', true);
                            }
                        }
                    }
                });
            }
        },
        
        parseData: function(data) {
            if (data.images.length > 14) {
                data.images.length = 14;
            }
            Y.Array.each(data.images, function(image) {
                image.small = '/images/' + image.small; 
                image.large = '/images/' + image.large; 
            });
            return data;
        },
        
        showAlbum: function(id) {
            if (id !== this._id) {
                this.get(id, function(data) {
                    this.show(data);
                });
            } else {
                this.show();
            }
        },
        
        showTip: function(text, autohide) {
            var self = this;
            
            if (!this.tip) {
                this.tip = Y.Node.create('<div class="album-tip"></div>');
                Y.one('body').prepend(this.tip);
            }
            
            clearTimeout(this.timer);
            
            this.tip.setContent(text);
            this.tip.setStyles({
                visibility: 'visible',
                left: '50%',
                top: '50%'
            });
            
            if (autohide) {
                this.timer = setTimeout(function() {
                    self.hideTip();
                }, 3000);
            }
        },
        
        hideTip: function() {
            clearTimeout(this.timer);
            this.tip.setStyles({
                visibility: 'hidden',
                left: '200%',
                top: '200%'
            });
        },
        
        _onAlbumClick: function(e) {
            var id = e.currentTarget.ancestor().getAttribute('data-albumid');
            this.showAlbum(id);
        },
        
        _afterSlideShowVisibleChange: function(e) {
            var self = this,
                bb = this.get('boundingBox');

            if (e.newVal) {
                bb.setStyle('left', '-680px');
                bb.transition({
                    left: '114px',
                    duration: 0.2,
                    easing: 'ease-out'
                });
            } else {
                bb.removeClass('yui3-slideshow-hidden');
                bb.setStyle('left', '114px');
                bb.transition({
                    left: '-680px',
                    duration: 0.2,
                    easing: 'ease-out'
                }, function() {
                    bb.addClass('yui3-slideshow-hidden');
                });
            }
        }
          
    };
    
    Env.init();
    
}, '0.0.1', {
    requires: ['slideshow', 'io', 'json-parse', 'transition']
});
