<?php
require_once('Model/User.php');

class UserManager
{
    private $db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function setDb(PDO $db)
    {
        $this->db = $db;
    }

    public function getUser($id)
    {
        $id = (int) $id;

        $query = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $query->bindParam(':id', $id);
        $query->execute();
        $donnees = $query->fetch(PDO::FETCH_ASSOC);

        if(!empty($donnees)){
            return new User($donnees);
        }else{
            return null;
        }
    }

    public function addUser(User $user){
        $query = $this->db->prepare('INSERT INTO users(nom, prenom, age) VALUES(:nom, :prenom, :age)');

        $query->bindValue(':nom', $user->nom());
        $query->bindValue(':prenom', $user->prenom());
        $query->bindValue(':age', $user->age(), PDO::PARAM_INT);

        $query->execute();
    }

    public function getAllUser()
    {
        $users = [];

        $query = $this->db->query('SELECT * FROM users');
        $donnees = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($donnees as $d){
            $users[] = new User($d);
        }

        return $users;
    }
    public function getAllUserent()
    {
        $users = [];

        $query = $this->db->query('SELECT * FROM entreprise');
        $donnees = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($donnees as $d){
            $users[] = new User($d);
        }

        return $users;
    }
}

?>