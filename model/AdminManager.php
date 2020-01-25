<?php

require_once(MODEL_DIR . '/Manager.php');


class AdminManager extends Manager 
{
    
    public function signIn() 
    {
        
        $pseudo = $this->clean_data($_POST["pseudo"]);
        $password = $this->clean_data($_POST["password"]);

        if (!empty($pseudo) && !empty($password)) {
            $db = $this->dbConnect();
            //  get user pseudo and password hashed from database
            $req = $db->prepare('SELECT password FROM admin WHERE pseudo = :pseudo');
            $req->execute(array('pseudo' => $pseudo));
            $resultat = $req->fetch();

            // check if the password provided match with the pseudo in the database
            $isPasswordCorrect = password_verify($password, $resultat['password']);

            if (!$resultat) {
                return false;
            } else {
                if ($isPasswordCorrect) {

                    $_SESSION['pseudo'] = $pseudo;
                    $_SESSION['adminLogged'] = true;
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    public function SignOut() 
    {
            session_destroy();  
    }

    public function deleteChapter($postId) 
    {
        $db = $this->dbConnect();
        $deleteChapter = $db->prepare('DELETE FROM chapter WHERE id=?');
        $affectedLines = $deleteChapter->execute(array($postId));

        return $affectedLines;
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
        $updatedChapter = $db->prepare('UPDATE chapter SET title=?, content=? WHERE id=?');
        $affectedLines = $updatedChapter->execute(array($chapterTitle, $chapterContent, $chapterId));

        return $affectedLines;
    }

    public function deleteComment($commentId) 
    {

        $db = $this->dbConnect();

        $deleteComment = $db->prepare('DELETE FROM comment WHERE id=?');
        $affectedLines = $deleteComment->execute(array($commentId));

        return $affectedLines;
    }

    public function reportPending($commentId) //dedicated to the administration of the reports in one chapter in particular
    { 
        $db = $this->dbConnect();

        $reportInPending = $db->prepare('SELECT id, author, comment, reported, '
                . 'DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr '
                . 'FROM comment WHERE id_chapter = ? AND reported <> 0 ORDER BY reported DESC'); //SQL language meaning different of
        $reportInPending->execute(array($commentId));

        return $reportInPending;
    }

    public function showReportPending($commentId) //dedicated to collect all reports existing
    { 
        $db = $this->dbConnect();

        $reportInPending = $db->prepare('SELECT id, id_chapter, author, comment, reported, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') '
                . 'AS comment_date_fr FROM comment WHERE reported <> 0 ORDER BY comment_date DESC'); 
        $reportInPending->execute(array($commentId));


        return $reportInPending;
    }

}
