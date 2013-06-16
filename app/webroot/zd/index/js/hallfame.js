
YUI.add('hallfame', function(Y) {
    
    var hall = Y.one('.hall'),
        listCon = hall.one('.hall-list'),
        list = hall.one('ul'),
        items = list.all('li'),
        size = items.size(),
        cheight = listCon.get('offsetHeight'),
        height = list.get('offsetHeight'),
        top = 0,
        timer = 0;
    
    // 列表高度小于可展示高度
    if (height < cheight) {
        return;
    }
    
    // 复制一排列表
    items.each(function(item) {
        list.appendChild(item.cloneNode(true));
    });
    
    // 执行动画
    function runFrame() {
        if (++top > height) {
            top = top - height;
        }
        list.setStyle('top', -top + 'px');
    }
    
    // 开始动画
    function run() {
        if (!timer) {
            timer = setInterval(runFrame, 25);
        }
    }
    
    // 停止动画
    function stop() {
        if (timer) {
            clearInterval(timer);
            timer = 0;
        }
    }
    
    // 检查是否在视窗内
    // 只有在视窗内才开始滚动
    // 提高性能
    function check() {
        if (hall.inRegion(Y.DOM.viewportRegion(), false)) {
            run();
        } else {
            stop();
        }
    }
    
    // 添加滚动事件
    Y.on('scroll', Y.throttle(function() {
        check();
    }, 15), Y.config.win);
    
    // 初始化检查
    check();
    
    
}, '0.0.1', {
    requires: ['node', 'yui-throttle']
});
