/**
 * news
 */

YUI.add('news', function(Y) {
    
    var template = Y.Lang.trim(Y.one('#J_news_temp').get('innerHTML')),
        page = 1,
        waterfall;
    
    function formatter(data) {
        return Y.Lang.sub(template, data) || '';
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
                         success(r);
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
    });
    
    waterfall.render();
    
}, '0.0.1', {
    requires: ['waterfall', 'waterfall-loader', 'io', 'json-parse']
});
