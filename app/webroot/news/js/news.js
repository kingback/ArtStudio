/**
 * news
 */

YUI.add('news', function(Y) {
    
    var template = Y.Lang.trim(Y.one('#J_news_temp').get('innerHTML')),
        waterfall;
    
    function random() {
        return Math.ceil(Math.random() * 10) * 30;
    }
    
    function formatter(data) {
        data.height = random();
        return Y.Lang.sub(template, data) || '';
    }
    
    function loader(success) {
        setTimeout(function() {
            success(window.NewsData);
        }, 500);
    }
    
    waterfall = new Y.Waterfall({
        container: '.waterfall',
        data: window.NewsData,
        formatter: formatter,
        loader: loader
    });
    
    waterfall.on('add', function(e) {
        setTimeout(function() {
            e.item.addClass('waterfall-item-added');
        }, 50);
    });
    
    waterfall.render();
    
}, '0.0.1', {
    requires: ['waterfall', 'waterfall-loader']
});
