<?php

/**
 * Description of CommentManager
 *
 * @author Voy
 */
require_once("model/Manager.php");



class CommentManager extends Manager {

    public function showComments($postId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, comment, reported, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr FROM comment WHERE id_chapter = ? ORDER BY comment_date DESC');
        $req->execute(array($postId));
        $comments = $req->fetchAll();
        
        return $comments;
    }

    public function newComment($postId, $author, $comment) {
        $db = $this->dbConnect();

        $postId = $this->clean_data($postId);
        $author = $this->clean_data($author);
        $comment = $this->clean_data($comment);

        $comments = $db->prepare('INSERT INTO comment(id_chapter, author, comment, comment_date) VALUES(?, ?, ?, NOW())');

        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function reportComment($commentId) {

        $db = $this->dbConnect();

        $reportedComment = $db->prepare('UPDATE comment SET reported=reported+1 WHERE id=?');
        $affectedLines = $reportedComment->execute(array($commentId));

        return $affectedLines;
    }

}
