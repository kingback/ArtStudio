/* ZD */
YUI.add("widget-mask",function(a){function b(){}var c=6===a.UA.ie;b.DEF_STYLES={position:"fixed",backgroundColor:"#000",opacity:.75,left:"-9999px",top:"-9999px",width:"100%",height:"100%",visibility:"hidden"},b.ATTRS={maskVisible:{value:!1},maskStyles:{value:null},maskClass:{value:""}},b.CLASS=a.ClassNameManager.getClassName("widget","mask"),b.CLASS_HIDDEN=a.ClassNameManager.getClassName("widget","mask","hidden"),b.CLASS_SHIM=a.ClassNameManager.getClassName("widget","mask","shim"),b.prototype={initializer:function(){a.after(this.renderMask,this,"render",this)},createMask:function(){var c=a.Node.create("<div />"),d=this.get("maskStyles"),e=this.get("maskClass");return c.setStyles(a.merge(b.DEF_STYLES,d)),c.addClass(e),c.addClass(b.CLASS),c.addClass(b.CLASS_HIDDEN),this.mask=c},createShim:function(){var d;return c&&(d=a.Node.create('<iframe class="'+b.CLASS_SHIM+'" frameborder="0" title="Widget Mask Shim" src="javascript:false" tabindex="-1" role="presentation"></iframe>'),d.setStyles({display:"none",zIndex:this.mask.getStyle("zIndex")||0})),d?this.shim=d:null},renderMask:function(){var a=this.get("boundingBox"),b=this.createMask(),c=this.createShim();a.insert(b),c&&b.insert(c),this.bindMask()},bindMask:function(){this.after("visibleChange",function(a){a.newVal?this.showMask():this.hideMask()}),this.after("maskVisibleChange",function(a){a.newVal?this._uiShowMask():this._uiHideMask()})},showMask:function(){return this.set("maskVisible",!0),this},hideMask:function(){return this.set("maskVisible",!1),this},syncMask:function(){var b=a.DOM.docWidth()+"px";return docHeight=a.DOM.docHeight()+"px",this.mask.setStyles({width:b,height:docHeight}),this.shim.setStyles({width:b,height:docHeight}),this},destructor:function(){this.mask.remove(!0),delete this.mask},_uiShowMask:function(){c&&(this.syncMask(),this.shim.setStyle("display","none")),this.setStyles({left:0,top:0,visible:"visible"}),this.mask.removeClass(b.CLASS_HIDDEN)},_uiHideMask:function(){c&&this.shim.setStyle("display","block"),this.setStyles({left:"-9999px",top:"-9999px",visible:"hidden"}),this.mask.addClass(b.CLASS_HIDDEN)}}},"0.0.1",{requires:["widget-base"]});