<?php

require_once "../core/auth.php";
require_once "../core/db.php";

if (check_auth()) {
    header("Location: ./dashboard.blade.php");
}


if (isset($_POST["submit-login"])) {
    $nip = $_POST["nip"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM admin WHERE nip = '{$nip}' AND password = '{$password}'";

    $res = query($sql);

    if ($res->num_rows > 0) {
        $admin = $res->fetch_assoc();
        auth($admin);
        header("Location: ./dashboard.blade.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <?php require_once("./partials/style-part.blade.php") ?>

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: -webkit-box;
            display: flex;
            -ms-flex-align: center;
            -ms-flex-pack: center;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 500px;
            padding: 15px;
            margin: 0 auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>


    <title>Admin</title>
</head>

<body class="text-center">

    <div class="container">
        <form class="form-signin" method="POST" action="">
            <img class="mb-1" src="http://localhost:8080/pemrog-web/Web-Dev\assets\images\login-admin.png" alt="" width="350" height="350">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="inputNIP" class="sr-only mt-3">NIP</label>
            <input type="text" id="inputNIP" name="nip" class="form-control" placeholder="NIP" required autofocus>

            <label for="inputPassword" class="sr-only mt-4">Password</label>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>

            <button class="btn btn-lg btn-primary btn-block mt-2" type="submit" name="submit-login">Masuk</button>
        </form>
    </div>

</body>
<?php require_once("./partials/script-part.blade.php") ?>

</html>
