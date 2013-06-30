/**
 * 首页配置
 * @author ningzbruc@gmail.com
 * @date 2013-06-13
 */

;(function() {
    
    ZD.applyConfig({
        groups: {
            index: {
                base: YUI.getBase('signup/js'),
                comboBase: YUI.getComboBase('signup/js'),
                root: '',
                combine: YUI.combine,
                modules: {
                    'main': {
                        use: ['form']  
                    },
                    'form': {
                        path: 'form-min.js',
                        requires: ['datecascade', 'validator', 'event-hover']
                    }
                }
            }
        }    
    });
    
})();
