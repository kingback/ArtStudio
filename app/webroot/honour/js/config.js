/**
 * 光荣榜配置
 * @author ningzbruc@gmail.com
 * @date 2013-06-30
 */

;(function() {
    
    ZD.applyConfig({
        groups: {
            index: {
                base: YUI.getBase('honour/js'),
                comboBase: YUI.getComboBase('honour/js'),
                root: '',
                combine: YUI.combine,
                modules: {
                    'main': {
                        use: ['honour']  
                    },
                    'honour': {
                        path: YUI.getPath('honour'),
                        requires: ['scrollview']
                    }
                }
            }
        }    
    });
    
})();
