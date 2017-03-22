import $ from 'jquery';
export var i18n = {
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

        '0': 'Please use a correct E-Mail address.',
        '1': 'User name can not be empty.',
        '2': 'You can not use this username.',
        '3': 'You can use this password.',
        '4': 'Password is too long.',
        '5': 'Password is too long.',
        '6': 'Password is correct.',
        '7': 'Incorrect password.',
        '8': 'The E-Mail has been sent.',

        '9':'Incorrect user name or password.',
        '10':'E-Mail address can not be blank.',
        '11':'User name can not be blank.',
        '12':'Password can not be blank',
        '13':'Please input your password again.',
        '14':'Please use a correct E-Mail address.',
        '15':'This E-Mail address has been token.',
        '16':'You can use this E-mail address.',
        '17':'This user name has been token.',
        '18':'You can use this user name.',
        '19':'Password is not correct.',
        '20':'User does not exisit.',
        '21':'Incorrect password.',

        'reset-password':'Reset Password',
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

        '0': '请填写正确的邮箱地址',
        '1': '不能为空',
        '2': '用户名不合法',
        '3': '密码可以使用',
        '4': '密码过长',
        '5': '密码过短',
        '6': '密码一致',
        '7': '密码不一致',
        '8': '邮件已发送',

        '9':'用户或密码错误',
        '10':'邮箱地址不能为空',
        '11':'用户名不能为空',
        '12':'密码不能为空',
        '13':'确认密码不能为空',
        '14':'邮箱格式错误',
        '15':'该邮箱已被注册',
        '16':'邮箱可以使用',
        '17':'该用户名已被注册',
        '18':'用户名可以使用',
        '19':'密码不一致',
        '20':'用户不存在',
        '21':'密码不正确',

        '22':'邮件已发送,请去往邮箱验证账号',
        '23':'账号激活成功',

        'reset-password':'重设密码',
    }
}

$('body').append('<a href="#" id="changeLanguage" data-i18n="language" style="position:absolute; top:0px; right:10px; z-index:10"></a>')

const languagel = localStorage.getItem('language') || navigator.language || (navigator.languages && navigator.languages[0]) || navigator.userLanguage || navigator.browserLanguage || 'zh-CN';
console.log(languagel);
const language = languagel.toLowerCase().split(/[_-]+/)[0];

console.log($('[data-i18n]').attr('data-i18n'));
$('[data-i18n]').each(function (x) {
    $(this).html(i18n[language][$(this).attr('data-i18n')]);
});
$('[placeholder]').each(function (x) {
    $(this).attr('placeholder', i18n[language][$(this).attr('placeholder')]);
});

$('#changeLanguage').click(function () {
    localStorage.setItem('language', i18n[language]['l']);
    window.history.go(0);
});