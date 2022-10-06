$('#AlbumSettingsAjax').on("submit", function(event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: '/?App=AlbumSettings-update',
        data: $(this).serialize(),
    })

})