<?php
namespace App\Account;
use App\core\Database;
class Account
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::db();
    }

    public function getUser($userId)
    {
        $stmt = $this->db->prepare("SELECT name, dob, email, profile_pic FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateProfile($userId, $name, $dob)
    {
        // Email is excluded from editing as requested
        $stmt = $this->db->prepare("UPDATE users SET name = ?, dob = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $dob, $userId);
        return $stmt->execute();
    }

    public function updateProfilePic($userId, $picPath)
    {
        $stmt = $this->db->prepare("UPDATE users SET profile_pic = ? WHERE id = ?");
        $stmt->bind_param("si", $picPath, $userId);
        return $stmt->execute();
    }
}
