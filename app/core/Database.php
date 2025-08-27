<?php


namespace App\core;


/**
 * Summary of Database
 */
class Database
{
    /**
     * Summary of db
     * @return \mysqli|bool
     */
    public static function db()
    {
        // $link = mysqli_connect('localhost', 'u424442379_upawa', '@Upawa7453969143', 'u424442379_upawa');

        // $link = mysqli_connect('localhost', 'root', '', 'upawa_live');

        $link = mysqli_connect('db', 'root', 'root_password', 'webkul');

        return $link;
    }
}
