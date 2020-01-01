<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommentManager
 *
 * @author Voy
 */
require_once("model/Manager.php");

class CommentManager extends Manager 
{
    public function showComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr FROM comment WHERE id_chapter = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function newComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comment(id_chapter, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }
    
    public function deleteComment($commentId) {
        $db = $this->dbConnect();
        $deleteComment = $db->prepare('DELETE FROM comment WHERE id=?');
        $affectedLines = $deleteComment->execute(array($commentId));

        return $affectedLines;
    }
    
    public function reportComment($commentId) {
        $db = $this->dbConnect();
        $reportComment= $db->prepare('UPDATE comment SET reported=reported+1 WHERE id='.$commentId);
        $affectedLines = $reportComment->execute(array($commentId));
        
        return $affectedLines;
    }
}
