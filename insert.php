<?php
require_once "vendor/autoload.php";

use App\account\Login;
use App\Account\Signup;

if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password'])) {
    $login = new Login();
   
    $loginData=$login->authenticate($_POST['email'], $_POST['password']);

    if ($loginData) {
        header("Location: home");
        exit;
    }
    header("Location: login.php?invalid=1&userEmail&userPassword");
    exit;
}

if (isset($_POST['signup']) && isset($_POST['email']) && isset($_POST['password'])) {
    // Sanitize & fetch inputs
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $name = trim($_POST['name'] ?? '');
    $dob = $_POST['dob'] ?? '';
    $profilePic = $_FILES['profile_pic'] ?? null; // Uploaded file

    $errors = [];

    // Validations
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters.";
    }
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (!DateTime::createFromFormat('Y-m-d', $dob)) {
        $errors[] = "Invalid date of birth.";
    }
    if ($profilePic && $profilePic['error'] !== UPLOAD_ERR_OK && $profilePic['error'] !== 4) {
        // error 4 means no file uploaded, which can be allowed optionally
        $errors[] = "Error uploading profile picture.";
    }

    if (!empty($errors)) {
        $errorParam = urlencode(implode(", ", $errors));
        header("Location: login.php?error={$errorParam}");
        exit();
    }

    $signup = new Signup();
    $success = $signup->register($name, $dob, $email, $password, $profilePic);
    if ($success['success']) {
        header("Location: home.php");
        exit();
    } else {
        header("Location: login.php?error=Registration failed");
        exit();
    }
}

$url = $_SERVER['HTTP_REFERER'];
header("Location: $url");
exit;