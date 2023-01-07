<div class="container col col-12">
<br>
    <h1>Photo Alben</h1>
    <br>
    <br>

    <div>
        <button class="btn-danger mb-4 newAlbumAjaxButton"
                data-albumname="Don't look"
                data-albumdescription="I warn you!!"
                data-userid="<?php echo $_SESSION['userid'] ?>">New
        </button>
    </div>
    <div class="container mg">
        <div id="relPhotoAlben" class="container row">
            <?php require_once __DIR__ . "/../../../../apps/PhotoAlbum/MVC/Views/AjaxPhotoAlben.php"?>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<script src="../../../../apps/PhotoAlbum/MVC/AjaxPhotoAlben/AjaxNewAlbumButton.js"></script>