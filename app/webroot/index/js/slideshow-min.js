/* ZD */
YUI.add("slideshow",function(a){var b,c=a.one(".tab-btn-prev"),d=a.one(".tab-btn-next"),e=a.one("#J_slide_show"),f=a.one(".tab-nav-bar-light"),g=a.all(".tab-nav li"),h=a.one(".tab-nav-con");e.all(".tab-pannel").size()<2||(b=new a.Slide("J_slide_show",{effect:"h-slide",autoSlide:!0,hoverStop:!0,carousel:!0,timeout:5e3,speed:.5}),c.removeClass("hidden"),d.removeClass("hidden"),h.removeClass("hidden"),g.item(0).addClass("lighted"),b.on("switch",function(a){f.setStyle("width",62*a.index+"px"),g.each(function(b,c){b.toggleClass("lighted",c<=a.index)})}),e.on("hover",function(){e.addClass("slide-show-hover")},function(){e.removeClass("slide-show-hover")}),c.on("click",function(a){a.halt(),b.previous()}),d.on("click",function(a){a.halt(),b.next()}))},"0.0.1",{requires:["slide","event-delegate","event-hover"]});