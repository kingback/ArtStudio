/**
 * 视频列表配置
 * @author ningzbruc@gmail.com
 * @date 2013-07-01
 */

;(function() {
    
    ZD.applyConfig({
        groups: {
            index: {
                base: YUI.getBase('video/js'),
                comboBase: YUI.getComboBase('video/js'),
                root: '',
                combine: YUI.combine,
                modules: {
                    'main': {
                        use: []  
                    }
                }
            }
        }    
    });
    
})();
