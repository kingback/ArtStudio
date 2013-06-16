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
            },
            'g-mods': {
                comboBase: 'http://localhost/min/?b=github/ArtStudio/app/webroot/zd/global&f=',
                root: '',
                combine: true,
                modules: {
                    'zdglobal': {
                        use: ['g-floatbar']    
                    },
                    'g-floatbar': {
                        path: 'g-floatbar.js',
                        requires: ['anim']
                    }
                }
            }
        }
    };
    
    if (location.href.indexOf('zdebug=1')) {
        YUI.GlobalConfig.filter = 'RAW';
    }
    
    window['ZD'] = YUI();
    
})();
