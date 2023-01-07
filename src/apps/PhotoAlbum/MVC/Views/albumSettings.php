<div class="container col col-10">
    <br>
    <h1><?php echo $album->albumname; ?> Settings!</h1>
    <br>
    <br>
    <div class="container col col-10">
        <form method="post" id="AlbumSettingsAjax">

            <?php require_once __DIR__ . "/../../../../apps/PhotoAlbum/MVC/Views/AjaxAlbumSettingsForm.php"?>

            <input type="hidden" name="albumid" value="<?php echo $album->albumid; ?>">
            <button type="submit" class="btn btn-secondary" name="send" value="send">save</button>
        </form>
    </div>
</div>
<br>
<div class="container col col-10">
    <form method="post" id="albumcover-form" enctype="multipart/form-data">
        <label for="albumcover-settings" class="form-label">Albumcover</label>
        <input type="hidden" name="albumid" value="<?php echo $_GET['albumid'] ?>">
        <input class="form-control" name="albumcover" id="albumcover-settings" type="file" accept="image/*">
        <br>
        <button class="btn btn-secondary" type="submit" name="save" value="send">save</button>
    </form>
    <br>
    <p><?php echo $error; ?></p>
    <a href="/?App=PhotoAlbums"><button class="btn btn-secondary">back</button></a>
</div>

<br>
<br>


<script src="../../../../apps/PhotoAlbum/MVC/AjaxPhotoAlben/AjaxAlbumSettings.js"></script>