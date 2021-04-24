require('./bootstrap');

$(document).ready(function () {
    $(".delSoft").click(function () {
        return confirm("Daten wirklich löschen");
    });
});
