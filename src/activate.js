import $ from 'jquery';
import './background';
import 'bootstrap/dist/css/bootstrap.css'

const url = new URL(window.location)
const key = url.searchParams.get("key")

$("#activate").click(() => {
    $.ajax({
        type: 'POST',
        url: './activate.php',
        data: {key},
        dataType: 'json'
    }).done(function (x) {
        $("#text").addclass(x.css).html(x.text);
    });
});
