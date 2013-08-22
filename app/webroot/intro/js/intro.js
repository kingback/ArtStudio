/**
 * 周达其人
 */

YUI.add('intro', function(Y) {
    
    var Intro = {
        
        init: function() {
            this.body = Y.one('body');
            this.bd = Y.one('.g-bd');
            this.aside = Y.one('.intro-aside');
            this.initScroll();
            this.bindLinkScroll();
            this.checkScroll();
            this.initNavSlide();
            this.initGallery();
            this.initPrizeSlide();
        },
        
        updateCache: function() {
            this.fixedTop = this.aside.get('region').top;
            this.fixedBottom = this.bd.get('region').bottom - this.aside.get('offsetHeight');
        },
        
        initScroll: function() {
            var self = this;
            
            this.navLinks = Y.all('.intro-nav-link');
            this.updateCache();
                
            Y.on('scroll', Y.throttle(function() {
                self.checkScroll();
            }, 15), Y.config.win, this);
            
            Y.on('resize', Y.throttle(function() {
                self.updateCache();
                self.checkScroll();
            }, 15), Y.config.win, this);
            
        },
        
        bindLinkScroll: function() {
            this.navLinks.on('click', function(e) {
                e.preventDefault();
                this.scrollTo(e.target, true);
            }, this);
        },
        
        scrollTo: function(link, scroll) {
            this.navLinks.removeClass('selected');
            if (link) {
                link.addClass('selected');
                scroll && window.scrollTo(0, Y.one('#' + link.getAttribute('data-id')).getY());
            }
        },
        
        checkScroll: function() {
            this.checkLinkScroll();  
            this.checkNavScroll();  
        },
        
        checkLinkScroll: function() {
            var viewport = this.bd.get('viewportRegion'),
                node, to;
            
            this.navLinks.each(function(link) {
                node = Y.one('#' + link.getAttribute('data-id'));
                if (node.inRegion(viewport)) {
                    to = link;
                }
            }, this);
            
            this.scrollTo(to);
        },
        
        checkNavScroll: function() {
            var scrollTop = this.body.get('scrollTop'),
                scrollHeight = this.body.get('scrollHeight');
            
            if (scrollTop >= this.fixedBottom) {
                this.aside.setStyles({
                    position: 'absolute',
                    top: 'auto',
                    bottom: '0px',
                    'float': 'left'
                });
            } else if (scrollTop >= this.fixedTop) {
                this.aside.setStyles({
                    position: 'fixed',
                    top: '0px',
                    bottom: 'auto',
                    'float': 'none'
                });
            } else {
                this.aside.setStyles({
                    position: 'relative',
                    top: '0px',
                    bottom: 'auto',
                    'float': 'left'
                });
            }
        },
        
        initNavSlide: function() {
            
            if (Y.all('.intro-slide-panel') <= 1) { return; }
            
            var slide = new Y.SimpleSlide.Slide({
                panels: '.intro-slide-panel',
                width: 390,
                height: 630,
                prevBtn: '.intro-slide-prev',
                nextBtn: '.intro-slide-next',
                panelSelectedClass: 'intro-slide-show',
                transCfg: {
                    duration: 0.15
                }
            });
            
            slide.after('slide', function(e) {
                slide.prevBtn.toggleClass('intro-slide-disabled', e.index === 0);
                slide.nextBtn.toggleClass('intro-slide-disabled', e.index === this.total - 1);
            });
            
            slide.render();
            
            slide.prevBtn.removeClass('hidden');
            slide.nextBtn.removeClass('hidden');
            
            this.navSlide = slide;
        },
        
        initGallery: function() {
            Y.one('#J_intro_gallery').on('click', function(e) {
                e.preventDefault(); 
                Y.Gallery.showAlbum(e.target.getAttribute('data-albumid'));
            });
        },
        
        initPrizeSlide: function() {
            var slide = new Y.SimpleSlide({
                tabs: '.intro-prize-tabs li',
                panels: '.intro-prize-panel',
                width: 425,
                height: 470,
                event: 'hover',
                tabSelectedClass: 'intro-prize-selected',
                panelSelectedClass: 'intro-prize-show'
            });
            
            slide.render();
            
            slide.panels.each(function(panel) {
                this.initImageSlide(panel);
            }, this);
            
            this.prizeSlide = slide;
        },
        
        initImageSlide: function(panel) {
            var imgs = panel.all('li'),
                con, prevBtn, nextBtn;
            
            if (imgs.size() > 1) {
                prevBtn = Y.Node.create('<a href="#" class="intro-prize-prev"></a>');
                nextBtn = Y.Node.create('<a href="#" class="intro-prize-next"></a>');
                con = panel.one('.intro-prize-image');
                con.append(prevBtn);
                con.append(nextBtn);
                
                panel.slide = new Y.SimpleSlide.Slide({
                    panels: imgs._nodes,
                    width: 425,
                    height: 470,
                    prevBtn: prevBtn,
                    nextBtn: nextBtn,
                    transCfg: {
                        duration: 0.15
                    }
                });
                
                panel.slide.after('slide', function(e) {
                    this.prevBtn.toggleClass('intro-prize-disabled', e.index === 0);
                    this.nextBtn.toggleClass('intro-prize-disabled', e.index === this.total - 1);
                });
                
                panel.slide.render();
            }
        }
          
    };
    
    Intro.init();
    
}, '0.0.1', {
    requires: ['simpleslide', 'yui-throttle']
});
