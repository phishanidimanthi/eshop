<?php

class Database{
    public static $connection; //static variable ekk hadanwa (onama thenka access karanna puluwn db connection eka haraha)

    public static function setUpConnection(){
        
        if(!isset(Database::$connection)){ //database ekath ekka connection ekk hadagena nedda !isset -> is not set?
                                          //:: aithi --> Database eke $connection eka
            Database::$connection = new mysqli("localhost","root",'I$Dk989$ishani',"eshop","3306");
        }
    }

    public static function uid($q){ //$q query eka
        Database::setUpConnection(); //Database clz eke thina setUpConnection ekath ekka connection ekk hadaganna
        Database::$connection->query($q); //query eka execute karnwa. result ekk enne ne
    }

    public static function search($q){
        
        Database::setUpConnection(); //connection ekk hadanna
        $resultset = Database::$connection->query($q); //db connection use karla query eka execute karanna
        return $resultset;  // execute wela result eka return karnwa query eka pass karna thenta
    }
}

?>