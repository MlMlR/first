<div class="container col col-12">
<br>
    <h1>Photo Alben</h1>
    <br>
    <br>

    <div class="container">
        <div class="container row">

            <?php foreach ($alben as $album): ?>
                <div class="card col col-4">
                    <img style="width: 100px; margin: auto; padding: 10px" src="../../../../style/Media/PngItem_330111.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $album->albumname; ?></h5>
                        <p class="card-text"><?php echo $album->albumdescription; ?></p>
                        <a href=""/?App=Album&id=<?php echo $album->albumid; ?>" class="btn btn-danger">Zum Album</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<br>
<br>
