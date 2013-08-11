/**
 * 教师介绍配置
 * @author ningzbruc@gmail.com
 * @date 2013-08-04
 */

;(function() {
    
    ZD.applyConfig({
        groups: {
            teacher: {
                base: YUI.getBase('teacher/js'),
                comboBase: YUI.getComboBase('teacher/js'),
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
