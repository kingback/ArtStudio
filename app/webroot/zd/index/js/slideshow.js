
YUI.add('slideshow', function(Y) {
    
    var prevBtn = Y.one('.tab-btn-prev'),
        nextBtn = Y.one('.tab-btn-next'),
        slideShowNode = Y.one('#J_slide_show'),
    
    slide = new Y.Slide('J_slide_show', {
        effect: 'h-slide',
        autoSlide: true,
        hoverStop: true,
        carousel: true,
        timeout: 5000,
        speed: 0.5
    });
    
    prevBtn.removeClass('hidden');
    nextBtn.removeClass('hidden');
    
    slideShowNode.on('hover', function(e) {
        slideShowNode.addClass('show-btn');
    }, function(e) {
        slideShowNode.removeClass('show-btn');
    });
    
    prevBtn.on('click', function(e) {
        e.halt();
        slide.previous();    
    });
    nextBtn.on('click', function(e) {
        e.halt();
        slide.next();    
    });
    
}, '0.0.1', {
    requires: ['slide', 'event-delegate', 'event-hover']
});
