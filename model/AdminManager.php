<?php 
    require_once(MODEL_DIR.'/Manager.php');
    
        function check_data($cdata){
            $cdata = htmlspecialchars($cdata);
            return $cdata;
        }
    class AdminManager extends Manager 
    {

        public function signIn() {
           

            $pseudo = check_data($_POST["pseudo"]);
            $password = check_data($_POST["password"]);
        
            if (!empty($pseudo) && !empty($password)) {
                $db = $this->dbConnect();
                //  Récupération de l'utilisateur et de son pass hashé
                $req = $db->prepare('SELECT password FROM admin WHERE pseudo = :pseudo');
                $req->execute(array('pseudo' => $pseudo));
                $resultat = $req->fetch();
                // Comparaison du pass envoyé via le formulaire avec la base
                
                $isPasswordCorrect = password_verify($password, $resultat['password']);
                
                if (!$resultat)
                {
                    return false;//echo 'Mauvais identifiant ou mot de passe !';
                }
                else
                {
                    if ($isPasswordCorrect) {
                        

                        $_SESSION['pseudo'] = $pseudo;
                        $_SESSION['adminLogged'] = true;
                        return true;
                    }
                    else {
                        return false;
                    }
                }
            }
            else{
                        return false;
            }
        }
        public function SignOut(){
            if ($_SESSION['adminLogged']){
                session_destroy();
            }
        }
        
        public function deleteChapter($postId) {
            $db = $this->dbConnect();
            $deleteChapter = $db->prepare('DELETE FROM chapter WHERE id=?');
            $affectedLines = $deleteChapter->execute(array($postId));

            return $affectedLines;
            
        }
    }    

    