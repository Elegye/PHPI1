<?php
namespace App\Core\Repository;

use App\Core\DependencyInjection\Container;

abstract class AbstractRepository{

    private $container;

    private $params;

    private $repository;

    private $table;

    private $conn;
 
    public function __construct(){
        $this->container = new Container();
        $this->params = $this->container->get('param');
        $this->repository = get_called_class();
        $this->table = "projet.".$this->repository::$table;

        $this->conn = new \mysqli(
            $this->params->get('DATABASE_URL'),
            $this->params->get('DATABASE_USER'),
            $this->params->get('DATABASE_PASSWD'),
            $this->params->get('DATABASE_DATABASE')
        );
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
        $resulats = [];
        $result = $this->conn->query("SELECT * FROM ".$this->table);
        if(!$result) {
            throw new \Exception('Requête impossible');
        } else {
            $resultats = $result->fetch_assoc();
            $result->free();
        }
        $this->conn->close();

        return $resultats;
    }

}