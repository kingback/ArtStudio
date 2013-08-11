/**
 * 画室新闻配置
 * @author ningzbruc@gmail.com
 * @date 2013-07-30
 */

;(function() {
    
    ZD.applyConfig({
        groups: {
            news: {
                base: YUI.getBase('news/js'),
                comboBase: YUI.getComboBase('news/js'),
                root: '',
                combine: YUI.combine,
                modules: {
                    'main': {
                        use: ['news'] 
                    },
                    'news': {
                        path: YUI.getPath('news'),
                        requires: ['waterfall', 'waterfall-loader', 'io', 'json-parse']
                    }
                }
            }
        }    
    });
    
})();
