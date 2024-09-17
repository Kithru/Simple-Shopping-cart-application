<?php

class DBConnect {
   
    public static function getConnection() {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $database = "meals";

        @$connection = mysql_connect($host, $user, $pass) or die(mysql_error());
        mysql_select_db($database, $connection) or die("Couldn't select the db");
        return $connection;
    }
}

?>
