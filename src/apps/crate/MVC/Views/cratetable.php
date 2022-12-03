<h1>Crates</h1>
<br>


<table class="table table-striped table-hover">
    <thead style="background-color: #322D31; color: cornsilk;">
    <tr>
        <th scope="col">crate</th>
        <th scope="col">type</th>
        <th scope="col">size</th>
        <th scope="col">owner</th>
        <th scope="col">position</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($crates as $crate):?>
        <tr>
            <th scope="row"><?php echo $crate->code; ?></th>
            <td>
                <div  contenteditable="true" onblur="updateValue(this, 'type', '<?php echo $crate->code; ?>')" ondblclick="activate()">
                    <?php echo $crate->type; ?>
                </div>
            </td>
            <td>
                <div  contenteditable="true" onblur="updateValue(this, 'size', '<?php echo $crate->code; ?>')" ondblclick="activate()">
                    <?php echo $crate->size; ?>
                </div>
            </td>
            <td>
                <div  contenteditable="true" onblur="updateValue(this, 'owner', '<?php echo $crate->code; ?>')" ondblclick="activate()">
                    <?php echo $crate->owner; ?>
                </div>
            </td>
            <td>
                <div  contenteditable="true" onblur="updateValue(this, 'position', '<?php echo $crate->code; ?>')" ondblclick="activate()">
                    <?php echo $crate->position; ?>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

