/* ZD */
YUI.add("news",function(a){function b(b){return a.Lang.sub(g,b)||""}function c(a){var b=a.lastIndexOf("."),c=a.substring(0,b),d=c.split("-"),e=d.length,f=Number(d[e-2]),g=Number(d[e-1]),h=Math.round(270*g/f);return h}function d(b){return a.Array.map(b,function(a){return a.height=c(a.image),a})}function e(b,c){var e=this;a.io("/mainapi/news",{method:"GET",data:{page:i++},on:{complete:function(e,f){var g;try{g=a.JSON.parse(f.responseText)}catch(h){}g&&g.length?b(d(g)):c(g)},failure:function(){e.stop()}}})}var f,g=a.Lang.trim(a.one("#J_news_temp").get("innerHTML")),h=a.one(".news-nomore"),i=2;f=new a.Waterfall({container:".waterfall",data:window.NewsData&&d(window.NewsData),formatter:b,loader:e}),f.on("add",function(a){setTimeout(function(){a.item.addClass("waterfall-item-added")},50)}),f.on("fail",function(){this.stop(),h.setStyle("display","block")}),f.render()},"0.0.1",{requires:["waterfall","waterfall-loader","io","json-parse"]});