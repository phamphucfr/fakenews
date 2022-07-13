<?php

class MaConnexion {
    // Attributs
    private static $url = "mysql:host=hostnameserveripadress:portnumber;dbname=nameofmydatabase;charset=utf8";
    private static $user = "username";
    private static $pass = "password";
    
    static function connect(){
        return new PDO(MaConnexion::$url, MaConnexion::$user, MaConnexion::$pass);
    }
}
?>
