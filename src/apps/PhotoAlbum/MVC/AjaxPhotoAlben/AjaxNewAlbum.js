$('#newPhotoAlbum').on("submit", function (event) {
    event.preventDefault();
    console.log($(this).serialize());
    $.ajax({
        type: 'POST',
        url: '/?App=Alben-newAlbum',
        data: $(this).serialize(),
    })
        .done(function (data) {
            $('#relPhotoAlben').html(data)
        })
        .fail(function () {
            console.log("FEHLSCHLAG");
        })
})

