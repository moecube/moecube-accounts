import $ from 'jquery';
export var i18n = {
    en: {
        'language': '中文',
        'l': 'zh-CN',
        username: 'username',
        email: 'email',
        password: 'password',
        'user-info': 'user-info',
        'reset-info': 'reset info',
        avatar: 'avatar',
        nickname: 'nickname',
        'reset-account-info': 'Reset account info',
        'current_password': 'current_password',
        'password-again': 'Password Again',
        'save': 'save',
        'nickname': 'nickname[optional]',
        'crop': 'crop',
        'moecube': 'moecube',
        'index-leftbox1': 'you can use these account to sign in',
        'yonghuan': 'yonghuan',
        'please-sign-up': 'Please sign up',
        'please-sign-in': 'Please sign in',
        'please-sign-up': 'Please sign up',

        'email-address-or-username': 'Email address Or Username',
        'sign-up': 'Sign Up',
        'sign-in': 'Sign In',
        'forgot-password': 'Forgot Password',
        'sell-email': 'Sell Email',

        '0': '请填写正确的邮箱地址',
        '1': '不能为空',
        '2': '用户名不合法',
        '3': '密码可以使用',
        '4': '密码过长',
        '5': '密码过短',
        '6': '密码一致',
        '7': '密码不一致',
        '8': '邮件已发送',
    },
    zh: {
        'language': 'english',
        'l': 'en-US',
        username: '用户名',
        email: '邮箱',
        password: '密码',
        'user-info': '用户信息',
        'reset-info': '修改信息',
        avatar: '头像',
        nickname: '昵称',
        'reset-account-info': '修改账户信息',
        'current_password': '原密码',
        'password-again': '再次输入密码',
        'save': '保存',
        'nickname[optional]': '昵称[选填]',
        'crop': '截图',
        'moecube': '萌立方',
        'index-leftbox1': '您可使用以下几种账号登陆',
        'yonghuan': '永幻',
        'please-sign-up': '注册',
        'please-sign-in': '登陆',
        'forgot-password': '忘记密码',

        'email-address-or-username': '邮箱或用户名',
        'sign-up': '注册',
        'sign-in': '登陆',
        'forgot-password': '忘记密码',
        'sell-email': '发送邮件',

        '0': '请填写正确的邮箱地址',
        '1': '不能为空',
        '2': '用户名不合法',
        '3': '密码可以使用',
        '4': '密码过长',
        '5': '密码过短',
        '6': '密码一致',
        '7': '密码不一致',
        '8': '邮件已发送',
    }
}

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