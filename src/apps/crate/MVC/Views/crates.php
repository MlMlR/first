
<br>
<br>

<div class="container">
    <h1>Crates</h1>
    <br>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">crate</th>
            <th scope="col">type</th>
            <th scope="col">size</th>
            <th scope="col">owner</th>
            <th scope="col">position</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($crates as $crate): ?>
            <tr>
            <th scope="row"><?php echo $crate->code; ?></th>
            <td><?php echo $crate->type; ?></td>
            <td><?php echo $crate->size; ?></td>
            <td><?php echo $crate->owner; ?></td>
            <td><?php echo $crate->position; ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <div class="row align-items-start">
        <?php foreach ($crates as $crate): ?>
        <div class="col col-3 mt-4">
            <div class="card">
                <img style="width: 100px; margin: auto; padding: 10px" src="../../../../style/Media/<?php echo $crate->type; ?>.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h2 class="card-title"><?php echo $crate->code; ?></h2>
                    <p class="card-text"><?php echo $crate->type; ?></p>
                    <p class="card-text"><?php echo $crate->size; ?> feet</p>
                    <p class="card-text">belongs to</p>
                    <p class="card-text"><?php echo $crate->owner; ?></p>
                    <p class="card-text">is currently</p>
                    <p class="card-text"><?php echo $crate->position; ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <hr>
    <a href="/?App=crateMill" class="btn btn-danger">to the Mill</a>
</div>

<br>
<br>
<div class="container col col-6">
    <h1>add your crate</h1>
    <br>
    <form id="addCrate" method="post">
        <div class="row">
            <div class="form-group col col-12 mt-4">
                <label for="code">code</label>
                <input type="text" class="form-control" id="code"  name="code" placeholder="DIDU-060005 3" required>
            </div>
            <div class="form-group col col-12 mt-4">
                <label for="owner">owner</label>
                <input type="text" class="form-control" id="owner"  name="owner" placeholder="owner" required>
            </div>
            <div class="form-group col col-12 mt-4">
                <label for="type">type</label>
                <select class="form-control" type="text"  id="type" name="type" >
                    <option>Dry Storage</option>
                    <option>ISO Tank</option>
                    <option>Open Top</option>
                    <option>Special Purpose</option>
                </select>
            </div>
            <div class="form-group col col-12 mt-4">
                <label for="position">position</label>
                <select class="form-control" type="text"  id="position" name="position" >
                    <option>traveling</option>
                    <option>Singapore</option>
                    <option>Helsinki</option>
                    <option>Dürrenäsch</option>
                    <option>Mordor</option>
                    <option>Gondor</option>
                    <option>Arnor</option>
                    <option>Eriador</option>
                    <option>Belegaer</option>
                </select>
            </div>
            <div class="form-group col col-12 mt-4">
                <label for="size">Size</label><br>
                <input class="form-control" type="text" id="size" name="size" value="33" ><br>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-danger" name="submitCreate" value="submitCreate" >add crate</button>
        <p style="color: crimson"><?php echo $message;?></p>
    </form>
</div>