<?php

// require_once "C:/xampp/htdocs/pemrog-web/Web-Perpus/core/auth.php";

//if (isset($_POST["logout"])) {
//    logout();
//    header("Location: ./login.blade.php");
//}

?>

<nav class="navbar navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="/admin">ADMIN</a>
        <form action="{{route('admin.logout')}}" method="POST">
            @csrf
            <button name="logout" class="btn text-light" type="submit">Keluar <i class="bi bi-box-arrow-right ps-1"></i></button>
        </form>
    </div>
</nav>
