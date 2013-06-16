
YUI.add('slideshow', function(Y) {

    var prevBtn = Y.one('.tab-btn-prev'),
        nextBtn = Y.one('.tab-btn-next'),
        slideShowNode = Y.one('#J_slide_show'),
        ligntBar = Y.one('.tab-nav-bar-light'),
        tabItems = Y.all('.tab-nav li'),
    
    // 初始化切换组件
    slide = new Y.Slide('J_slide_show', {
        effect: 'h-slide',
        autoSlide: true,
        hoverStop: true,
        carousel: true,
        timeout: 5000,
        speed: 0.5
    });
    
    // 显示前进后退按钮
    prevBtn.removeClass('hidden');
    nextBtn.removeClass('hidden');
    
    // 设置导航按钮高亮
    tabItems.item(0).addClass('lighted');
    
    // 绑定切换事件，动画展示导航按钮切换
    slide.on('switch', function(e) {
        ligntBar.setStyle('width', (e.index) * 62 + 'px');
        tabItems.each(function(item, index) {
            item.toggleClass('lighted', index <= e.index);
        });
    });
    
    // 鼠标经过焦点图高亮前进后退按钮
    slideShowNode.on('hover', function(e) {
        slideShowNode.addClass('slide-show-hover');
    }, function(e) {
        slideShowNode.removeClass('slide-show-hover');
    });
    
    // 绑定前进后退点击事件
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
