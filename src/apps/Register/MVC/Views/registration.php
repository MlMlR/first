
<div class="container col col-6">
    <h1>Sign in</h1>
    <br>
    <form method="post">
        <div class="row">
            <div class="form-group col col-6">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email"  name="email" placeholder="email" required>
            </div>
            <div class="form-group col col-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="stayin" name="stayin" value="checked">
            <label class="form-check-label" for="stayin">stay logged in</label>
        </div>
        <br>
        <button type="submit" class="btn btn-danger" name="submitLogin" value="submitLogin" >Login</button>
        <p style="color: crimson"><?php echo $wrongPassword;?></p>
    </form>
</div>


<br>

<div class="container col col-6">
    <h1>Sign up</h1>
    <br>
    <form method="post">
        <div class="row">
            <div class="form-group col col-6"  >
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName"  name="firstName" placeholder="First Name" required>
            </div>
            <div class="form-group col col-6">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName"  name="lastName" placeholder="Last Name" required>
            </div>
            <div class="form-group col col-6">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username"  name="username" placeholder="Username" required>
            </div>
            <div class="form-group col col-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email"  name="email" placeholder="email" required>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-danger" name="submitRegistration" value="submitRegistration" >Sign up</button>
        <p style="color: crimson"><?php echo $fail;?></p>
    </form>
</div>
