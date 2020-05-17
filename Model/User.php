<?php

class User
{
    private $id;
    private $nom;
    private $prenom;
    private $age;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);

            // Si le setter correspondant existe.
            if (method_exists($this, $method))
            {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }

    public function id(){
        return $this->id;
    }

    public function nom(){
        return $this->nom;
    }

    public function prenom(){
        return $this->prenom;
    }

    public function age(){
        return $this->age;
    }

    public function setId($id_envoyer){
        $id = (int) $id_envoyer;
        $this->id = $id;
    }

    public function setNom($nom_envoyer){
        if (is_string($nom_envoyer))
        {
            $this->nom = htmlspecialchars($nom_envoyer);
        }
    }

    public function setPrenom($prenom_envoyer){
        if (is_string($prenom_envoyer))
        {
            $this->prenom = htmlspecialchars($prenom_envoyer);
        }
    }

    public function setAge($age_envoyer){
        $age = (int) $age_envoyer;

        if ($age >= 0 && $age <= 100)
        {
            $this->age = $age;
        }
    }
}
?>