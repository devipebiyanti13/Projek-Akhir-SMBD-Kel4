<?php

session_start();

require_once "function.php";

if (isset($_POST["login"])) {

    $login = login_akun();

} else if (isset($_POST["register"])) {

    $register = register_akun();

    echo $register > 0

        ? "<script>

            alert('Berhasil Registrasi!');

            location.href = 'login.php';

        </script>"

        : "<script>

            alert('Gagal Registrasi!');

            location.href = 'login.php';

        </script>";

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./src/css/bootstrap-5.2.0/css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">

    <title>Login</title>

    <style>
         body {
            background-image: url('src/img/background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            height: 550px;
            padding: 40px;
            max-width: 500px;
            margin-top: 50px;
        }

        #judul-form {
            font-family: 'Quicksand', sans-serif;
            font-weight: 800;
            color: #333;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }

        .btn-primary, .btn-outline-primary {
            width: 190px;
            border-radius: 20px;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            margin-right: 20px;
            margin-left: 20px;
        }

        .btn-outline-primary {
            border-color: #007bff;
            color: #007bff;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
        }

        .form-control {
            border-radius: 20px;
            padding: 10px 15px;
            margin-bottom: 15px;
        }

        .alert {
            border-radius: 20px;
        }

        .btn-close {
            float: right;
        }

        .d-flex.justify-content-center {
            margin-top: 20px;
        }
    </style>

</head>

<body>

    <div class="container">

        <div id="judul-form" class="text-center h1 mt-3 mb-3">LOGIN</div>

        <div class="mx-auto rounded p-5" style="background-color: transparent;">

            <!-- Tab Login & Register -->

            <div class="d-flex justify-content-between mb-3">

                <button id="tab-login" class="btn btn-primary">LOGIN</button>

                <button class="btn btn-outline-primary">REGISTER</button>

            </div>

            <!-- Jika Username & Password Login Salah -->

            <?php if (isset($_POST["login"])) {

                    if (!$login) { ?>

                    <div class="alert alert-danger alert-dismissible">

                        * username/password salah

                        <button class="btn-close" data-bs-dismiss="alert"></button>

                    </div>

            <?php }

            } ?>

            <!-- Form Login & Register -->

            <form id="form" action="login.php" method="POST">

                <input class="form-control mx-auto d-block" type="text" autocomplete="off" name="username" placeholder="Username" required><br>

                <input class="form-control mx-auto d-block" type="password" autocomplete="off" name="password" placeholder="Password" required><br>

                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary" name="login">Login</button>
                </div>

            </form>

        </div>

    </div>

    <script src="./src/css/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>

    <script src="./src/js/login.js"></script>

</body>

</html>
