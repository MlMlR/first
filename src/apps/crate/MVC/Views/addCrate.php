<br>
<br>
<div class="container col col-12">
    <h1>add crate</h1>
    <br>
    <form method="post">
        <div class="row">
            <div class="form-group col col-12 mt-4">
                <label for="code">code</label>
                <input type="text" class="form-control" id="code"  name="code" placeholder="code" required>
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
                <label for="position">type</label>
                <select class="form-control" type="text"  id="position" name="position" >
                    <option>Dürrenäsch</option>
                    <option>traveling</option>
                    <option>Singapore</option>
                    <option>Helsinki</option>
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
        <button type="submit" class="btn btn-danger" name="submitCast" value="submitCast" >cast</button>
        <p style="color: crimson"><?php echo "fail here";?></p>
    </form>
</div>



<div class="container">
    <h1>Crate Mill</h1>
    <h2>forge crate</h2>
    <form id="forgeMill" method="post">
        <label for="nr">crate</label><br>
        <input type="text" id="nr" name="nr" placeholder="DIDU-060005 3" ><br>
        <label for="type">Type</label><br>
        <select  id="type" name="type" >
            <option>Dry Storage</option>
            <option>ISO Tank</option>
            <option>Open Top</option>
            <option>Special Purpose</option>
        </select><br>
        <label for="size">Size</label><br>
        <input type="number" id="size" name="size" value="33" ><br>
        <label for="position">Position</label><br>
        <select  id="position" name="position" >
            <option>Dürrenäsch</option>
            <option>traveling</option>
            <option>Singapore</option>
            <option>Helsinki</option>
            <option>Mordor</option>
            <option>Gondor</option>
            <option>Arnor</option>
            <option>Eriador</option>
            <option>Belegaer</option>
        </select><hr>
        <input type="submit" value="Submit" name="submit">
    </form>
    <br>
    <a href="/?App=crates" class="btn btn-danger">crates</a>
</div>

