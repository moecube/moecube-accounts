import $ from 'jquery';
import './background';
import 'bootstrap/dist/css/bootstrap.css'

import {i18n} from './i18n.js';
import {php_url} from './config.js';

$("#form").submit(function (event) {
    event.preventDefault();
    const urlParams = new URL(location).searchParams;
    const user_id = urlParams.get('user_id');
    const key = urlParams.get('key');
    const url=new URL('reset_password.php',php_url);
    $.ajax({
        type: "POST",
        url: url,
        data: {
            "password": $("#inputPassword").val(),
            "user_id": user_id,
            "key": key
        }
    })
        .done(data => {
            alert("修改成功");
        })
        .fail(() => {
            alert("修改失败");
        })
});

$('#password').change(function () {
    let str = this.value;
    let reg = /^.{8}/;
    let ok = str.match(reg);
    if (ok) {
        let reg = /^.{8,24}$/;
        let ok = str.match(reg);
        if (ok) {
            //console.log('密码可以使用');
            $('#password_ok').attr('class', 'green').html('密码可以使用');
        } else {
            //console.log('密码过长');
            $('#password_ok').attr('class', 'red').html('密码过长');
        }
    } else {
        //console.log('密码过短');
        $('#password_ok').attr('class', 'red').html('密码过短');
    }
    if (str == $('#password2').val()) {
        //console.log('密码不一致');
        $('#password2_ok').attr('class', 'green').html('密码一致');
    } else {
        $('#password2_ok').attr('class', 'red').html('密码不一致');
    }
});

$('#password2').change(function () {
    let str = this.value;
    if (str == $('#password').val()) {
        $('#password2_ok').attr('class', 'green').html('密码一致');
    } else {
        $('#password2_ok').attr('class', 'red').html('密码不一致');
    }
});
console.log('reset_password');