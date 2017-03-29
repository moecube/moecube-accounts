import $ from "jquery";
import "./background";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap/dist/js/bootstrap.js";
import {php_url} from "./config.js";
import "url-api-polyfill";
import "core-js";
import * as crypto from "crypto";
import { i18n} from './i18n.js';

console.log(php_url);
const url = new URL(window.location)

let sso
let ssoString = url.searchParams.get('sso')

if (ssoString) {
    sso = new URLSearchParams(Buffer.from(ssoString, 'base64').toString())
}
let sign_up_url = new URL('sign_up.php', php_url);
let sign_in_url = new URL('sign_in.php', php_url);
let forgot_password_url = new URL('forgot_password.php', php_url);
let profiles_url = new URL('profiles.php', php_url);

$(".signUpBtn").click(showSignUp)
$(".signInBtn").click(showSignIn)
$(".forGotBtn").click(showForgot)

// =======================切换表单===================
function showSignUp() {
    $("#form-signup").removeClass('hidden');
    $("#form-signin").addClass('hidden');
    $("#form-forgot").addClass('hidden');
    console.log('showSignUp');
}
function showSignIn() {
    $("#form-signup").addClass('hidden');
    $("#form-signin").removeClass('hidden');
    $("#form-forgot").addClass('hidden');
    console.log('showSignIn');
}
function showForgot() {
    $("#form-signup").addClass('hidden');
    $("#form-signin").addClass('hidden');
    $("#form-forgot").removeClass('hidden');
    console.log('showForgot');
}

