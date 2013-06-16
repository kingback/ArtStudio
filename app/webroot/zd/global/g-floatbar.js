
YUI.add('g-floatbar', function(Y) {
    
    // yui3 anim-scroll 模块有 bug
    var NUM = Number;
    
    Y.Anim.behaviors.winScrollTo = {
        set: function(anim, att, from, to, elapsed, duration, fn) {
            var val = ([
                    fn(elapsed, NUM(from[0]), NUM(to[0]) - NUM(from[0]), duration),
                    fn(elapsed, NUM(from[1]), NUM(to[1]) - NUM(from[1]), duration)
                ]);
            
            window.scrollTo(val[0], val[1]);
        },
        get: function(anim) {
            var node = anim._node;
            return [node.get('scrollLeft'), node.get('scrollTop')];
        }
    };
    
    Y.on('contentready', function(evt) {
        Y.one('.g-floatbar-back').on('click', function(e) {
            e.halt(true);
            var anim = new Y.Anim({
                node: Y.one(Y.config.doc.body),
                to: {
                    winScrollTo: [0, 0]
                },
                duration: 0.3,
                easing: Y.Easing.easeInStrong
            });
            anim.on('end', function() {
                anim.destroy();
                anim = null;    
            });
            anim.run();
        });
    }, '.g-floatbar');
    
}, '0.0.1', {
    requires: ['anim']
});
