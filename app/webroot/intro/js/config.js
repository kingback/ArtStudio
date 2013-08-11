/**
 * 周达其人配置
 * @author ningzbruc@gmail.com
 * @date 2013-08-10
 */

;(function() {
    
    ZD.applyConfig({
        groups: {
            intro: {
                base: YUI.getBase('intro/js'),
                comboBase: YUI.getComboBase('intro/js'),
                root: '',
                combine: YUI.combine,
                modules: {
                    'main': {
                        use: ['intro'] 
                    },
                    'intro': {
                        path: YUI.getPath('intro'),
                        requires: ['simpleslide', 'yui-throttle', 'gallery']
                    }
                }
            },
            gallery: {
                base: YUI.getBase('gallery/js'),
                comboBase: YUI.getComboBase('gallery/js'),
                root: '',
                combine: YUI.combine,
                modules: {
                    'gallery': {
                        path: YUI.getPath('gallery'),
                        requires: ['galleria', 'io', 'json-parse']
                    }
                }
            }
        }    
    });
    
})();
