/**
 * 周达其人配置
 * @author ningzbruc@gmail.com
 * @date 2013-08-10
 */

;(function() {
    
    ZD.applyConfig({
        groups: {
            index: {
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
                        requires: ['simpleslide', 'yui-throttle']
                    }
                }
            }
        }    
    });
    
})();
