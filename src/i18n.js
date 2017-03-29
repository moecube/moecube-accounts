import $ from 'jquery';

var i18n_data = {
    en: {
        'language': '中文',
        'l': 'zh-CN',
        'username': 'User Name',
        'email': 'E-Mail',
        'password': 'Password',
        'user-info': 'User Info',
        'reset-info': 'Reset User Info',
        'avatar': 'Avatar',
        'nickname': 'Nickname',
        'reset-account-info': 'Reset Account info',
        'current_password': 'Current Password',
        'password-again': 'Input Password Again',
        'save': 'Save',
        'nickname': 'Nickname[optional]',
        'crop': 'Crop Image',
        'moecube': 'MoeCube',
        'index-leftbox1': 'You can use this account to sign in.',
        'yonghuan': 'The Disappearing of Gensokyo',
        'please-sign-up': 'Sign Up',
        'please-sign-in': 'Sign In',

        'email-address-or-username': 'E-Mail or Username',
        'sign-up': 'Sign Up',
        'sign-in': 'Sign In',
        'forgot-password': 'Forgot Password',
        'send-email': 'Send Email', // id 应该是 Send Email
        'reset-success':'reset success',
        'reset-fail':'reset fail',
        'reset-password':'Reset Password',

        'Please use a correct E-Mail address.':          'Please use a correct E-Mail address.',
        'User name can not be empty.':                'User name can not be empty.',
        'You can not use this username.':           'You can not use this username.',
        'You can use this password.':           'You can use this password.',
        'Password is too long.':                    'Password is too long.',
        'Password is too short.':                'Password is too short.',
        'Password is correct.':                 'Password is correct.',
        'Incorrect password.':                   'Incorrect password.',
        'The E-Mail has been sent.':            'The E-Mail has been sent.',

        'Incorrect user name or password.':          'Incorrect user name or password.',
        'E-Mail address can not be blank.':          'E-Mail address can not be blank.',
        'User name can not be blank.':          'User name can not be blank.',
        'Password can not be blank.':            'Password can not be blank.',
        'Please input your password again.':    'Please input your password again.',
        'Please use a correct E-Mail address.': 'Please use a correct E-Mail address.',
        'This E-Mail address has been token.':  'This E-Mail address has been token.',
        'You can use this E-mail address.':         'You can use this E-mail address.',
        'This user name has been token.':           'This user name has been token.',
        'You can use this user name.':          'You can use this user name.',
        'Password is not correct.':             'Password is not correct.',
        'User does not exisit.':                'User does not exisit.',
        'Incorrect password.':                  'Incorrect password.',

        'Please check your registration info again.':'Please check your registration info again.',
        'Your account has not been verified.':'Your account has not been verified. Please check the verification email we have sent to you. You will be able to log in after verification.',
        'A password reset email has been sent to you.':'A password reset email has been sent to you. Please check the email to continue.',
        'Your account has been created.':'Your account has been created. You will receive an verification email. Please check the mail to finish registration. ',

        'Error':'Error',
        'Your account has been successfully activated!':'Your account has been successfully activated!',

        'close':'close',
        'reset-email':'reset email',
        'send-email2':'send email',

        '1':'如果没有收到邮件请单击<button>重发邮件</button>获取验证邮件',
        '2':'邮件已发送,请查看激活邮件，激活后即可登陆。',

        'didnt receive verification email 1':'If you didn\'t receive the verification email, please click ',
		'didnt receive verification email 2':'to resend it again.',
		'A verification email has been sent to you.':'A verification email has been sent to you, please check your email to finish verification.',
		'Your email has been updated.':'Your email has been updated. You will receive an verification email. Please check the mail to finish verification. ',
    },
    zh: {
        'language': 'english',
        'l': 'en-US',
        'username': '用户名',
        'email': '邮箱',
        'password': '密码',
        'user-info': '用户信息',
        'reset-info': '修改信息',
        'avatar': '头像',
        'nickname': '昵称[选填]',
        'reset-account-info': '修改账户信息',
        'current_password': '原密码',
        'password-again': '再次输入密码',
        'save': '保存',
        'nickname[optional]': '昵称[选填]',
        'crop': '截图',
        'moecube': '萌立方',
        'index-leftbox1': '您可使用以下几种账号登陆',
        'yonghuan': '永远消失的幻想乡',
        'please-sign-up': '注册',
        'please-sign-in': '登陆',

        'email-address-or-username': '邮箱或用户名',
        'sign-up': '注册',
        'sign-in': '登陆',
        'forgot-password': '忘记密码',
        'send-email': '发送邮件',  // id 应该是 Send Email
        'reset-success':'修改成功',
        'reset-fail':'修改失败',
        'reset-password':'重设密码',

        'Please use a correct E-Mail address.': '请填写正确的邮箱地址',
        'User name can not be empty.':     '不能为空',
        'You can not use this username.': '用户名不合法',
        'You can use this password.':     '密码可以使用',
        'Password is too long.':          '密码过长',
        'Password is too short.':         '密码过短',
        'Password is correct.':           '密码一致',
        'Incorrect password.':            '密码不一致',
        'The E-Mail has been sent.':      '邮件已发送',


         'Incorrect-user-name-or-password':                   '用户或密码错误',
         'E-Mail-address-can-not-be-blank':                   '邮箱地址不能为空',
         'User name can not be blank.':                       '用户名不能为空',
         'Password can not be blank':                         '密码不能为空',
         'Please input your password again.':                 '确认密码不能为空',
         'Please use a correct E-Mail address.':              '邮箱格式错误',
         'This E-Mail address has been token.':               '该邮箱已被注册',
         'You can use this E-mail address.':                  '邮箱可以使用',
         'This user name has been token.':                    '该用户名已被注册',
         'You can use this user name.':                       '用户名可以使用',
         'Password is not correct.':                          '密码不一致',
         'User does not exisit.':                             '用户不存在',
         'Incorrect password.':                               '密码不正确',


        'Please check your registration info again.':'请填写正确的注册信息。',
        'Your account has not been verified.':'您的账户还未完成验证，请查看激活邮件，激活后即可登陆。',
        'A password reset email has been sent to you.':'密码重置邮件已发送，请查看邮件继续下一步。',
        'Your account has been created.':'您的账号已经创建。您将会收到一封验证邮件，请查看邮件完成注册。',

        'Error':'出问题了',
        'Your account has been successfully activated!':'账号激活成功！',

        
        'close':'关闭',
        'reset-email':'更改邮箱',
        'send-email2':'重发邮件',

        'didnt receive verification email 1':'如果您没有收到验证邮件，请点击',
        'didnt receive verification email 2':'获取验证邮件。',

		'2':'If you didn\'t receive the verification email, please click <button> to resend it again.',

		'A verification email has been sent to you.':'已经向您发送了一封验证邮件，请您查看Email完成验证。',
		

		'Your email has been updated.':'邮箱已经更新，您将会收到一封验证邮件，请您查看Email完成验证。',
		
    }
}

$('body').append('<a href="#" id="changeLanguage" data-i18n="language" style="position:absolute; top:0px; right:10px; z-index:10"></a>')

const languagel = localStorage.getItem('language') || navigator.language || (navigator.languages && navigator.languages[0]) || navigator.userLanguage || navigator.browserLanguage || 'zh-CN';
console.log(languagel);
const language = languagel.toLowerCase().split(/[_-]+/)[0];
const i18n=i18n_data[language];

$('[data-i18n]').each(function (x) {
    $(this).html(i18n[$(this).attr('data-i18n')]);
});
$('[placeholder]').each(function (x) {
    $(this).attr('placeholder', i18n[$(this).attr('placeholder')]);
});

$('#changeLanguage').click(function () {
    localStorage.setItem('language', i18n['l']);
    window.history.go(0);
});

export{language,i18n_data,i18n}