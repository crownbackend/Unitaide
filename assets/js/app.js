require('../css/app.css');

var $ = require('jquery');

var Turbolinks = require("turbolinks");
Turbolinks.start();

$(document).ready(function () {
    $('#article_tags').tagsInput();
});


