<?php
namespace App\core;

use App\core\Database;

class Helper
{
    private $db;
    public function __construct()
    {
        $this->db = Database::db();
    }
    public function numberToEncryptedText($number)
    {
        $encodedText = base64_encode($number);
        return $encodedText;
    }

    public function encryptedTextToNumber($encryptedText)
    {
        $decodedNumber = base64_decode($encryptedText);
        $decodedNumber = intval($decodedNumber);

        return $decodedNumber;
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function uploadImage($file, $path)
    {
        // Check if file was uploaded without errors
        if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $file['tmp_name'];
            $fileName = $file['name'];
            $fileSize = $file['size'];
            $fileType = $file['type'];

            // Sanitize file name to avoid harmful chars
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

            $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (in_array($fileExtension, $allowedExts)) {
                // Create target directory if not exists
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }

                $destPath = rtrim($path, '/') . '/' . $newFileName;

                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    return $newFileName; // Return new file name on success
                }
            }
        }
        return false; // Return false on failure
    }

    public function validateName($name)
    {
        return preg_match("/^[a-zA-Z ]{2,50}$/", $name);
    }

    public function validateDOB($dob)
    {
        $d = \DateTime::createFromFormat('Y-m-d', $dob);
        return $d && $d->format('Y-m-d') === $dob;
    }

    public function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function validatePassword($password)
    {
        return preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$/", $password);
    }

    public function __destruct()
    {
        $this->db->close();
    }
}
