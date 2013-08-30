/**
 * news
 */

YUI.add('news', function(Y) {
    
    var template = Y.Lang.trim(Y.one('#J_news_temp').get('innerHTML')),
        nomore = Y.one('.news-nomore'),
        page = 2,
        waterfall;
    
    function formatter(data) {
        return Y.Lang.sub(template, data) || '';
    }
    
    function getHeight(src) {
        var dot = src.lastIndexOf('.'),
            s = src.substring(0, dot),
            a = s.split('-'),
            l = a.length,
            w = Number(a[l - 2]),
            h = Number(a[l - 1]),
            r = Math.round(270 * h / w);
        
        return r;
    }
    
    function resize(data) {
        return Y.Array.map(data, function(news) {
            news.height = getHeight(news.image);
            return news;
        });
    }
    
    function loader(success, fail) {
        var self = this;
        Y.io('/mainapi/news', {
             method: 'GET',
             data: {
                 page: page++
             },
             on: {
                 complete: function(id, res) {
                     var r;
                     try {
                         r = Y.JSON.parse(res.responseText);
                     } catch (err) {}
                     if (r && r.length) {
                         success(resize(r));
                     } else {
                         fail(r);
                     }
                 },
                 failure: function() {
                     self.stop();
                 }
             }
        });
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
    
    waterfall.on('fail', function(e) {
        this.stop(); 
        nomore.setStyle('display', 'block');
    });
    
    waterfall.render();
    
}, '0.0.1', {
    requires: ['waterfall', 'waterfall-loader', 'io', 'json-parse']
});
