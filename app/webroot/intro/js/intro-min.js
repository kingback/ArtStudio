/* ZD */
YUI.add("intro",function(a){var b={init:function(){this.body=a.one("body"),this.aside=a.one(".intro-aside"),this.initScroll(),this.checkScroll(),this.initNavSlide()},initScroll:function(){var b=this;a.on("scroll",a.throttle(function(){b.checkScroll()},15),a.config.win,this)},checkScroll:function(){var a=this.body.get("scrollTop")>=160;this.aside.setStyles({position:a?"fixed":"relative","float":a?"none":"left"})},initNavSlide:function(){var b=new a.SimpleSlide.Slide({panels:".intro-slide-panel",width:390,height:630,prevBtn:".intro-slide-prev",nextBtn:".intro-slide-next",panelSelectedClass:"intro-slide-show"});b.after("slide",function(a){this.prevBtn.toggleClass("intro-slide-disabled",0===a.index),this.nextBtn.toggleClass("intro-slide-disabled",a.index===this.total-1)}),b.render(),this.slide=b}};b.init()},"0.0.1",{requires:["simpleslide","yui-throttle"]});