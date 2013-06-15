;(function() {
    
    YUI.GlobalConfig = {
        comboBase: 'http://localhost/min/?b=github/ArtStudio/app/webroot/zd/yui/build&f=',
        root: '',
        combine: true,
        comboSep: ',',
        groups: {
            'g-widgets': {
                comboBase: 'http://localhost/min/?b=github/ArtStudio/app/webroot/zd/global/widgets&f=',
                root: '',
                combine: true,
                modules: {
                    'slide': {
                        path: 'slide/slide.js',
                        requires: ['node', 'anim']
                    }
                }
            }
        }
    };
    
    window['ZD'] = YUI();
    
})();
