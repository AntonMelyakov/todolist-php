<?php
include('header.php');
?>

<body>
    <div class="container">
        <div class="starter-template">
            <h1 class="text-center">Registration</h1>
            <form action="methods/registration.php" method="post" class="mx-auto mt-4">
                <div class="form-group mt-3">
                    <label for="reg_username">Username:</label>
                    <input class="form-control" type="text" name="reg_username" id="reg_username">
                </div>
                <div class="form-group mt-3">
                    <label for="reg_mail">email:</label>
                    <input class="form-control" type="mail" name="reg_mail" id="reg_mail">
                </div>
                <div class="form-group mt-3">
                    <label for="reg_password">Password:</label>
                    <input class="form-control" type="password" name="reg_password" id="reg_password">
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>

<?php
include('footer.php');
