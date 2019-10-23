<?php

require_once 'Configuration.php';


class Vue
{
    private $fichier;

    private $titre;
	private $class_css;

    public function __construct($action, $controleur = "")
    {
        $fichier = "Vue/";
        if ($controleur != "") {
            $fichier = $fichier . $controleur . "/";
        }
        $this->fichier = $fichier . $action . ".php";
    }

    public function generer($donnees)
    {
        $contenu = $this->genererFichier($this->fichier, $donnees);
        $racineWeb = Configuration::get("racineWeb", "");
        $vue = $this->genererFichier('Vue/gabarit.php',
                array('titre' => $this->titre, 'class_css' => $this->class_css, 'contenu' => $contenu, 'racineWeb' => $racineWeb));
        echo $vue;
    }


    private function genererFichier($fichier, $donnees)
    {
        if (file_exists($fichier)) {
            extract($donnees);
            ob_start();
            require $fichier;

            return ob_get_clean();
        }
        else {
            throw new Exception("Fichier '$fichier' introuvable");
        }
    }


    private function cln($valeur)
    {
        return htmlspecialchars($valeur, ENT_QUOTES, 'UTF-8', false);
    }
	
	private function zeroIfEmpty($valeur){
		if ($valeur == 'empty'){
			return 0;
		}else{
			return $valeur;
		}
    }

}
