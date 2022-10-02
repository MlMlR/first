<div class="container col col-12">
    <br>
    <br>
    <?php
    if (!empty($user)) : ?>
        <h1 >wellcom at <?php echo $user->username ?></h1>
        <br>
        <hr>
    <br>
        <h2><?php echo $user->userid; ?></h2>
        <p><?php echo  $user["firstname"] . " " . $user["lastname"]; ?></p>
        <p><?php echo  $user["mail"]; ?></p>
        <p><?php echo  $user->bio; ?></p>
        <p><?php echo  $user->age; ?></p>

    <?php endif; ?>
</div>
