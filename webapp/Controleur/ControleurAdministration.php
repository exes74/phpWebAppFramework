<?php

require_once 'Framework/Controleur.php';

/**
 * Contrôleur des actions d'administration
 */
abstract class ControleurAdministration extends Controleur
{

    public function executerAction($action)
    {
        // Vérifie si les informations utilisateur sont présents dans la session + est admin
        // Si oui, l'utilisateur s'est déjà authentifié : l'exécution de l'action continue normalement
        // Si non, l'utilisateur est renvoyé vers le contrôleur de connexion
        if ($this->requete->getSession()->existeAttribut("id_user") && $this->requete->getSession()->existeAttribut("activated") && $this->requete->getSession()->getAttribut("activated") ==1){
			if($this->requete->getSession()->existeAttribut("is_admin") && $this->requete->getSession()->getAttribut("is_admin") == 1) {
				parent::executerAction($action);
			}else{
				$this->rediriger("accueil");				
			}
		}else {
            $this->rediriger("accueil");
        }
    }

}