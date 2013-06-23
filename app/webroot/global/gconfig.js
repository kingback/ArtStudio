/**
 * 全局配置
 * @author ningzbruc@gmail.com
 * @date 2013-06-10
 */

;(function() {
    
    var combine = true,
        filter;
    
    function getRoot(root) {
        return location.pathname.substring(1, location.pathname.indexOf('zd/') + 3) + (root || '');
    }
    
    function getBase(root) {
        return location.protocol + '//' + location.hostname + '/' + getRoot(root) + '/';
    }
    
    function getComboBase(root) {
        return location.protocol + '//' + location.hostname + '/min/?b=' + getRoot(root) + '&f=';
    }
    
    if (location.search.indexOf('debug=true') > -1) {
        filter = 'RAW';
    }
    
    if (location.search.indexOf('combo=false') > -1) {
        combine = false;
    }

    YUI.GlobalConfig = {
        base: getBase('yui/build'),
        comboBase: getComboBase('yui/build'),
        root: '',
        combine: combine,
        comboSep: ',',
        filter: filter,
        groups: {
            'g-widgets': {
                base: getBase('global/widgets'),
                comboBase: getComboBase('global/widgets'),
                root: '',
                combine: combine,
                modules: {
                    'slide': {
                        path: 'slide/slide-min.js',
                        requires: ['node', 'anim']
                    }
                }
            },
            'g-mods': {
                base: getBase('global'),
                comboBase: getComboBase('global'),
                root: '',
                combine: combine,
                modules: {
                    'zdglobal': {
                        use: ['g-floatbar']    
                    },
                    'g-floatbar': {
                        path: 'g-floatbar-min.js',
                        requires: ['anim']
                    }
                }
            }
        }
    };
    
    YUI.getRoot = getRoot;
    YUI.getBase = getBase;
    YUI.getComboBase = getComboBase;
    
    YUI.combine = combine;
    YUI.filter = filter;

    window['ZD'] = YUI();
    
})();
