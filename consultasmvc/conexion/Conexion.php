<?php
namespace conexion;
use \PDO;
class Conexion{
    // private $host = "localhost";
    // private $user = "root";
    // private $password = "";
    // private $db = "motorcycleroom";
    // private $conect;
    
    private $host = "localhost";
        private $user = "ctwtvsxj_admin";
        private $password = "ElMejorProgramador***";
        private $db = "ctwtvsxj_base_motorcycleroom";
        private $conect;

    public function __construct(){
        $connectionString = "mysql:host=".$this->host.";dbname=".$this->db.";charset=utf8";
        try {
            $this->conect = new PDO($connectionString,$this->user,$this->password);
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            $this->conect ='Error de conexión';
            echo "ERROR: ". $e->getMessage();
        }
    }

    public function connect()
    {
        return $this->conect;
    }

}



?>