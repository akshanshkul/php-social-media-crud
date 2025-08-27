<?php
namespace App\Account;
use App\core\Database;
use App\core\Session;
class Login
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::db();
    }

    public function authenticate($email, $password)
    {
        $stmt = $this->db->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($userId, $hashedPassword);
        if ($stmt->fetch()) {
            if (password_verify($password, $hashedPassword)) {
                Session::set("userId", $userId);
                Session::set("email",$email);
                return $userId;
            }
        }
        return false;
    }
}
