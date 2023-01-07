
<?php foreach ($alben as $album): ?>
    <div class="card col col-4">
        <img style="height: 100px; width: auto; margin: auto; padding: 10px" src="../../../../uploadFiles/<?php echo $album->albumcover; ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?php echo html($album->albumname); ?></h5>
            <p class="card-text"><?php echo html($album->albumdescription); ?></p>
            <a href="/?App=Album&id=<?php echo $album->albumid; ?>" class="btn btn-danger">Zum Album</a>
            <a href="/?App=AlbumSettings&id=<?php echo $album->albumid; ?>" class="btn btn-danger">settings</a>
        </div>
    </div>
<?php endforeach; ?>

<form method="post" id="newPhotoAlbum">
    <input type="hidden" name="albumname" value="albumdame">
    <input type="hidden" name="albumdescription" value="albumdescription">
    <button type="submit" class="btn-secondary mt-4" name="newAlbum" value="newAlbum">New Album</button>
</form>

<script src="../../../../apps/PhotoAlbum/MVC/AjaxPhotoAlben/AjaxNewAlbum.js"></script>