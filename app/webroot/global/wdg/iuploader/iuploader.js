/**
 * 图片上传器
 * iuploader
 */

YUI.add('iuploader', function(Y) {
    
    var UI_TEMPLATE = [
                          '<div class="yui3-iuploader-container">',
                              '<div class="yui3-iuploader-dd">',
                                  '<ul class="yui3-iuploader-list"></ul>',
                                  '<div class="yui3-iuploader-fileselect">',
                                      '<div class="yui3-iuploader-select"></div>',
                                      '<p>或者可以将图片拖拽到这里</p>',
                                  '</div>',
                              '</div>',
                              '<div class="yui3-iuploader-button">',
                                  '<button type="button" class="yui3-button yui3-iuploader-upload">上传图片</button>',
                                  '<button type="button" class="yui3-button yui3-iuploader-remove">移除图片</button>',
                              '</div>',
                          '</div>'
                      ].join(''),
        ITEM_TEMPLATE = '<li id="{id}" data-name="{name}"><em>{name}</em><span>0%</span></li>';
    
    Y.ImageUploader = Y.Base.create('iuploader', Y.Uploader, [], {
        
        initializer: function() {
            this.form = this.get('form');
            this.action = this.form.getAttribute('action');
            this.set('uploadURL', this.action);
            
            Y.after(this.bindUploader, this, 'render', this);
            
            this.renderUploader();
        },
        
        renderUploader: function() {
            this.container = Y.Node.create(UI_TEMPLATE);
            this.form.append(this.container);
            this.form.addClass('yui3-iuploader-form');
            
            this.fileSelectNode = this.container.one('.yui3-iuploader-fileselect');
            this.fileListNode = this.container.one('.yui3-iuploader-list');
            this.uploadBtn = this.container.one('.yui3-iuploader-upload');
            this.removeBtn = this.container.one('.yui3-iuploader-remove');
            
            this.set('dragAndDropArea', this.container.one('.yui3-iuploader-dd'));
            
            this.render(this.container.one('.yui3-iuploader-select'));
        },
        
        bindUploader: function() {
            this.after('fileselect', this.afterFileSelect);
            
            this.on('uploadstart', this.onUploadStart);
            this.on('uploadprogress', this.onUploadProgress);
            this.on('alluploadscomplete', this.onAllUploadsComplete);
            
            this.uploadBtn.on('click', this.onUploadBtnClick, this);
            this.removeBtn.on('click', this.onRemoveBtnClick, this);
        },
        
        readFile: function(file, callback, context) {
            var reader = new FileReader();
            reader.onload = function() {
                callback && callback.call(context || this, this.result);
            };
            try {
                reader.readAsDataURL(file);
            } catch (e) {}
        },
        
        afterFileSelect: function(e) {
            var files = e.fileList,
                allFiles = this.get('fileList');
            
            this.fileSelectNode.setStyle('width', '30%');
            
            if (allFiles.length === files.length) {
                this.fileListNode.empty();
            }
            
            Y.Array.each(files, function(file) {
                var item = Y.Node.create(Y.Lang.sub(ITEM_TEMPLATE, {
                    id: file.get('id'),
                    name: file.get('name')
                }));
                
                this.fileListNode.append(item);
                
                this.readFile(file.get('file'), function(data) {
                    item.prepend('<img src="' + data + '" />');
                });
            }, this);
        
        },
        
        onUploadStart: function(e) {
            this.set('enabled', false);
            this.uploadBtn.addClass('yui3-button-disabled');
            this.removeBtn.addClass('yui3-button-disabled');
        },
        
        onUploadProgress: function(e) {
            Y.one('#' + e.file.get('id') + ' span').setContent(e.percentLoaded + '%');
        },
        
        onAllUploadsComplete: function(e) {
            this.uploadBtn.removeClass('yui3-button-disabled');
            this.removeBtn.removeClass('yui3-button-disabled');
            this.set('enabled', true);
            this.set('fileList', []);
            this.get('reload') && window.location.reload();
        },
        
        onUploadBtnClick: function(e) {
            if (!this.uploadBtn.hasClass('yui3-button-disabled')) {
                if (this.get("fileList").length > 0) {
                    this.uploadAll();
                } else {
                    alert('请选择需要上传的图片！');
                }
            }
        },
        
        onRemoveBtnClick: function(e) {
            var remove = true;
            
            if (!this.removeBtn.hasClass('yui3-button-disabled')) {
                if (this.get("fileList").length > 0) {
                    remove = window.confirm('确定移除还未上传的图片吗？');
                }
                if (remove) {
                    this.fileListNode.empty();
                    this.fileSelectNode.setStyle('width', '100%');
                    this.set('fileList', []);
                }
            }
        }
        
    }, {
        
        ATTRS: {
            form: {
                setter: Y.one
            },
            width: {
                value: '150px',
            },
            height: {
                value: '35px;'
            },
            simLimit: {
                value: 5
            },
            withCredentials: {
                value: false
            },
            multipleFiles: {
                value: true
            },
            selectButtonLabel: {
                value: '选择图片'
            },
            reload: {
                value: true
            }
        }
        
    });
    
    Y.on('domready', function(e) {
        Y.all('.yui3-iuploader-form').each(function(form) {
            form.iuploader = new Y.ImageUploader({form: form});
        });
    });
    
}, '0.0.1', {
    requires: ['base', 'uploader', 'iuploader-skin']
});
