<?php

namespace App\Account;
use App\core\Database;
use App\core\Helper;

class Signup
{
    protected $db;
    protected $helper;

    public function __construct()
    {
        $this->db = Database::db();
        $this->helper = new Helper();
    }

    // Validate inputs and register user with profile image upload
    public function register($name, $dob, $email, $password, $file)
    {
        // Basic validations
        if (!$this->helper->validateName($name)) {
            return ['success' => false, 'error' => 'Invalid name'];
        }
        if (!$this->helper->validateDOB($dob)) {
            return ['success' => false, 'error' => 'Invalid date of birth'];
        }
        if (!$this->helper->validateEmail($email)) {
            return ['success' => false, 'error' => 'Invalid email'];
        }
        if ($this->emailExists($email)) {
            return ['success' => false, 'error' => 'Email already exists'];
        }
        if (!$this->helper->validatePassword($password)) {
            return ['success' => false, 'error' => 'Password does not meet criteria'];
        }

        // Handle profile image upload if file provided
        $profilePic = null;
        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            $profilePic = $this->helper->uploadImage($file, 'uploads/profile_pics');
            if (!$profilePic) {
                return ['success' => false, 'error' => 'Failed to upload profile picture'];
            }
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO users (name, dob, email, password, profile_pic) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $dob, $email, $hashedPassword, $profilePic);

        if ($stmt->execute()) {
            return ['success' => true];
        } else {
            return ['success' => false, 'error' => 'Database error on registration'];
        }
    }

    public function emailExists($email)
    {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows > 0;
    }

    private function uploadImage($file, $path)
    {
        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (!in_array($fileExtension, $allowedExts)) {
            return false;
        }

        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $destPath = rtrim($path, '/') . '/' . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            return $newFileName;
        }

        return false;
    }
}
