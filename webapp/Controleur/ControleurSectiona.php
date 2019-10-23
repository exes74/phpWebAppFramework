<?php

require_once 'Framework/Controleur.php';
require_once 'Modele/Users.php';

class ControleurSectionA extends Controleur {

	private $utilisateur;
	
    public function __construct() {
		$this->utilisateur = new User();
    }

    public function index() {
		$this->genererVue(array());		
    }	
}

?>