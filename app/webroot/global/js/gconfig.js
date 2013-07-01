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
    
    function getPath(path, type, sep) {
        type = type || 'js';
        sep = sep || '-';
        return path + (YUI.filter ? '.' : sep + 'min.') + type; 
    }
    
    if (location.search.indexOf('debug=true') > -1) {
        filter = 'RAW';
    }
    
    if (location.search.indexOf('combo=false') > -1) {
        combine = false;
    }
    
    YUI.filter = filter;
    YUI.combine = combine;
    
    YUI.getBase = getBase;
    YUI.getComboBase = getComboBase;
    YUI.getPath = getPath;

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
                        path: getPath('slide/slide'),
                        requires: ['node', 'anim']
                    },
                    'datecascade': {
                        path: getPath('datecascade/datecascade'),
                        requires: ['node', 'base']
                    },
                    'validator': {
                        path: getPath('validator/validator')
                    },
                    'mytabview': {
                        path: getPath('mytabview/mytabview'),
                        requires: ['base', 'classnamemanager', 'node', 'event', 'event-delegate']
                    },
                    'mytabview-fade': {
                        path: getPath('mytabview/mytabview-fade'),
                        requires: ['plugin', 'mytabview']
                    },
                    'mytabview-lazyload': {
                        path: getPath('mytabview/mytabview-lazyload'),
                        requires: ['plugin', 'mytabview']
                    },
                    'greensock': {
                        path: getPath('greensock/TweenMax', 'js', '.')
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
                        path: getPath('g-floatbar'),
                        requires: ['anim']
                    }
                }
            }
        }
    };

    window['ZD'] = YUI();
    
})();
