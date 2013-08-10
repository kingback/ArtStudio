/**
 * 周达其人
 */

YUI.add('intro', function(Y) {
    
    var Intro = {
        
        init: function() {
            this.body = Y.one('body');
            this.aside = Y.one('.intro-aside');
            this.initScroll();
            this.checkScroll();
            this.initNavSlide();
        },
        
        initScroll: function() {
            var self = this;
            Y.on('scroll', Y.throttle(function() {
                self.checkScroll();
            }, 15), Y.config.win, this);
        },
        
        checkScroll: function() {
            var fixed = this.body.get('scrollTop') >= 160;
            this.aside.setStyles({
                position: fixed ? 'fixed' : 'relative',
                'float': fixed ? 'none' : 'left' 
            });
        },
        
        initNavSlide: function() {
            var slide = new Y.SimpleSlide.Slide({
                panels: '.intro-slide-panel',
                width: 390,
                height: 630,
                prevBtn: '.intro-slide-prev',
                nextBtn: '.intro-slide-next',
                panelSelectedClass: 'intro-slide-show'
            });
            
            slide.after('slide', function(e) {
                this.prevBtn.toggleClass('intro-slide-disabled', e.index === 0);
                this.nextBtn.toggleClass('intro-slide-disabled', e.index === this.total - 1);
            });
            
            slide.render();
            slide.set('tabs', null);
            
            this.slide = slide;
        }
          
    };
    
    Intro.init();
    
}, '0.0.1', {
    requires: ['simpleslide', 'yui-throttle']
});
