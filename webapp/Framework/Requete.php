<?php

require_once 'Session.php';

class Requete
{

    private $parametres;
    private $session;


    public function __construct($parametres)
    {
        $this->parametres = $parametres;
        $this->session = new Session();
    }


    public function getSession()
    {
        return $this->session;
    }

    public function existeParametre($nom)
    {
        return (isset($this->parametres[$nom]) && $this->parametres[$nom] != "");
    }

    public function getParametre($nom)
    {
        if ($this->existeParametre($nom)) {
            return $this->parametres[$nom];
        }
        else {
            throw new Exception("Paramètre '$nom' absent de la requête");
        }
    }

}

