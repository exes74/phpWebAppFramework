<?php

require_once 'Framework/Controleur.php';

/**
 * Classe parente des contrôleurs soumis à authentification
 */
abstract class ControleurSecurise extends Controleur
{

    public function executerAction($action,$controleur)
    {
        // Vérifie si les informations utilisateur sont présents dans la session
        // Si oui, l'utilisateur s'est déjà authentifié : l'exécution de l'action continue normalement
        // Si non, l'utilisateur est renvoyé vers le contrôleur de connexion
        if ( $this->requete->getSession()->existeAttribut("id_user") && $this->requete->getSession()->existeAttribut("activated") && $this->requete->getSession()->getAttribut("activated") ==1) {
            //verification des droits, sinon redirection vers droits non autorisés
			//get id user
			$idUser = $this->requete->getSession()->getAttribut("id_user");
			$controleurName = (get_class($controleur));
				// var_dump($controleurName.'_'.$action);
				// echo '<pre>';
				// var_dump($_SESSION['user_rights']);
				// echo '</pre>';
				// var_dump($idUser);
			//on recupere ses droits associés
			if (in_array(strtolower($controleurName.'_'.$action),$_SESSION['user_rights'])){
				// echo 'OK CONTROLEUR';
			// }else{
				// echo "PAS OK CONTROLEUR";
			// }
			// if (1==1){
				parent::executerAction($action);	
			}else{
				$this->rediriger("norights");
			}
			
			
        }
        else {
            $this->rediriger("connexion");
        }
    }

}

