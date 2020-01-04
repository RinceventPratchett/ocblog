<?php 
    require_once(MODEL_DIR.'/Manager.php');
    
    class AdminManager extends Manager 
    {
        public function signIn() {
            $pseudo = $_POST['pseudo'];
            $password = $_POST['password'];
            
        
            if (!empty($pseudo) && !empty($password)) {
                $db = $this->dbConnect();
                //  Récupération de l'utilisateur et de son pass hashé
                $req = $db->prepare('SELECT id, password FROM admin WHERE pseudo = :pseudo');
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
                        
                        $_SESSION['id'] = $resultat['id'];
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
    }    

    