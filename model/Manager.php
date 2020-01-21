<?php

/**
 * Description of Manager
 *
 * @author Voy
 */
class Manager {

    protected function dbConnect() 
    {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=blog;charset=utf8', DB_USER, DB_PASSWORD);
        return $db;
    }
    protected function clean_data($cdata) 
    {    
        return htmlspecialchars($cdata);
    }
}


