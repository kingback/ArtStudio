/**
 * 图片上传页面
 */

YUI.add('iuploader', function(Y) {
    
    ZeroClipboard.setDefaults( { moviePath: '/global/wdg/ZeroClipboard/ZeroClipboard.swf' } );
    
    var selectCon = Y.one('.select-button-container'),
        uploadBtn = Y.one('#upload'),
        removeBtn = Y.one('#remove'),
        fileList = Y.one('.file-list'),
        uploadedList = Y.one('.uploaded-list'),
        ftemp = Y.Lang.trim(Y.one('#J_file_temp').get('innerHTML')),
        utemp = Y.Lang.trim(Y.one('#J_uploaded_temp').get('innerHTML')),
        tip = Y.one('.copied-tip'),
        clip = new ZeroClipboard(),
        tipTimer, uploader;
    
    function readFile(file, callback, context) {
        var reader = new FileReader();
        reader.onload = function() {
            callback && callback.call(context || this, this.result);
        };
        try {
            reader.readAsDataURL(file);
        } catch (e) {}
    }
    
    uploader = new Y.Uploader({
        width: "150px",
        height: "35px",
        multipleFiles: true,
        uploadURL: window.uploadURL,
        simLimit: 2,
        withCredentials: false,
        selectButtonLabel: 'Select images',
        dragAndDropArea: '.dd-area'
    });
    
    uploader.after('fileselect', function(e) {
        var files = e.fileList,
            allFiles = uploader.get('fileList');
        
        selectCon.setStyle('width', '30%');
        if (allFiles.length === files.length) {
            fileList.empty();
        }
        
        Y.Array.each(files, function(file) {
            var item = Y.Node.create(Y.Lang.sub(ftemp, {
                id: file.get('id'),
                name: file.get('name')
            }));
            fileList.append(item);
            readFile(file.get('file'), function(data) {
                item.prepend('<img width="30" height="30" src="' + data + '" />');
            });
        });
        
    });
    
    uploader.on("uploadstart", function (e) {
        uploader.set('enabled', false);
        uploadBtn.addClass('yui3-button-disabled');
        removeBtn.addClass('yui3-button-disabled');
    });
    
    uploader.on("uploadprogress", function (e) {
        Y.one('#' + e.file.get('id') + ' span').setContent(e.percentLoaded + '%');
    });
    
    uploader.on('uploadcomplete', function(e) {
        var node = Y.one('#' + e.file.get('id')),
            data = Y.JSON.parse(e.data),
            item;
            
        item = Y.Node.create(Y.Lang.sub(utemp, {
            id: node.getAttribute('id') + '_uploaded',
            name: node.getAttribute('data-name'),
            src: 'http://106.186.25.82/gridfs/' + data.file,
            url: 'http://106.186.25.82/gridfs/' + data.file
        }));
        
        uploadedList.append(item);
        clip.glue(item.one('button')._node);
    });
    
    uploader.on('alluploadscomplete', function(e) {
        var item;
        uploader.set('enabled', true);
        uploadBtn.removeClass('yui3-button-disabled');
        removeBtn.removeClass('yui3-button-disabled');
        uploader.set('fileList', []);
    });
    
    uploadBtn.on('click', function(e) {
        if (!uploadBtn.hasClass('yui3-button-disabled')) {
            if (uploader.get("fileList").length > 0) {
                uploader.uploadAll();
            } else {
                alert('请选择需要上传的图片！');
            }
        }
    });
    
    removeBtn.on('click', function(e) {
        var remove = true;
        if (!uploadBtn.hasClass('yui3-button-disabled')) {
            if (uploader.get("fileList").length > 0) {
                remove = window.confirm('确定移除还未上传的图片吗？');
            }
            if (remove) {
                fileList.empty();
                uploader.set('fileList', []);
                selectCon.setStyle('width', '100%');
            }
        }
    });
    
    clip.on('mouseover', function() {
        clip.setText(this.parentNode.getAttribute('data-url'));
        Y.one(this).addClass('yui3-button-hover');
    });
    
    clip.on('mouseout', function() {
        clip.setText('');
        Y.one(this).removeClass('yui3-button-hover');
    });
    
    clip.on('mousedown', function() {
        Y.one(this).addClass('yui3-button-active');
    });
    
    clip.on('mouseup', function() {
        Y.one(this).removeClass('yui3-button-active');
    });
    
    clip.on('complete', function (client, args) {
        showTip(args.text);
    });
    
    clip.on('load', function() {
        uploader.render('#select-button');
        uploadBtn.removeClass('yui3-button-disabled');
        removeBtn.removeClass('yui3-button-disabled');
    });
    
    function showTip(text) {
        clearTimeout(tipTimer);
        tip.addClass('copied-tip-show');
        tipTimer = setTimeout(function() {
            hideTip();
        }, 5000);
    }
    
    function hideTip() {
        tip.removeClass('copied-tip-show');
    }
    
}, '0.0.1', {
    requires: ['uploader', 'ZeroClipboard', 'json-parse']
});