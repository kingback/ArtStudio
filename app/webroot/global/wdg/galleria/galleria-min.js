/* ZD */
YUI.add("galleria",function(a){var b='<div><div class="yui3-galleria-share"><a href="javascript:void(0);" target="_self">分享</a></div><div class="yui3-galleria-close"><a href="javascript:void(0);" target="_self" title="关闭">关闭</a></div></div>',c='<div><div class="yui3-galleria-loading"></div><div class="yui3-galleria-image"></div><div class="yui3-galleria-image-mask"></div></div>',d='<div><div class="yui3-galleria-prev"><a href="javascript:void(0);" target="_self">前一张</a></div><div class="yui3-galleria-thumb"><a href="javascript:void(0);" target="_self">所有图片</a></div><div class="yui3-galleria-next"><a href="javascript:void(0);" target="_self">后一张</a></div><div class="yui3-galleria-num">第<strong>0</strong>张（共<em>0</em>张）</div></div>',e='<div class="yui3-galleria-nav"><div class="yui3-galleria-total"><span>所有照片（<strong>0</strong>）</span><a href="javascript:void(0);" target="_self">关闭</a></div><div class="yui3-galleria-all"><div class="yui3-galleria-scroller"><ul class="yui3-galleria-list"></ul></div></div></div>',f='<div class="yui3-galleria-mask"></div>',g='<li data-large="{large}" data-index="{index}" data-id="{id}"><a href="javascript:void(0);" target="_self"><img src="{small}" title="{title}" /></a></li>',h='<div><div class="yui3-galleria-infocon"><h3><img src="/global/wdg/galleria/zd.png" width="48" height="48" /><strong>周达点评</strong></h3><div class="yui3-galleria-review"></div><div class="yui3-galleria-like"><a href="javascript:void(0);" target="_self">喜欢</a><span><strong>113</strong><b></b></span></div><div class="yui3-galleria-jiathis"><span class="yui3-galleria-jiato">分享到：</span><div class="jiathis_style_24x24"><a class="jiathis_button_qzone"></a><a class="jiathis_button_tsina"></a><a class="jiathis_button_tqq"></a><a class="jiathis_button_weixin"></a><a class="jiathis_button_renren"></a><a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a><a class="jiathis_counter_style"></a></div></div></div></div>',i=function(){return{_cache:{},getItem:function(a){return this._cache[a]||""},setItem:function(a,b){return this._cache[a]=b,b},removeItem:function(a){delete this._cache[a]}}}(),j=location.href.indexOf("godlike")>-1;a.Galleria=a.Base.create("galleria",a.Widget,[a.WidgetStack],{initializer:function(){a.one("body").addClass("yui3-skin-sam"),this._navHeight=180,this._nextImage=null,this.publish("select",{defaultFn:this._defSelectFn})},renderUI:function(){this._renderUINode("hd"),this._renderUINode("bd"),this._renderUINode("ft"),this._renderUINode("mask"),this._renderUINode("nav"),this._renderUINode("info"),this._domCache(),this._initScrollView(),this._renderJiaThis()},bindUI:function(){var b=this.get("contentBox");b.delegate("click",this.showNav,".yui3-galleria-thumb a",this),b.delegate("click",this.hideNav,".yui3-galleria-total a",this),b.delegate("click",this._onShareClick,".yui3-galleria-share a",this),b.delegate("click",this._onCloseClick,".yui3-galleria-close a",this),b.delegate("click",this._onItemClick,".yui3-galleria-list li a",this),b.delegate("click",this._onPrevClick,".yui3-galleria-prev a",this),b.delegate("click",this._onNextClick,".yui3-galleria-next a",this),b.delegate("click",this._onNextClick,".yui3-galleria-image-mask",this),b.delegate("click",this._onLikeBtnClick,".yui3-galleria-like a",this),a.on("resize",this._onWinResize,a.config.win,this),this.after("sourceChange",this._updateThumbs,this),this.after("visibleChange",this._afterVisibleChange,this),this.after("selectedItemChange",this._afterSelectedItemChange,this)},syncUI:function(){this._updateThumbs()},_domCache:function(){this._bb=this.get("boundingBox"),this._cb=this.get("contentBox"),this._imageCon=this._cb.one(".yui3-galleria-image"),this._nextBtn=this._cb.one(".yui3-galleria-next"),this._prevBtn=this._cb.one(".yui3-galleria-prev"),this._review=this._cb.one(".yui3-galleria-review"),this._like=this._cb.one(".yui3-galleria-like strong"),this._likeBtn=this._cb.one(".yui3-galleria-like a"),this._htmlEl=a.one("html")},_checkSibling:function(){var a=this.get("selectedItem");a&&(this._nextBtn.toggleClass("yui3-galleria-disabled",!a.next("li")),this._prevBtn.toggleClass("yui3-galleria-disabled",!a.previous("li")))},_renderUINode:function(b){var c=this.get("contentBox"),d=a.Node.create(a.Galleria["GALLERIA_"+b.toUpperCase()]);d.addClass(this.getClassName(b)),c.appendChild(d),this["_"+b+"Node"]=d},_renderJiaThis:function(){a.Get.js("http://v3.jiathis.com/code/jia.js?uid=1375524945718704")},_showAnim:function(){var a=this,b=.2,c="ease-out";a._infoNode.setStyle("right","-25%"),a._cb.setStyle("opacity",0),a._bb.setStyles({top:"-100%",opacity:0}),a._bb.transition({top:0,opacity:1,duration:b},function(){a._cb.transition({opacity:1,duration:b}),a._infoNode.transition({right:0,duration:b,easing:c})})},_updateThumbs:function(){var b,c,d=this.get("source"),e=this.get("contentBox"),f=this._navNode.one(".yui3-galleria-list"),h=this._navNode.one(".yui3-galleria-total strong"),i=e.one(".yui3-galleria-num strong"),j=e.one(".yui3-galleria-num em");delete this._thumbItems,this.reset(),f.empty(),this._imageCon.empty(),a.Array.each(d.images,function(d,e){c=this.getImageSize(d.small),b=a.Node.create(a.Lang.sub(g,{index:e+1,id:d.id||"",small:d.small,large:d.large,title:d.title||""})),b.setData("imageData",d),c[0]>c[1]&&b.addClass("yui3-galleria-short"),f.append(b)},this),this._thumbItems=f.all("li"),i.setContent(d.images.length?1:0),j.setContent(d.images.length),h.setContent(d.images.length),this.scrollview.syncUI(),this.showImage(this._thumbItems.item(0))},_getImageRealSize:function(a){var b=this.getImageSize(a),c=this._imageCon.get("offsetWidth"),d=this._imageCon.get("offsetHeight"),e=b[0]/c,f=b[1]/d,g=Math.max(e,f);return g>1&&(b[0]=Math.round(b[0]/g),b[1]=Math.round(b[1]/g)),{width:b[0],height:b[1],ratio:g,cWidth:c,cHeight:d}},_posImage:function(a){var b=this._getImageRealSize(a.src),c=0;b.height<b.cHeight&&(c=Math.round((b.cHeight-b.height)/2)),a.style.width=b.width+"px",a.style.height=b.height+"px",a.style.marginTop=c+"px"},_getItemById:function(b){var c=this._thumbItems.getDOMNodes(),d=null;return b&&a.Array.some(c,function(a,c){return a.getAttribute("data-id")===b?(d=this._thumbItems.item(c),!0):void 0},this),d},_getNavHeight:function(){return this._navHeight=Math.max(180,Math.round(this._bb.get("offsetHeight")/3)),this._navHeight},_updateImageSize:function(){var a=this.get("visible"),b=this._imageCon.one("img");a&&b&&this._posImage(b._node)},_updateNavSize:function(){var a=this.get("visible"),b=this._getNavHeight(),c=this._navNode.get("offsetHeight");a&&(c&&this._navNode.setStyle("height",b),this.scrollview.set("height",b-64),this.scrollview.syncUI())},_initScrollView:function(){this.scrollview=new a.ScrollView({srcNode:this._navNode.one(".yui3-galleria-scroller"),height:this._navHeight-64,axis:"y",flick:{minDistance:10,minVelocity:.3,axis:"y"},render:!0}),this.scrollview.scrollbars.show(!0)},_onShareClick:function(){var b=a.one(".jiathis_button_tsina");b&&b.simulate("click")},_onCloseClick:function(){this.hide()},_onPrevClick:function(){this.prevImage()},_onNextClick:function(){this.nextImage()},_onLikeBtnClick:function(){var a=this._likeBtn,b=a.getAttribute("data-albumid"),c=a.getAttribute("data-imageid"),d=i.getItem(c),e=this.get("selectedItem").getData("imageData");d&&!j?alert("您已经点击过喜欢了，感谢您的支持~"):((new Image).src="/mainapi/likePic?albumId="+b+"&imgId="+c,this._like.setContent(++e.like),i.setItem(c,!0))},_onItemClick:function(a){this.showImage(a.currentTarget.ancestor("li"))},_onWinResize:function(){this._updateImageSize(),this._updateNavSize()},_afterVisibleChange:function(a){this._htmlEl.toggleClass("yui3-galleria-lock",a.newVal),a.newVal?(this._updateImageSize(),this._updateNavSize(),this._showAnim()):(this.hideNav(),this._updateJiaThis())},_afterSelectedItemChange:function(a){var b=a.prevVal,c=a.newVal;c&&this.fire("select",{prevItem:b,item:c,data:c.getData("imageData"),index:c.getAttribute("data-index"),id:c.getAttribute("data-id"),src:a.src})},_defSelectFn:function(a){this._set("selectedId",a.id),this._showImage(a),this._checkSibling(a),this._updateReview(a),this._updateLike(a),this._updateJiaThis(a)},_showImage:function(a){var b,c=this.get("contentBox"),d=c.one(".yui3-galleria-image"),e=c.one(".yui3-galleria-num strong"),f=a.item.getAttribute("data-large");"next"===a.src&&this._nextImage?b=this._nextImage:(b=document.createElement("img"),b.src=f),d.empty(),d.appendChild(b),this._posImage(b),a.prevItem&&a.prevItem._node&&a.prevItem.removeClass("yui3-galleria-selected"),a.item.addClass("yui3-galleria-selected"),e.setContent(a.index),this.hideNav(),this._preload()},_updateReview:function(a){this._review.setContent("“"+(a&&a.data&&a.data.desc||"暂无点评")+"”")},_updateLike:function(a){var b=this.get("source");this._like.setContent(a&&a.data&&a.data.like||0),this._likeBtn.setAttribute("data-albumid",b&&b.id||""),this._likeBtn.setAttribute("data-imageid",a&&a.data&&a.data.id||"")},_updateJiaThis:function(a){window.jiathis_config=window.jiathis_config||{},window.jiathis_config.pic=a&&a.item.one("img").getAttribute("src")||""},_preload:function(){var a,b=this.get("selectedItem"),c=null;b&&(a=b.next("li"))&&(c=document.createElement("img"),c.src=a.getAttribute("data-large")),this._nextImage=c},reset:function(){this.set("selectedItem",null),this._set("selectedId","")},prevImage:function(){var b=a.one(".yui3-galleria-selected"),c=b.previous("li");c&&this.showImage(c,"prev")},nextImage:function(){var b=a.one(".yui3-galleria-selected"),c=b.next("li");c&&this.showImage(c,"next")},getImageSize:function(a){var b=a.lastIndexOf("."),c=a.substring(0,b),d=c.split("-"),e=d.length;return[Number(d[e-2]),Number(d[e-1])]},showImage:function(b,c){a.Lang.isNumber(b)?b=this._thumbItems.item(b):a.Lang.isString(b)&&(b=this._getItemById(b)),b||(b=this.get("selectedItem")||this._thumbItems.item(0)),this.set("selectedItem",b,{src:c||"select"})},showNav:function(a){return a&&a.preventDefault(),this._navNode.transition({opacity:1,height:this._navHeight+"px",duration:.25}),this.showMask(),this},hideNav:function(a){return a&&a.preventDefault(),this._navNode.transition({opacity:0,height:"0px",duration:.25}),this.hideMask(),this},showMask:function(){this._maskNode.setStyle("display","block"),this._maskNode.transition({opacity:.75,duration:.25})},hideMask:function(){this._maskNode.transition({opacity:0,duration:.25},function(){this.setStyle("display","none")})}},{ATTRS:{source:{},selectedItem:{},selectedId:{readOnly:!0}},GALLERIA_HD:b,GALLERIA_BD:c,GALLERIA_FT:d,GALLERIA_NAV:e,GALLERIA_MASK:f,GALLERIA_INFO:h})},"0.0.1",{requires:["galleria-skin","node-event-simulate","base","widget","widget-stdmod","widget-stack","scrollview"]});