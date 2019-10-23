<?php

require_once 'ControleurSecurise.php';
require_once 'Modele/Users.php';
require_once 'lib/password.php';
/**
 * Contrôleur des actions liées aux billets
 *
 * @author Baptiste Pesquet
 */
class ControleurUser extends ControleurSecurise {

    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function index() {
    }
	
	public function myProfile() {
		$id_user = $this->requete->getSession()->getAttribut("id_user");
        $user_detail = $this->user->detailUser($id_user);
        $this->genererVue(array('user' => $user_detail));
    }
	
	
	public function ajax(){
		if ($this->requete->existeParametre("do")){
			$do = $this->requete->getParametre("do");
			switch($do){
				/////////////////GESTION DES ACTIONS AJAX/////////////////////
			case 'reloadRights':
				$this->requete->getSession()->setAttribut("user_rights", '');
				$userRights = $this->user->getUserRights($this->requete->getSession()->getAttribut("id_user"));
				$this->requete->getSession()->setAttribut("user_rights", $userRights);
				$data = 'Success';
				break;
			default:
				$data = '';
			}
			print_r($data);	
		}else{
			print_r('Impossible');	
		}
	}
	
	public function updatePassword(){
		$id_user = $this->requete->getSession()->getAttribut("id_user");
        if ($this->requete->existeParametre("oldPass") && $this->requete->existeParametre("newPass") && $this->requete->existeParametre("newPassConf")) {
            $oldPass = $this->requete->getParametre("oldPass");
            $newPass = $this->requete->getParametre("newPass");
			$newPassConf = $this->requete->getParametre("newPassConf");
			if($this->user->checkPassword($id_user, $oldPass) == 1){
				if ($newPass == $newPassConf){
					//check password
					$uppercase = preg_match('@[A-Z]@', $newPass);
					$lowercase = preg_match('@[a-z]@', $newPass);
					$number    = preg_match('@[0-9]@', $newPass);
					if(!$uppercase || !$lowercase || !$number || strlen($newPass) < 8) {
						$pass_char = 0;
					}else{
						$pass_char = 1;
					}
					if($pass_char == 0){
						$this->genererVue(array('msgErreur' => 'Le nouveau mot de passe ne respecte pas les règles de complexité.'));			
					}else{
						$newPass = password_hash($newPass, PASSWORD_DEFAULT);
						if ($this->user->updatePassword($id_user, $newPass) == 1 ){
							$this->genererVue(array('msgSuccess' => 'Mot de passe mis à jour avec succès'),"updatepassword");						
						}else{
							$this->genererVue(array('msgErreur' => 'Impossible de mettre à jour le mot de passe, veuillez réessayer.'),"updatepassword");						
						}	
					}
				}else{
					$this->genererVue(array('msgErreur' => 'Le mot de passe et la confirmation ne correspondent pas.'));			
				}
			}else{
				$this->genererVue(array('msgErreur' => 'Mauvais mot de passe.'));	
			}
        }else{
			$this->genererVue(array('user' => $id_user));
		}
    }
	
	public function updateSession(){
		if ($this->requete->existeParametre("sessionUpdate") && $this->requete->existeParametre("value")) {
			$paramChange = $this->requete->getParametre("sessionUpdate") ;
			$newValue = $this->requete->getParametre("value");
			print_r($paramChange.$newValue);
			if($this->requete->getSession()->existeAttribut($paramChange)){
				$this->requete->getSession()->setAttribut($paramChange, $newValue);
			}
		}
	}
	
	
}


    