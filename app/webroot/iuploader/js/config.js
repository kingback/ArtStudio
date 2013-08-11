/**
 * 图片上传配置
 * @author ningzbruc@gmail.com
 * @date 2013-07-30
 */

;(function() {
    
    ZD.applyConfig({
        groups: {
            iuploader: {
                base: YUI.getBase('iuploader/js'),
                comboBase: YUI.getComboBase('iuploader/js'),
                root: '',
                combine: YUI.combine,
                modules: {
                    'main': {
                        use: ['iuploader'] 
                    },
                    'iuploader': {
                        path: YUI.getPath('iuploader'),
                        requires: ['uploader', 'ZeroClipboard', 'json-parse']
                    }
                }
            }
        }    
    });
    
})();
