import $ from 'jquery';
import './background';
import 'bootstrap/dist/css/bootstrap.css'

$("#activate").click(() => {
    $.ajax({
        url: url,
        data: {},
        dataType: 'json'
    }).done(function (x) {
        $("#text").addclass(x.css).html(x.text);
    });
});