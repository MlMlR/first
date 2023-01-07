
<div class="container col col-12">
    <br>
    <h1>Wellcome to the crate mill</h1>

    <br>
    <div class="container col col-9">
        <h1>cast a crate</h1>
        <br>
        <form id="castCrate" method="post">
            <div class="row">
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
                    <label for="size">Size</label><br>
                    <input class="form-control" type="text" id="size" name="size" value="33" ><br>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-danger" name="submitCast" value="submitCast" >cast crate</button>
            <p style="color: crimson"><?php echo "$message";?></p>
        </form>
        <a href="/?App=crates" class="btn btn-danger">all crates</a>
    </div>
</div>



