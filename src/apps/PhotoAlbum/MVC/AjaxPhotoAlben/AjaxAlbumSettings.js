$('#AlbumSettingsAjax').on("submit", function(event) {
    event.preventDefault();
    console.log($(this).serialize());
    $.ajax({
        type: 'POST',
        url: '/?App=AlbumSettings-update',
        data: $(this).serialize(),
    })
        .done(function (data) {
            //$('#AlbumSettingsAjax').html(data)
        })
        .fail(function () {
            console.log("FEHLSCHLAG");
        })
})