$(document).ready(function () {
    // ==========================注册事件====================== 
    (function () {
        let $form = $('#form-signup');
        let $email = $form.find('[name="email"]');
        let $username = $form.find('[name="username"]');
        let $password = $form.find('[name="password"]');
        let $password2 = $form.find('[name="password2"]');
        let $sub = $form.find('[name="sub"]');

        let $email_ok = $form.find('[data-ok="email_ok"]');
        let $username_ok = $form.find('[data-ok="username_ok"]');
        let $password_ok = $form.find('[data-ok="password_ok"]');
        let $password2_ok = $form.find('[data-ok="password2_ok"]');

        let email_ok = true;
        let username_ok = true;
        let password_ok = true;
        let password2_ok = true;

        let email_change = function () {
            let email = this.value;
            let reg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
            let ok = email.match(reg);
            if (ok) {
                console.log('邮箱格式正确');

                $.ajax({
                    type: "POST",
                    url: sign_up_url,
                    data: {"email": email},
                    dataType: "json",
                }).done(function (x) {
                    email_ok = x.email.class == 'green' ? true : false;
                    $email_ok.attr('class', x.email.class).html(x.email.html);
                })
            }
            else {
                console.log('请填写正确的邮箱地址');
                email_ok = false;
                $email_ok.attr('class', 'red').html(i18n['Please use a correct E-Mail address.']);
            }
            ;
        }
        let username_change = function () {
            let str = this.value;
            let username = str;
            let reg = /^[A-Za-z0-9_\u4E00-\u9FD5\u3400-\u4DBF\u{20000}-\u{2A6DF}\u{2A700}-\u{2CEAF}\uF900–\uFAFF\u{2F800}-\u{2FA1D}\uAC00–\uD7AF\u3040-\u30FF\u31F0–\u31FF\u{1B000}–\u{1B0FF}\u3005]+$/u;

            let ok = str.match(reg);

            if (ok) {
                $.ajax({
                    type: "POST",
                    url: sign_up_url,
                    data: {"username": str},
                    dataType: "json",
                }).done(function (x) {
                    username_ok = x.username.class == 'green' ? true : false;
                    $username_ok.attr('class', x.username.class).html(x.username.html);
                })
            } else {
                username_ok = false;
                $username_ok.attr('class', 'red').html(i18n['You can not use this username.']);
            }
        }
        let password_change = function () {
            let password = this.value;
            let password2 = $password2.val();
            let reg = /^.{6}/;
            let ok = password.match(reg);
            if (ok) {
                let reg = /^.{6,24}$/;
                let ok = password.match(reg);
                if (ok) {
                    //console.log('密码可以使用');
                    password_ok = true;
                    $password_ok.attr('class', 'green').html(i18n['You can use this password.']);
                } else {
                    //console.log('密码过长');
                    password_ok = false;
                    $password_ok.attr('class', 'red').html(i18n['Password is too long.']);
                }
            } else {
                //console.log('密码过短');
                password_ok = false;
                $password_ok.attr('class', 'red').html(i18n['Password is too short.']);
            }
            if (password == password2) {
                //console.log('密码不一致');
                password2_ok = false;
                $password2_ok.attr('class', 'green').html(i18n['Password is correct.']);
            } else {
                password2_ok = false;
                $password2_ok.attr('class', 'red').html(i18n['Incorrect password.']);
            }
        }
        let password2_change = function () {
            let password2 = this.value;
            let password = $password.val();
            if (password2 == password) {
                console.log('密码一致');
                password2_ok = true;
                $password2_ok.attr('class', 'green').html(i18n['Password is correct.']);
            } else {
                console.log('密码不一致');
                password2_ok = false;
                $password2_ok.attr('class', 'red').html(i18n['Incorrect password.']);
            }
        }

        $email.on('input',email_change);
        $username.on('input',username_change);
        $password.on('input',password_change);
        $password2.on('input',password2_change);

        $form.submit(function (event) {
            event.preventDefault()
            let empty = false;
            let email = $email.val().trim();
            let username = $username.val().trim();
            let password = $password.val();
            let password2 = $password2.val();

            if (email == "") {
                $email_ok.attr('class', 'red').html(i18n['E-Mail address can not be blank.']);
                empty = true;
            }
            if (username == "") {
                $username_ok.attr('class', 'red').html(i18n['User name can not be blank.']);
                empty = true;
            }
            if (password == "") {
                $password_ok.attr('class', 'red').html(i18n['Password can not be blank.']);
                empty = true;
            }
            if (password2 == "") {
                $password2_ok.attr('class', 'red').html(i18n['Please input your password again.']);
                empty = true;
            }

            if (!empty && email_ok && username_ok && password_ok && password2_ok) {
                $.ajax({
                    type: "POST",
                    url: sign_up_url,
                    data: {
                        "email": email,
                        "username": username,
                        "password": password,
                        "password2": password2,
                        "submit": true
                    },
                    dataType: "json",

                }).done(function (x) {
                    if (typeof x.success == "boolean") {
                        alert(i18n['Your account has been created.']);
                        showSignIn();
                        return;
                    }
                    x.email && $email_ok.attr('class', x.email.class).html(x.email.html);
                    x.username && $username_ok.attr('class', x.username.class).html(x.username.html);
                    x.password && $password_ok.attr('class', x.password.class).html(x.password.html);
                    x.password2 && $password2_ok.attr('class', x.password2.class).html(x.password2.html);
                }).fail(function () {
                    alert(i18n['Please check your registration info again.']);
                })
            } else {
                alert(i18n['Please check your registration info again.']);
            }
        });

    })();
    // ==========================登陆事件======================
    (function () {
        let $form = $('#form-signin');
        let $emailOrUsername = $form.find('[name="emailOrUsername"]');
        let $password = $form.find('[name="password"]');

        let $old_email = $("#old_email");
        let $new_email = $("#new_email");
        let $reset_email = $("#reset_email");
        let $send_activate_email = $("#send_activate_email");
        let $id = $("#id");
        let $new_email_ok = $("#new_email_ok");
        let $form_reset_email=$("#form-reset_email");
        let $myModal=$('#myModal');

        $new_email.on('input', () => {
            if ($new_email.val()) {
                $reset_email.prop('disabled', '')
            } else {
                $reset_email.prop('disabled', 'disabled')
            }
        })

        $form.submit(function (event) {
            event.preventDefault()
            let emailOrUsername = $emailOrUsername.val().trim();
            let password = $password.val();
            $.ajax({
                type: "POST",
                url: sign_in_url,
                data: {
                    "emailOrUsername": emailOrUsername,
                    "password": password,
                }
            }).done(function (x) {
                let url;
                if (!x.active) {
                    $old_email.val(x.email);
                    $id.val(x.id);
                    $myModal.modal('show');
                    return;
                }
                if (sso) {
                    let params = new URLSearchParams()
                    url = new URL(sso.get("return_sso_url"));

                    for (let [key, value] of Object.entries(x)) {
                        params.set(key, value)
                    }
                    params.set("return_sso_url", sso.get("return_sso_url"))
                    params.set("nonce", sso.get("nonce"))
                    let payload = Buffer.from(params.toString()).toString('base64')

                    url.searchParams.set("sso", payload)
                    url.searchParams.set('sig', crypto.createHmac('sha256', 'zsZv6LXHDwwtUAGa').update(payload).digest('hex'))

                } else {
                    url = new URL('userinfo.html', location)
                    url.searchParams.set('id', x["external_id"]);
                }
                location.href = url
            }).fail(function (x) {
                console.log(x);
                alert(JSON.parse(x.responseText).message);
            });
        });

        $form_reset_email.submit(function () {
            let id = $id.val();
            let password = $password.val();
            let new_email = $new_email.val();

            let reg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
            let ok = new_email.match(reg);

            if (!ok) {
                $('#new_email_ok').css('red').html(i18n['Please use a correct E-Mail address.']);
                return;
            }

            $('#new_email_ok').html('');
            $.ajax({
                type: "POST",
                url: profiles_url,
                data: {
                    "id": id,
                    "current_password": password,
                    "email": new_email,
                }
            }).done(function (x) {
                alert(i18n['Your email has been updated.']);
                $myModal.modal('hide');
            }).fail(function (x) {
                try {
                    let message = JSON.parse(x.responseText).message;
                    message ? alert(message) : alert(i18n["Error"]);
                } catch (error) {
                    alert(i18n["Error"]);
                }
            });
        })

        $send_activate_email.click(function () {
            let id = $id.val();
            let password = $password.val();
            let old_email = $old_email.val();


            $.ajax({
                type: "POST",
                url: profiles_url,
                data: {
                    "id": id,
                    "current_password": password,
                    "email": old_email,
                }
            }).done(function (x) {
                alert(i18n['A verification email has been sent to you.']);
                $myModal.modal('hide');
            }).fail(function (x) {
                try {
                    let message = JSON.parse(x.responseText).message;
                    message ? alert(message) : alert(i18n["Error"]);
                } catch (error) {
                    alert(i18n["Error"]);
                }
            });
        })

    })();
    // ==========================忘记密码事件====================== 
    (function () {
        let $form = $('#form-forgot');
        let $emailOrUsername = $form.find('[name="emailOrUsername"]');
        let $sub=$form.find('[name="sub"]');
        let $time=$form.find('[name="time"]')
        let canSubmit=true;
        let waitTime=0;

        function wait(){
            if(waitTime>0){
                $time.html(waitTime);
                waitTime--;
                setTimeout(wait,1000);
            }else{
                $time.html('');
                canSubmit=true;
                $sub.removeAttr('disabled');
            }
        }
        $form.submit(function (event) {
            if(!canSubmit)
                return;
            canSubmit=false;
            $sub.attr('disabled','');
            waitTime=30;
            wait();
            event.preventDefault()
            let emailOrUsername = $emailOrUsername.val().trim();
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: forgot_password_url,
                data: {
                    "emailOrUsername": emailOrUsername
                },
                success: function (x) {
                    showSignIn();
                    alert(i18n['A password reset email has been sent to you.']);
                    // const {message} = x
                    // message ? alert(message) : alert("出问题了");
                },
                error: function (x) {
                    console.log(x);
                    const {message} = x
                    message ? alert(message) : alert(i18n["error"]);
                    waitTime=0;
                }
            });
        })
    })();
})