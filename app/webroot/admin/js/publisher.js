KindEditor.ready(function(K) {
    var form = K('#publish-form'),
        preview = K('#preview-btn'),
        submit = K('#submit-btn'),
        cancel = K('#cancel-btn'),
        textarea = K('#editor'),
        content = K('#content'),
        debug = location.href.indexOf('publisher/demo/index') > -1,
        height = winHeight() - docHeight(),
        editor;


    function winHeight() {
        return window.innerHeight;
    }
    
    function docHeight() {
        return document.documentElement.scrollHeight;
    }
    
    if (height > 0) {
        textarea[0].style.height = 400 + height + 'px';
    }
    
    function save() {
        localStorage.setItem('zdarticle', textarea.val());
        setTimeout(function() {
            location.reload();
        }, 500);
    }
    
    function read() {
        var content = localStorage.getItem('zdarticle');
        if (content) {
            textarea[0].innerHTML = content;
        }
    }
    
    if (debug) {
        read();
    }
     
    editor = K.create('#editor', {
        uploadJson: '/mainapi/uploadImage'
    }); 
    
    preview.bind('click', function(e) {
        editor.clickToolbar('preview');
    });
        
    submit.bind('click', function(e) {
        editor.sync();
        if (debug) {
            save();
        } else {
            //form[0].submit();
			$('#publish-form').submit();
        }
    });
    
    cancel.bind('click', function(e) {
        location.reload();
    });
});
