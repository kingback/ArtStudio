/* ZD */
YUI.add("iuploader",function(a){function b(a,b,c){var d=new FileReader;d.onload=function(){b&&b.call(c||this,this.result)};try{d.readAsDataURL(a)}catch(e){}}function c(){clearTimeout(e),n.addClass("copied-tip-show"),e=setTimeout(function(){d()},5e3)}function d(){n.removeClass("copied-tip-show")}ZeroClipboard.setDefaults({moviePath:"/global/wdg/ZeroClipboard/ZeroClipboard.swf"});var e,f,g=a.one(".select-button-container"),h=a.one("#upload"),i=a.one("#remove"),j=a.one(".file-list"),k=a.one(".uploaded-list"),l=a.Lang.trim(a.one("#J_file_temp").get("innerHTML")),m=a.Lang.trim(a.one("#J_uploaded_temp").get("innerHTML")),n=a.one(".copied-tip"),o=new ZeroClipboard;f=new a.Uploader({width:"150px",height:"35px",multipleFiles:!0,uploadURL:window.uploadURL,simLimit:2,withCredentials:!1,selectButtonLabel:"Select images",dragAndDropArea:".dd-area"}),f.after("fileselect",function(c){var d=c.fileList,e=f.get("fileList");g.setStyle("width","30%"),e.length===d.length&&j.empty(),a.Array.each(d,function(c){var d=a.Node.create(a.Lang.sub(l,{id:c.get("id"),name:c.get("name")}));j.append(d),b(c.get("file"),function(a){d.prepend('<img width="30" height="30" src="'+a+'" />')})})}),f.on("uploadstart",function(){f.set("enabled",!1),h.addClass("yui3-button-disabled"),i.addClass("yui3-button-disabled")}),f.on("uploadprogress",function(b){a.one("#"+b.file.get("id")+" span").setContent(b.percentLoaded+"%")}),f.on("uploadcomplete",function(b){var c=a.one("#"+b.file.get("id"));c.setAttribute("data-url",b.data)}),f.on("alluploadscomplete",function(){var b;f.set("enabled",!0),h.removeClass("yui3-button-disabled"),i.removeClass("yui3-button-disabled"),f.set("fileList",[]),j.all("li").each(function(c){b=a.Node.create(a.Lang.sub(m,{id:c.getAttribute("id")+"_uploaded",name:c.getAttribute("data-name"),src:c.one("img").getAttribute("src"),url:c.getAttribute("data-url")})),k.append(b),o.glue(b.one("button")._node)})}),h.on("click",function(){h.hasClass("yui3-button-disabled")||(f.get("fileList").length>0?f.uploadAll():alert("请选择需要上传的图片！"))}),i.on("click",function(){var a=!0;h.hasClass("yui3-button-disabled")||(f.get("fileList").length>0&&(a=window.confirm("确定移除还未上传的图片吗？")),a&&(j.empty(),f.set("fileList",[]),g.setStyle("width","100%")))}),o.on("mouseover",function(){o.setText(this.parentNode.getAttribute("data-url")),a.one(this).addClass("yui3-button-hover")}),o.on("mouseout",function(){o.setText(""),a.one(this).removeClass("yui3-button-hover")}),o.on("mousedown",function(){a.one(this).addClass("yui3-button-active")}),o.on("mouseup",function(){a.one(this).removeClass("yui3-button-active")}),o.on("complete",function(a,b){c(b.text)}),o.on("load",function(){f.render("#select-button"),h.removeClass("yui3-button-disabled"),i.removeClass("yui3-button-disabled")})},"0.0.1",{requires:["uploader","ZeroClipboard"]});