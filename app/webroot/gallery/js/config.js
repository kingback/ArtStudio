/**
 * 相册配置
 * @author ningzbruc@gmail.com
 * @date 2013-08-02
 */

;(function() {
    
    ZD.applyConfig({
        groups: {
            gallery: {
                base: YUI.getBase('gallery/js'),
                comboBase: YUI.getComboBase('gallery/js'),
                root: '',
                combine: YUI.combine,
                modules: {
                    'main': {
                        use: ['gallery'] 
                    },
                    'gallery': {
                        path: YUI.getPath('gallery'),
                        requires: ['galleria', 'io', 'json-parse']
                    }
                }
            }
        }    
    });
    
})();
