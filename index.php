<?php 

use App\core\Session;

Session::init();

if (isset($_GET['logout'])) {
    Session::destroy();
    header("Location: login.php");
    exit;
}


