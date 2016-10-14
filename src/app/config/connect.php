<?php
namespace App\Config;

use PDO;

class Connect
{


    public function getDb() {

        $db_host = "localhost";
        $db_user="root";
        $db_pass="12345";
        $db_name="comments";

        $db = null;

        try
        {
            $db = new PDO("mysql:host=$db_host;dbname=$db_name;", $db_user, $db_pass);

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
            catch(PDOException $e) {
            error_log($e->getMessage());
            die("A database error was encountered");
        }

        return $db;
    }
}
