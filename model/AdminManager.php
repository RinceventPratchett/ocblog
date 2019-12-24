<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminManager
 *
 * @author Voy
 */
require_once("model/Manager.php");

class AdminManager extends Manager 
{
    //public function 
    public function newPosts($chapter_id, $chapter_title, $chapter_content, $chapter_creation_date)
    {
        $db = $this->dbConnect();
        //$req = $db->query('INSERT INTO `blog`.`chapter` id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM chapter ORDER BY creation_date DESC LIMIT 0, 5');
        
        return $req;
    }
    
    //passer le site en mode construction ou modif de présentztion globale
}

