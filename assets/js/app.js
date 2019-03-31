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
        let search = $(this).val();
        $.ajax({
            method: 'GET',
            url: '/admin/search-ajax-result',
            data: {search: search},
            dataType: 'json',
            success: function (data)
            {   console.log(data);
                if(data == null || data == '' || data == undefined) {
                    $('.result').html('<h3>aucun résultat</h3>');
                } else {
                    $('.result').empty();
                    var articles = [];
                    for(var i = 0; i < data.length; i++) {
                        articles.push(data[i]);
                        var title         = articles[i].title;
                        var description   = articles[i].description;
                        var date          = articles[i].createdAt.date;
                        var id            = articles[i].id;

                    }
                    console.log(date);
                    var html = '';
                    for (i = 0; i < articles.length; i++) {
                        html += '<h1>'+id+'</h1> <h3>'+title+'</h3> <p>'+description+'</p> <span>'+date+'</span>';
                    }
                    $('.result').html(html);
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    });



});


