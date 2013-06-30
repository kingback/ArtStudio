/**
 * 全局配置
 * @author ningzbruc@gmail.com
 * @date 2013-06-10
 */

;(function() {
    
    var combine = true,
        filter;
    
    function getBase(root) {
        return '/' + root + '/';
    }
    
    function getComboBase(root) {
        return '/min/?b=' + root + '&f=';
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
                base: getBase('global/wdg'),
                comboBase: getComboBase('global/wdg'),
                root: '',
                combine: combine,
                modules: {
                    'slide': {
                        path: 'slide/slide-min.js',
                        requires: ['node', 'anim']
                    },
                    'datecascade': {
                        path: 'datecascade/datecascade-min.js',
                        requires: ['node', 'base']
                    },
                    'validator': {
                        path: 'validator/validator-min.js'
                    },
                    'mytabview': {
                        path: 'mytabview/mytabview-min.js',
                        requires: ['base', 'classnamemanager', 'node', 'event', 'event-delegate']
                    },
                    'mytabview-fade': {
                        path: 'mytabview/mytabview-fade-min.js',
                        requires: ['plugin', 'mytabview']
                    },
                    'mytabview-lazyload': {
                        path: 'mytabview/mytabview-lazyload-min.js',
                        requires: ['plugin', 'mytabview']
                    }
                }
            },
            'g-mods': {
                base: getBase('global/js'),
                comboBase: getComboBase('global/js'),
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
    
    YUI.getBase = getBase;
    YUI.getComboBase = getComboBase;
    
    YUI.combine = combine;
    YUI.filter = filter;

    window['ZD'] = YUI();
    
})();
