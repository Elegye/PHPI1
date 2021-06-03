<?php
namespace App\Core\Repository;

use App\Core\DependencyInjection\Container;

abstract class AbstractRepository{

    private $container;

    private $repository;

    private $table;

    private $conn;
 
    public function __construct(){
        $this->container = new Container();
        $this->repository = get_called_class();
        $this->table = "projet.".$this->repository::$table;

        $this->conn = new \mysqli("192.168.56.80", "gpi2", "network", "projet");
        if($this->conn->connect_error) {
            exit("Impossible de se connecter à la base de données");
        }
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->conn->set_charset("utf8");
    }

    public function executeQuery(string $query){
        return $this->conn->real_escape_string($query);
    }

    public function findAll()
    {
        $resulat = [];
        $result = $connexion->query("SELECT * FROM ".$this->table);
        if(!$result) {
            echo "la requête ne s’est pas exécutée"; 
        } else {
            echo "la requête s’est bien passée"; 
            $resultat = $result->fetch_assoc();
            $result->free();
        }
        $connexion->close();

        return $resultat;
    }

}