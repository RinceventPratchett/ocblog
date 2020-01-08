<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PostManager
 *
 * @author Voy
 */

require_once("model/Manager.php");

class PostManager extends Manager
{   

    public function showChapters()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM chapter ORDER BY creation_date DESC');// LIMIT 0, 0

        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM chapter WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }
    public function newChapter($chapterTitle, $chapterContent)
    {
        $db = $this->dbConnect();
        $chapter = $db->prepare('INSERT INTO chapter( title, content, creation_date) VALUES(?, ?, NOW())');
        $affectedLines = $chapter->execute(array($chapterTitle, $chapterContent));
        
        return $affectedLines;
    }
    public function updateChapter($chapterTitle, $chapterContent, $chapterId)
    {
        $db = $this->dbConnect();
        
        
//        
        $updatedChapter = $db->prepare('UPDATE chapter SET title=?, content=? WHERE id=?');
        $affectedLines = $updatedChapter->execute(array($chapterTitle, $chapterContent, $chapterId));
//            var_dump($affectedLines);
//            var_dump($updatedChapter); 
//            var_dump($db);
//            var_dump($updatedChapter->errorInfo(), $updatedChapter->rowCount()); //pour afficher les erreurs sql
//            echo 'updateChapter PostManager';
//            echo $chapterTitle;
//            echo $chapterContent;  
        return $affectedLines;
    }
}
