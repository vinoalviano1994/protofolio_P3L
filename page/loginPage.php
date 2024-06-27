<!Doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet" integrit
            y="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous">
        <link href="../style.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/56d4a45cd7.js" crossorigin="anonymous"></script>
        <title>Login Page</title>
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container">
            <!-- Nama : nama panggilan kalian -->
            <a class="navbar-brand fw-bold" href="../index.php">Go Fit - Pusat Kebugaran</a>
        </div>
            </nav>
            <div class="bg bg-light text-dark">
                <div class="container min-vh-100 d-flex align-items-center justify-content-center">
                    <div class="card text-white bg-dark ma-5 shadow" style="min-width:
                        25rem;">
                        <div class="card-header fw-bold">Login</div>
                        <div class="card-body">
                        <form action="../process/loginProcess.php" method="post">
                            <div class="mb-3">
                                <i class="fa-sharp fa-solid fa-envelope"></i>
                                <label for="exampleInputEmail1" class="form-label">Username</label>
                                <input class="form-control" id="ussername" name="ussername"
                                aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                            <i class="fa-sharp fa-solid fa-lock"></i>
                            <label for="exampleInputPassword1" class="form-
                            label">Password</label>
                            <input type="password" class="form-control"
                            id="password" name="password">
                            </div>
                            <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary"
                            name="login">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    </body>
</html>