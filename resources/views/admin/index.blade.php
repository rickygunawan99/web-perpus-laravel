<?php

require_once "../core/auth.php";

if (!check_auth()) {
    header("Location: ./login.blade.php");
} else {
    header("Location: ./dashboard.blade.php");
}
