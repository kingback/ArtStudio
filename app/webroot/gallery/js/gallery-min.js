/* ZD */
YUI.add("gallery",function(a){var b=[{small:"http://106.186.25.82/gridfs/b03a6770fe2aabeedf9312df70560642-584-820.png",large:"http://106.186.25.82/gridfs/b03a6770fe2aabeedf9312df70560642-584-820.png"},{small:"http://106.186.25.82/gridfs/74931bdbd8774341b26d9c6c030fc41b-587-820.png",large:"http://106.186.25.82/gridfs/74931bdbd8774341b26d9c6c030fc41b-587-820.png"},{small:"http://106.186.25.82/gridfs/5201733f84896ec608b40849b9cfcec5-591-820.png",large:"http://106.186.25.82/gridfs/5201733f84896ec608b40849b9cfcec5-591-820.png"},{small:"http://106.186.25.82/gridfs/c5a24583f379caab3fc1a0ebd3a4bde8-583-820.png",large:"http://106.186.25.82/gridfs/c5a24583f379caab3fc1a0ebd3a4bde8-583-820.png"},{small:"http://106.186.25.82/gridfs/444ae078389eaa444805fc082f562478-584-820.png",large:"http://106.186.25.82/gridfs/444ae078389eaa444805fc082f562478-584-820.png"},{small:"http://106.186.25.82/gridfs/f9180fe7dcd24c6bf7e13a5ed562105a-583-820.png",large:"http://106.186.25.82/gridfs/f9180fe7dcd24c6bf7e13a5ed562105a-583-820.png"},{small:"http://106.186.25.82/gridfs/90917713d3c8b21cbfc8f45e8cf77944-520-350.jpeg",large:"http://106.186.25.82/gridfs/90917713d3c8b21cbfc8f45e8cf77944-520-350.jpeg"},{small:"http://106.186.25.82/gridfs/3a8e1bda303e345a58acb390792727f3-361-336.jpeg",large:"http://106.186.25.82/gridfs/3a8e1bda303e345a58acb390792727f3-361-336.jpeg"},{small:"http://106.186.25.82/gridfs/37ceb25a917b31cefc18c2b861512ff9-320-276.gif",large:"http://106.186.25.82/gridfs/37ceb25a917b31cefc18c2b861512ff9-320-276.gif"},{small:"http://106.186.25.82/gridfs/51e605f75ce09b91e521a46b882a43c2-400-400.jpeg",large:"http://106.186.25.82/gridfs/51e605f75ce09b91e521a46b882a43c2-400-400.jpeg"},{small:"http://106.186.25.82/gridfs/b4de5e031c8e7d16473a39e6cc3c1553-378-317.jpeg",large:"http://106.186.25.82/gridfs/b4de5e031c8e7d16473a39e6cc3c1553-378-317.jpeg"},{small:"http://106.186.25.82/gridfs/35b8743808ed19b07c849cea776ac3fd-311-308.jpeg",large:"http://106.186.25.82/gridfs/35b8743808ed19b07c849cea776ac3fd-311-308.jpeg"},{small:"http://106.186.25.82/gridfs/d1a3153643643d1470ffeff18f672198-320-480.jpeg",large:"http://106.186.25.82/gridfs/d1a3153643643d1470ffeff18f672198-320-480.jpeg"},{small:"http://106.186.25.82/gridfs/8e730b3a07cf9693dd4c4dde4a37ce1e-609-852.png",large:"http://106.186.25.82/gridfs/8e730b3a07cf9693dd4c4dde4a37ce1e-609-852.png"}];a.Gallery={init:function(){this.id=!1,this.data={},this.bindAlbums(),this.data["4"]=b,this.data["5"]=b},initGalleria:function(b){this.galleria=new a.Galleria({source:b,zIndex:1e3,visible:!1,render:!0})},showGalleria:function(a){a&&(this.galleria?this.galleria.set("source",a):this.initGalleria(a)),this.galleria.show()},showAlbum:function(a){return this.id&&a===this.id?(this.showGalleria(),this):(this.getAlbumData(a,function(b){this.id=a,this.data[a]=b,this.showGalleria(b)}),this)},getAlbumData:function(b,c){var d=this;this.data[b]?c&&c.call(this,this.data[b]):a.io("http://106.186.25.82/mainapi/albuminfo?id="+b,{method:"GET",data:{id:b},on:{complete:function(b,e){var f;try{f=a.JSON.parse(e.responseText),f=this.parseData(f)}catch(g){}f&&c&&c.call(d,f.images)}}})},parseData:function(b){return a.Array.each(b,function(a,c){b[c].small="http://106.186.25.82/gridfs/"+b[c].small,b[c].large="http://106.186.25.82/gridfs/"+b[c].large}),b},bindAlbums:function(){a.one("body").delegate("click",function(a){this.showAlbum(a.currentTarget.ancestor().getAttribute("data-albumid"))},".album-cover",this)}},a.Gallery.init()},"0.0.1",{requires:["galleria","io","json-parse"]});