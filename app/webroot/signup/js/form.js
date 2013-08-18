
YUI.add('form', function(Y) {
    
    var params = Y.QueryString.parse(location.search.substring(1));
    
    var validateJSON = {
        name: {
            required: {
                errmsg: '请填写您的姓名'
            }
        },
        birthday: {
            required: {
                errmsg: '请选择正确的出生日期'
            }
        },
        highschool: {
            required: {
                errmsg: '请填写您所在高中'
            }
        },
        telephone: {
            required: {
                errmsg: '请填写您的手机号码'
            },
            regx: {
                rule: 'telephone',
                errmsg: '您所填的手机号码格式不正确'
            }
        },
        qq: {
            required: {
                errmsg: '请填写您的QQ号码'
            },
            regx: {
                rule: 'number',
                errmsg: '您所填的QQ号码格式不正确'
            }
        },
        email: {
            required: {
                errmsg: '请填写您的邮箱'
            },
            regx: {
                rule: 'email',
                errmsg: '您所填的邮箱格式不正确'
            }
        }
    };
    
    Y.Form = {
        
        init: function() {
            this.domCache();
            this.initDateCascade();
            this.initValidator();
            this.bindEvents();
        },
        
        domCache: function() {
            this.form = Y.one('#s-form'),
            this.formNode = this.form.getDOMNode(),
            this.elemNodes = this.formNode.elements,
            this.elems = Y.all(this.elemNodes);
            this.requiredInputs = this.form.all('.required-info .elem-txt');
            this.dateSelectInput = this.form.one('#birthday');
            
            this.uploadInput = this.form.one('#avartar-unload-ipt');
            this.uploadFile = this.form.one('.avartar-file');
            this.avartarImage = this.form.one('.avartar-image img');
        },
        
        initDateCascade: function() {
            this.date = new Y.DateCascade({
                id: 'f-birthday',
                dateStart: '1950/01/01'
            });
            this.dateSelectInput.set('value', this.date.get('date'));
        },
        
        initValidator: function() {
            this.validator = Validator(validateJSON);
        },
        
        bindEvents: function() {
            this.form.on('submit', function(e) {
                var result = this.validator.checkForm(this.formNode),
                    firstErrorElement;
                    
                e.preventDefault();
                this.removeError(this.requiredInputs);
                
                if (result.valid) {
                    this.form.submit();
                } else {
                    this.addError(result.ErrObj);
                    firstErrorElement = this.form.one('.item-error .elem-txt');
                    if (firstErrorElement.hasClass('hidden')) {
                        firstErrorElement = firstErrorElement.ancestor('li').one('select');
                    }
                    firstErrorElement.focus();
                }
            }, this);
            
            this.requiredInputs.on('blur', function(e) {
                var result = this.validator.validateElem(e.target.getDOMNode());
                    
                if (result.valid) {
                    this.removeError(e.target);
                } else {
                    this.addError(result.ErrObj);
                }
            }, this);
            
            this.date.after('dateChange', function(e) {
                this.dateSelectInput.set('value', e.newVal);
                if (e.newVal) {
                    this.removeError(this.dateSelectInput); 
                } else {
                    this.addError(this.validator.validateElem(this.dateSelectInput._node).ErrObj);
                }
            }, this);
            
            this.uploadInput.on('change', function(e) {
                var _this = this,
                    files = e.target._node.files,
                    reader;
                
                this.uploadFile.setContent(e.target.get('value'));
                    
                if (files && typeof FileReader !== 'undefined') {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        _this.avartarImage._node.src = this.result;
                    };
                    reader.readAsDataURL(files[0]);
                }
            }, this);
        },
        
        addError: function(elem, msg) {
            var parent;
            if (Y.Lang.isUndefined(msg)) {
                Y.Object.each(elem, function(res, name) {
                    this.addError(name, res[0]);
                }, this);
            } else {
                elem = Y.one(Y.Lang.isString(elem) ? this.elemNodes[elem] : elem);
                if (elem) {
                    parent = elem.ancestor('li');
                    parent.addClass('item-error');
                    parent.one('.info').setContent(msg);
                }
            }
        },
        
        removeError: function(elem) {
            var parent;
            if (elem.size) {
                elem.each(function(el) {
                    this.removeError(el);
                }, this);
            } else {
                elem = Y.one(elem);
                if (elem) {
                    parent = elem.ancestor('li');
                    parent.removeClass('item-error');
                    elem.ancestor('li').one('.info').setContent('');
                }
            }
        }
        
        /*
        submit: function() {
            Y.io(this.form.getAttribute('action'), {
                method: 'POST',
                on: {
                    success: function(id, res) {
                        alert('报名成功！');
                        window.location.reload();
                    },
                    failure: function(id, res) {
                        var r;
                        try {
                            r = eval('(' + res.responseText + ')');
                        } catch (err) {}
                        
                        alert(r && r.msg || '报名失败，请重试');
                    }
                },
                form: {
                    id: this.form._node
                } 
            });
        }
        */

    };
    
    Y.Form.init();
    
    if (params['msg']) {
        alert(params['msg']);
    }
        
}, '0.0.1', {
    requires: ['node', 'validator', 'event-hover', 'querystring-parse']
});
