/**
 * 报名配置
 * @author ningzbruc@gmail.com
 * @date 2013-06-30
 */

;(function() {
    
    ZD.applyConfig({
        groups: {
            signup: {
                base: YUI.getBase('signup/js'),
                comboBase: YUI.getComboBase('signup/js'),
                root: '',
                combine: YUI.combine,
                modules: {
                    'main': {
                        use: ['form']  
                    },
                    'form': {
                        path: YUI.getPath('form'),
                        requires: ['datecascade', 'validator', 'event-hover', 'querystring-parse']
                    }
                }
            }
        }    
    });
    
})();
