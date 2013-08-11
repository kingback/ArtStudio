/**
 * 画室环境配置
 * @author ningzbruc@gmail.com
 * @date 2013-08-09
 */

;(function() {
    
    ZD.applyConfig({
        groups: {
            env: {
                base: YUI.getBase('env/js'),
                comboBase: YUI.getComboBase('env/js'),
                root: '',
                combine: YUI.combine,
                modules: {
                    'main': {
                        use: ['env'] 
                    },
                    'env': {
                        path: YUI.getPath('env'),
                        requires: ['slideshow', 'io']
                    }
                }
            }
        }    
    });
    
})();
