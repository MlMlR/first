$('.newAlbumAjaxButton').on("click", function (event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: '/?App=Alben-newAlbum',
        data: {
            userid: $(this).data('userid'),
            albumname: $(this).data('albumname'),
            albumdescription: $(this).data('albumdescription'),
        },
    })
        .done(function (data) {
            $('#relPhotoAlben').html(data)
        })
        .fail(function () {
            console.log("FEHLSCHLAG");
        })
})