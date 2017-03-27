import $ from 'jquery';
import 'bootstrap/dist/css/bootstrap.css'

import { i18n } from './i18n.js';
import { php_url } from './config.js';
import 'url-api-polyfill'


var imgfile;
const id = new URL(window.location).searchParams.get('id');

function Preview(f, imgSrc) {
    document.getElementById(imgSrc).src = window.URL.createObjectURL(f.files[0]);
}

let $id = $('[name="id"]');

let $form1 = $('#form-update_user_info');
let $avatar = $form1.find('[name="avatar"]');
let $nickname = $form1.find('[name="name"]');

let $form2 = $('#form-update_user_baseinfo');
let $email = $form2.find('[name="email"]');
let $username = $form2.find('[name="username"]');
let $password = $form2.find('[name="password"]');
let $password2 = $form2.find('[name="password2"]');
let $sub = $form2.find('[name="sub"]');
let $current_password = $form2.find('[name="current_password"]');

let url = new URL("/user.php", php_url);
url.searchParams.set('id', id);
let profiles_url = new URL("/profiles.php", php_url);


var jqxhr = $.ajax({
    url: url,
    data: {},
    dataType: 'json'
})
    .done(function (x) {
        $id.val(x.id);
        $('#cropped').html('<img src="' + x.avatar + '">');
        //$('#cropped').attr('src',x.avatar);
        $email.val(x.email);
        $username.val(x.username);
        $nickname.val(x.name);
        $("[data-html='username']").html(x.username);
        $("[data-html='email']").html(x.email);
    });


(function () {
    $nickname.change(function () {
        $('#but1').removeAttr('disabled');
    });
    $nickname.keyup(function () {
        $('#but1').removeAttr('disabled');
    });
    $form2.find('input').change(function () {
        $('#but2').removeAttr('disabled');
    });
    $form2.find('input').keyup(function () {
        $('#but2').removeAttr('disabled');
    });


    $('#form-update_user_info').submit(function () {
        event.preventDefault();
        var formData = new FormData();
        formData.append('avatar', imgfile);
        formData.append('name', $nickname.val().trim());
        formData.append('id', $id.val());

        $.ajax({
            type: 'post',
            url: profiles_url,
            data: formData,
            //dataType:'json',
            processData: false,
            contentType: false
        }).done(function (x) {
            alert('修改成功');
        }).fail(function (x) {
            try {
                let message = JSON.parse(x.responseText).message;
                message ? alert(message) : alert("修改失败");
            } catch (error) {
                alert("修改失败");
            }
        });
    });

    $('#form-update_user_baseinfo').submit(function () {
        event.preventDefault();
        let id = $id.val().trim();
        let email = $email.val().trim();
        let username = $username.val().trim();
        let password = $password.val();
        let password2 = $password2.val();
        let current_password = $current_password.val();

        if (password != password2) {
            alert('密码不一致');
        } else {
            let reg = /^.{6}/;
            let ok = password.match(reg);
            if (ok || password=='') {
                let reg = /^.{6,32}$/;
                let ok = password.match(reg);
                if (ok || password=='') {
                    //console.log('密码可以使用');
                    $.ajax({
                        type: 'post',
                        url: profiles_url,
                        data: {
                            id: id,
                            email: email,
                            username: username,
                            password: password,
                            current_password: current_password
                        }
                    }).done(function (x) {
                        alert('修改成功');
                    }).fail(function (x) {
                        try {
                            let message = JSON.parse(x.responseText).message;
                            message ? alert(message) : alert("修改失败");
                        } catch (error) {
                            alert("修改失败");
                        }
                    });
                } else {
                    //console.log('密码过长');
                    alert('密码过长');
                }
            } else {
                //console.log('密码过短');
                alert('密码过短');
            }
        }
    })
})();



function init() {
    function keydownFn(e) {
        if (e.which === 13) {
            e.preventDefault();
        }
    }
    $("input").keydown(keydownFn);
}
init();
// ==============================================截图
window.onload = function () {
    var options =
        {
            imageBox: '.imageBox',
            thumbBox: '.thumbBox',
            spinner: '.spinner',
            imgSrc: '',
        }
    var cropper = new cropbox(options);
    document.querySelector('#file').addEventListener('change', function () {
        $('#btnCrop').removeAttr('disabled');
        $('#btnZoomIn').removeAttr('disabled');
        $('#btnZoomOut').removeAttr('disabled');
        var reader = new FileReader();
        reader.onload = function (e) {
            options.imgSrc = e.target.result;
            cropper = new cropbox(options);
        }
        reader.readAsDataURL(this.files[0]);
    })
    document.querySelector('#btnCrop').addEventListener('click', function () {
        $('#but1').removeAttr('disabled');
        var img = cropper.getDataURL();
        imgfile = cropper.getBlob();
        $('#upimg').val(imgfile);
        document.querySelector('#cropped').innerHTML = '<img src="' + img + '">';
    })
    document.querySelector('#btnZoomIn').addEventListener('click', function () {
        cropper.zoomIn();
    })
    document.querySelector('#btnZoomOut').addEventListener('click', function () {
        cropper.zoomOut();
    })

    // $(".takephoto").on("WheelEvent", function () { return false; })

    $('.imageBox').on('mousewheel',function(){
        return false;
    })
};