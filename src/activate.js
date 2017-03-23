import $ from 'jquery';
import 'bootstrap/dist/css/bootstrap.css'
import {php_url} from './config.js';

const url = new URL(window.location)
const key = url.searchParams.get("key")
 
const post_url=new URL('activate.php',php_url);
let activate = $('#activate');


activate.click(() => {
    $.ajax({
        type: 'POST',
        url: post_url,
        data: {key},
        dataType: 'json'
    }).done(function (x) {
        activate.attr('class','hidden');
        $("#text").attr('class','green').html('邮箱验证成功');
    }).fail(function (x){
        console.log(activate);
        activate.attr('class','hidden');
        $("#text").attr('class','red').html('邮箱验证失败');
    });
});