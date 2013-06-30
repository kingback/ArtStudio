YUI.add('validate', function(Y) {
    
    var validateJSON = {
            name: {
                required: {
                    errmsg: '请填写您的姓名。'
                }
            },
            birthday: {
                required: {
                    errmsg: '请选择正确的出生日期。'
                }
            },
            highschool: {
                required: {
                    errmsg: '请填写您所在高中。'
                }
            },
            telephone: {
                required: {
                    errmsg: '请填写您的手机号码。'
                },
                regx: {
                    rule: 'telephone',
                    errmsg: '您所填的手机号码格式不正确。'
                }
            },
            email: {
                required: {
                    errmsg: '请填写您的邮箱。'
                },
                regx: {
                    rule: 'email',
                    errmsg: '您所填的邮箱格式不正确。'
                }
            }
        },
    
        validator = Validator(validateJSON);
    
    var result = validator.checkForm('s-form'); 
    debugger;   
    
}, '0.0.1', {
    requires: ['node', 'validator']
});
