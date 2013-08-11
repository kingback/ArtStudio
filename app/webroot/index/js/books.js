/**
 * 出版书籍轮播
 */

YUI.add('books', function(Y) {
    
    var Books = {
        
        init: function() {
            this.con = Y.one('.books ul');
            this.books = Y.all('.books li');
            this.total = this.books.size();
            if (this.total >= 5) {
                this.con.setStyle('width', 154 * this.total + 'px');
                this.run();
            }
        },
        
        run: function() {
            var self = this;
            setTimeout(function() {
                self.runAnim();
                self.run();
            }, 5000)
        },
        
        runAnim: function() {
            var self = this,
                item = this.con.one('li');
            
            this.con.transition({
                left: '-154px',
                duration: 0.3
            }, function() {
                self.con.setStyle('left', 0);
                self.con.append(item);
            });
        }
          
    };
    
    Books.init();
    
}, '0.0.1', {
    requires: ['node', 'transition']
});
