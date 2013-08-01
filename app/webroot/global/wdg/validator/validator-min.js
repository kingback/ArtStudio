/* ZD */
var Validator=function(vj){function validate(en,rule){var _en=en.replace(/-\d+$/,""),inLoop=vj[_en].inLoop,o=vj[_en][rule],_s=this;if(!o.condition)return validatorFunc[rule].call(this,en);var condition=o.condition.replace(/#(\w+)/g,function(a,b){return'"'+getValue(_s[b])+'"'});if(inLoop){var num=en.match(/(\d+)$/)[1];condition=o.condition.replace(/#(\w+)/g,function(a,b){return'"'+getValue(_s[b+"-"+num])+'"'})}try{return eval(condition)?validatorFunc[rule].call(this,en):!0}catch(e){return!0}}function validateElem(a,b){if(b||(ErrObj={},ErrArr=[]),isIE&&(1==a.getAttribute("disabled")||"disabled"==a.getAttribute("disabled"))||!isIE&&""==a.getAttribute("disabled"))return{ErrObj:ErrObj,ErrArr:ErrArr};var c,d=a.form,e=a.name,f=e.replace(/-\d+$/,"");if(f in vj)for(c in vj[f])if("inLoop"!==c&&!validate.call(d,e,c))break;return{ErrObj:ErrObj,ErrArr:ErrArr,valid:!ErrArr.length}}function checkForm(form){ErrObj={},ErrArr=[];for(var elements=[],tmpEl,i=0,e=form.elements,l=e.length;l>i;i++)tmpEl=e[i+1],(tmpEl&&tmpEl.name!==e[i].name||i===l-1)&&elements.push(e[i]);for(var i=0,e=elements,l=e.length;l>i;i++)validateElem(e[i],!0);for(var a in vj)if(/#B$/.test(a)){var inLoop=vj[a].inLoop,o=vj[a].sum,sum=0,_s=form,e=form.elements,l=e.length;if(o.condition){var condition,cName;if(condition=o.condition.replace(/#(\w+)/g,function(a,b){return cName=b,'"'+getValue(_s[b])+'"'}),inLoop){for(var num,j=0;l>j;j++){var cen=e[j].name;if(cen.indexOf(cName)>-1){num=cen.match(/(\d+)$/)[1];break}}if(!num)break;condition=o.condition.replace(/#(\w+)/g,function(a,b){return'"'+getValue(_s[b+"-"+num])+'"'})}try{if(!eval(condition))break}catch(e){break}}for(var i=0,e=form.elements,l=e.length,hasElem=!1,be=a.slice(0,-2);l>i;i++){var en=e[i].name;en.indexOf(be+"-")>-1&&(hasElem=!0,sum+=parseInt(getValue(e[i]),10))}hasElem&&sum!=o.result&&generateMsg(a,o.errmsg)}return{ErrObj:ErrObj,ErrArr:ErrArr,valid:!ErrArr.length}}function $(a){return document.getElementById(a)}function trim(a){return a.replace(/^\s+/g,"").replace(/\s+$/g,"")}function getValue(a){if(!a)return"";if("undefined"!=typeof a.tagName){if("INPUT"===a.tagName&&("text"===a.type||"hidden"===a.type)||"SELECT"===a.tagName||"TEXTAREA"===a.tagName)return a.value}else{if(a[0]&&"radio"===a[0].type)for(var b=a.length-1;b>=0;b--)if(a[b].checked)return a[b].value;if(a[0]&&"checkbox"===a[0].type){for(var c="",b=a.length-1;b>=0;b--)a[b].checked&&(c+=a[b].value);return c}if("radio"===a.type||"checkbox"===a.type)return a.value}return""}var ErrObj={},ErrArr=[],isIE=!-[1],generateMsg=function(a,b){ErrObj[a]||(ErrObj[a]=[]),ErrObj[a].push(b),ErrArr.push(b)},validatorFunc={required:function(a){var b=a.replace(/-\d+$/,""),c=vj[b].required,d=trim(getValue(this[a]));return d?!0:(generateMsg(a,c.errmsg),!1)},minSize:function(a){var b=a.replace(/-\d+$/,""),c=vj[b].minSize,d=trim(getValue(this[a]));return c.num&&c.num>d.length?(generateMsg(a,c.errmsg),!1):!0},maxSize:function(a){var b=a.replace(/-\d+$/,""),c=vj[b].maxSize,d=trim(getValue(this[a]));return c.num&&c.num<d.length?(generateMsg(a,c.errmsg),!1):!0},regx:function(a){var b,c=a.replace(/-\d+$/,""),d=vj[c].regx,e=trim(getValue(this[a]));if(d.rule)switch(d.rule){case"number":b=/^\d+$/;break;case"date":b=/^\d{4}-\d{1,2}-\d{1,2}$/;break;case"datetime":b=/^\d{4}-\d{1,2}-\d{1,2} \d{1,2}:\d{1,2}:\d{1,2}$/;break;case"time":b=/^\d{1,2}:\d{1,2}:\d{1,2}$/;break;case"email":b=/^\w+([-+.]\w+)*@\w([-\w]*\.)?([-\w]+)?\.[a-z]{2,3}$/i;break;case"phone":b=/^\d{3,4}-\d{6,8}$/}else d.expression&&(b=new RegExp(d.expression));return b&&!b.test(e)?(generateMsg(a,d.errmsg),!1):!0},dateRange:function(a){var b=a.replace(/-\d+$/,""),c=vj[b].dateRange,d=trim(getValue(this[a])),e=new Date(d.replace(/-/g,"/"));if(c.min){var f=new Date(c.min.replace(/-/g,"/"));if(f>e)return generateMsg(a,c.errmsg),!1}if(c.max){var f=new Date(c.max.replace(/-/g,"/"));if(e>f)return generateMsg(a,c.errmsg),!1}return!0},ageRange:function(a){var b=a.replace(/-\d+$/,""),c=vj[b].ageRange,d=trim(getValue(this[a])),e=new Date(d.replace(/-/g,"/")),f=new Date,g=f.getFullYear()-e.getFullYear()-(f.getMonth()<e.getMonth()||f.getMonth()==e.getMonth()&&f.getDate()<e.getDate()?1:0);return c.min&&c.min>g||c.max&&c.max<g?(generateMsg(a,c.errmsg),!1):!0},idCard:function(a){var b=a.replace(/-\d+$/,""),c=vj[b].idCard,d=trim(getValue(this[a])),e=d,f=/^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9xX])$/;15==d.length&&(d=d.slice(0,6)+"19"+d.slice(6)+"1");var g=d.match(f);if(!g)return generateMsg(a,c.errmsg),!1;var h=new Date(g[2]+"/"+g[3]+"/"+g[4]),i=h.getFullYear()==Number(g[2])&&h.getMonth()+1==Number(g[3])&&h.getDate()==Number(g[4]);if(!i)return generateMsg(a,c.errmsg),!1;if(18==e.length){var j,k,l=[7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2],m=["1","0","X","9","8","7","6","5","4","3","2"],n=0;for(k=0;17>k;k++)n+=d.substr(k,1)*l[k];if(j=m[n%11],j!=d.substr(17,1).toUpperCase())return generateMsg(a,c.errmsg),!1}return!0},idCardUnion:function(a){var b=a.replace(/-\d+$/,""),c=vj[b].idCardUnion,d=trim(getValue(this[a])),e=vj[b].inLoop;if(15==d.length&&(d=d.slice(0,6)+"19"+d.slice(6)+"1"),c.birthdayItem){var f=this[e?c.birthdayItem.slice(1,-1)+"-"+a.match(/(\d+)$/)[1]:c.birthdayItem.slice(1)];if(f){for(var g=getValue(f).split("-"),h=g.length-1;h>0;h--)1==g[h].length&&(g[h]="0"+g[h]);if(g.join("")!=d.slice(6,14))return generateMsg(a,c.errmsg),!1}}if(c.genderItem){var i=this[e?c.genderItem.slice(1,-1)+"-"+a.match(/(\d+)$/)[1]:c.genderItem.slice(1)];if(i&&getValue(i)%2!=d.slice(-2,-1)%2)return generateMsg(a,c.errmsg),!1}return!0},length:function(a){var b=a.replace(/-\d+$/,""),c=vj[b].length,d=trim(getValue(this[a]));return c.num&&c.num!=d.length?(generateMsg(a,c.errmsg),!1):!0},gt:function(a){var b=a.replace(/-\d+$/,""),c=vj[b].gt,d=trim(getValue(this[a]));return c.value&&c.value>=1*d?(generateMsg(a,c.errmsg),!1):!0},lt:function(a){var b=a.replace(/-\d+$/,""),c=vj[b].lt,d=trim(getValue(this[a]));return c.value&&c.value<=1*d?(generateMsg(a,c.errmsg),!1):!0},custom:function(en){var _en=en.replace(/-\d+$/,""),o=vj[_en].custom,v=trim(getValue(this[en]));if(o.validatorName){var fb;try{var fn=eval(o.validatorName)}catch(e){var fn=function(){return!0}}if(fb=o.params?fn(o.params,en):fn(en),!fb)return generateMsg(en,o.errmsg),!1}return!0}};return{checkForm:checkForm,validateElem:validateElem}};