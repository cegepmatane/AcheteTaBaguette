<?php

class Redirection
{
    private $chemin;
    
    

    public function __construct($chemin)
    {
         $this->setNom($chemin ?? "");

    }

    public function rediriger()
    {
        header("Location: " . $this->chemin);
        exit();
    }

    public function setNom($nouveauChemin)
    {
      $this->chemin=$nouveauChemin;
    }

    

}
