<!doctype html>
<html lang="en">

<head>

    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="lato.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

</head>

<body>
    <div class="container" style="margin-top: 100px;">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <div class="img">
                        <img src="bg-1.png" class="rounded-circle shadow" width="85%" style="margin-left: 40px; margin-top:10px;">
                    </div>
                    <div class=" login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">Sign In</h3>
                            </div>
                        </div>
                        <form action="login_process.php" class="signin-form" method="post">
                            <div class="form-group mb-3">
                                <label class="label" for="username">Username</label>
                                <input id="username" name="username" type="text" class="form-control" placeholder="Username" autocomplete="off">
                            </div>
                            <div class=" form-group mb-3">
                                <label class="label" for="password">Password</label>
                                <input id="password" name="password" type="password" class="form-control" placeholder="Password" autocomplete="off">
                            </div>
                            <div class=" form-group">
                                <button type="submit" value="login" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="jquery.min.js"></script>
    <script src="popper.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="main.js"></script>

</body>

</html>