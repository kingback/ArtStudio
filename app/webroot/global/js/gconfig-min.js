/* ZD */
!function(){function a(a){return"/"+a+"/"}function b(a){return"/min/?b="+a+"&f="}var c,d=!0;location.search.indexOf("debug=true")>-1&&(c="RAW"),location.search.indexOf("combo=false")>-1&&(d=!1),YUI.GlobalConfig={base:a("yui/build"),comboBase:b("yui/build"),root:"",combine:d,comboSep:",",filter:c,groups:{"g-widgets":{base:a("global/wdg"),comboBase:b("global/wdg"),root:"",combine:d,modules:{slide:{path:"slide/slide-min.js",requires:["node","anim"]},datecascade:{path:"datecascade/datecascade-min.js",requires:["node","base"]},validator:{path:"validator/validator-min.js"},mytabview:{path:"mytabview/mytabview-min.js",requires:["base","classnamemanager","node","event","event-delegate"]},"mytabview-fade":{path:"mytabview/mytabview-fade-min.js",requires:["plugin","mytabview"]},"mytabview-lazyload":{path:"mytabview/mytabview-lazyload-min.js",requires:["plugin","mytabview"]}}},"g-mods":{base:a("global/js"),comboBase:b("global/js"),root:"",combine:d,modules:{zdglobal:{use:["g-floatbar"]},"g-floatbar":{path:"g-floatbar-min.js",requires:["anim"]}}}}},YUI.getBase=a,YUI.getComboBase=b,YUI.combine=d,YUI.filter=c,window.ZD=YUI()}();