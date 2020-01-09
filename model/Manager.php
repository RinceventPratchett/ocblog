<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Manager
 *
 * @author Voy
 */
class Manager
{   
    protected function dbConnect()
    {
        $db = new PDO('mysql:host='.DB_HOST.';dbname=blog;charset=utf8', DB_USER, DB_PASSWORD);
        return $db;
    }
}
