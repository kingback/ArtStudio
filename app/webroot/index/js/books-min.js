/* ZD */
YUI.add("books",function(a){var b={init:function(){this.con=a.one(".books ul"),this.books=a.all(".books li"),this.total=this.books.size(),this.total>=5&&(this.con.setStyle("width",154*this.total+"px"),this.run())},run:function(){var a=this;setTimeout(function(){a.runAnim(),a.run()},5e3)},runAnim:function(){var a=this,b=this.con.one("li");this.con.transition({left:"-154px",duration:.3},function(){a.con.setStyle("left",0),a.con.append(b)})}};b.init()},"0.0.1",{requires:["node","transition"]});