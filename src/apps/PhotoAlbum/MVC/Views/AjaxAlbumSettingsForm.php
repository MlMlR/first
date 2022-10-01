<div class="mb-3">
    <label for="albumname-settings"
           class="form-label">Album Name
    </label>
    <input type="text"
           class="form-control"
           id="albumname-settings"
           name="albumname"
           value="<?php echo $album->albumname; ?>"
</div>

<div class="mb-3">
    <label for="albumdescription-settings"
           class="form-label">Album description
    </label>
    <textarea class="form-control"
              name="albumdescription"
              id="albumdescription-settings" rows="3">
        <?php echo $album->albumdescription; ?>
    </textarea>
</div>