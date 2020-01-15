<?php

/**
 * Description of Pagination
 *
 * @author Voy
 */
require_once("model/Manager.php");

class Pagination extends Manager {

    public function getPostsPagination() {
        $db = $this->dbConnect();
        $totalPosts = $db->query('SELECT COUNT(id) AS nbPosts FROM chapter');

        return $totalPosts->fetch()['nbPosts'];
    }

    public function getPostsPages($nbPosts, $postsPerPage) {
        $nbPage = ceil($nbPosts / $postsPerPage); //to round up a decimal number to next greater integral value.

        return $nbPage;
    }

}
