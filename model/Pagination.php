<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pagination
 *
 * @author Voy
 */
require_once("model/Manager.php");

class Pagination extends Manager{

        public function getPostsPagination() {
        $db = $this->dbConnect();
        $totalPosts = $db->query('SELECT COUNT(id) AS nbPosts FROM chapter');

        return $totalPosts->fetch()['nbPosts'];
        }
     
        public function getPostsPages($nbPosts, $postsPerPage) {  
            $nbPage = ceil($nbPosts/$postsPerPage);
            
            return $nbPage;
        }
}
