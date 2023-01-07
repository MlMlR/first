<div class="container col col-12">
    <br>
    <br>
    <h1>Users</h1>
    <br>
    <div class="username-container">
        <?php foreach ($users AS $user):?>
            <a href="/?App=User&userid=<?php echo $user->userid; ?>"><h3><?php echo $user->username; ?></h3></a>
        <?php endforeach;?>
    </div>
</div>