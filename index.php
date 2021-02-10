<?php
include('header.php');

?>

<body class="index">

  <div class="container login-container">
    <div class="text-center">
        <h3>Login</h3>
        <form action="methods/login.php" method="post" class="mx-auto">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" value=""  name="login_username" id="login_username"/>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Your Password *" value=""  name="login_password" id="login_password"/>
          </div>
          <div class="form-group">
          <button type="submit" class="btn btn-primary">SUBMIT</button>
          </div>
          <div class="form-group">
            <a href="registration.php" class="ForgetPwd">SignUp</a>
          </div>
        </form>
    </div>
</body>

</html>

<?php
include('footer.php');
