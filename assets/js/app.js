require('../css/app.css');

var $ = require('jquery');

var Turbolinks = require("turbolinks");
Turbolinks.start();

$(document).ready(function () {
    // idea-box
    $('.test').on('click', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        let idea = $(this).attr('id');
        let id = $('#'+idea).children('input').val();
        $.ajax({
            method: 'GET',
            url: '/admin/idea-box/show/'+id,
            data: $(this).serialize(),
            dataType: 'json',
            success: function (data) {
                $('#name').html(data.name);
                $('#email').html(data.email);
                $('#telephone').html(data.telephone);
                $('#content').html(data.idea);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    // search
    $('#search-ajax').keyup(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        let res = $(this).val();
        $.ajax({
            method: 'GET',
            url: '/admin/search-ajax-result',
            data: {search: res},
            dataType: 'json',
            success: function (data) {
                for(var i = 0; i < data.length; i++) {
                    var article       = data[i];
                    var title         = article.title;
                    var description   = article.description;
                    $('.result').html('<h3>'+title+'</h3> <p>'+description+'</p>');
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});


