<?php

require_once 'Framework/Controleur.php';
require_once 'Modele/Users.php';
require_once 'Modele/Groups.php';
require_once 'Modele/Actions.php';
require_once 'lib/password.php';
/**
 * Contrôleur gérant la connexion au site
  */
class ControleurConnexion extends Controleur
{
    private $utilisateur;
	private $group;
	private $action;
	
    public function __construct()
    {
        $this->utilisateur = new User();
		$this->group = new Group();
		$this->action = new Action();
    }

    public function index()
    {
        $this->genererVue();
    }

    public function connecter(){
        if ($this->requete->existeParametre("login") && $this->requete->existeParametre("password")) {
            $login = $this->requete->getParametre("login");
            $pass = $this->requete->getParametre("password");
            if ($this->utilisateur->connecter($login, $pass)) {
                $utilisateur = $this->utilisateur->getUtilisateur($login, $pass);
                $this->requete->getSession()->setAttribut("id_user",  $utilisateur['id']);
                $this->requete->getSession()->setAttribut("login", $utilisateur['login']);
				$this->requete->getSession()->setAttribut("is_admin", $utilisateur['is_admin']);
				$this->requete->getSession()->setAttribut("activated",$utilisateur['activated']);
				//on get les droits de l'utilisateur à la connection pour les stocker en session et eviter les appels à la base  à chaque action- nécéssite une deco/reco ou un clic sur le profil pour recuperer les nouveaux droits
				$this->action->updateUserPrivileges($this->requete->getSession()->getAttribut("id_user")) ;
				$userRights = $this->utilisateur->getUserRights($this->requete->getSession()->getAttribut("id_user"));
				$this->requete->getSession()->setAttribut("user_rights", $userRights);
					if($this->requete->getSession()->getAttribut("activated") ==1){
						$this->rediriger("accueil");						
					}
					else{
						$this->genererVue(array('msgErreur' => 'Connexion réussie mais ce compte est désactivé'),"index");						
					}
            }
            else
                $this->genererVue(array('msgErreur' => 'Mot de passe ou identifiant invalide.'),"index");
        }
        else
            //throw new Exception("Action impossible : login ou mot de passe non défini");
			$this->genererVue(array('msgErreur' => 'Mot de passe ou identifiant invalide.'), "index");
    }

    public function deconnecter()
    {
        $this->requete->getSession()->detruire();
        $this->rediriger("accueil");
    }
	
	public function register(){
		if ($this->requete->getSession()->existeAttribut("id_user")){
			$this->genererVue(array('msgErreur' => 'You are alreay identified, please logout if you need to create a new account' , 'alreadyLogin' => 1), "register");			
		}else{
			if ($this->requete->existeParametre("action_register") && $this->requete->getParametre("action_register") =='register'){
				if ($this->requete->existeParametre("name") && $this->requete->existeParametre("pass") && $this->requete->existeParametre("passConf")) {
					$error = array();
					$name = $this->requete->getParametre("name");
					$pass = $this->requete->getParametre("pass");
					$passConf = $this->requete->getParametre("passConf");
					//$email = $this->requete->getParametre("email");
					//check mail
					// if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
						// $mail_ok = 0;
						// $error['email'] = 'Email is not valid.';			
					// }else{
						// $mail_ok = 1;		
					// }
					//check username already used	
					$username_used = $this->utilisateur->getUsername($name);
					if ($username_used == 1){
						$username_unused_ok = 0;
						$error['username'] = 'Ce nom d\'utilisateur existe déja.';
					}else{
						$username_unused_ok = 1;	
					}
					//check name
					$name = filter_var($name, FILTER_SANITIZE_STRING);
					//check password
					$uppercase = preg_match('@[A-Z]@', $pass);
					$lowercase = preg_match('@[a-z]@', $pass);
					$number    = preg_match('@[0-9]@', $pass);
					if(!$uppercase || !$lowercase || !$number || strlen($pass) < 8) {
						$pass_char = 0;
						$error['pass'] = 'Le mot de passe n\'est pas valide (les règles de complexité ne sont pas respectées).';
					}else{
						$pass_char = 1;
					}			
					//check conf password
					if ( $pass == $passConf && $pass_char == 1 ){
						$pass_ok = 1;
					}
					elseif ( $pass == $passConf && $pass_char == 0 ){
						$pass_ok = 0;
					}else{
						$pass_ok = 0;
						$error['passConf'] = 'Les mots de passe ne correspondent pas.';
					}
					$passHash = password_hash($pass, PASSWORD_DEFAULT);
					
					if($pass_ok == 1 && $username_unused_ok == 1) {
						$insert_user = $this->utilisateur->insertUser($name,$passHash);					
						if ($insert_user == 1){
							$idUser = $this->utilisateur->getUserId($name);
							$this->action->updateUserPrivileges($idUser) ;
							$msgSuccess = 'Utilisateur '.$name.'. créé avec succès <br> Vous pouvez maintenant vous connecter. ';
							$this->genererVue(array('msgSuccess' => $msgSuccess),'index');
						}else{
							$msgError = 'Impossible de créer l\'utilisateur '.$name;
							$this->genererVue(array('msgErreur' => $msgError));	
						}						
					}else{
						$this->genererVue(array('msgErreur' => 'Valeurs incorrects.','error' => $error));	
					}
				}else{
					$this->genererVue(array('msgErreur' => 'Tous les champs doivent être renseignés.'));	
				}
			}else{
				$this->genererVue();
			}
		}
    }
	

}
