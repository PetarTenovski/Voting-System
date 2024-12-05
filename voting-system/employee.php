<?php 

class Employee{
    private $conn;
    private $table = 'employees';

    public function __construct($db){
        $this->conn=$db;
    }

    public function getAllEmployees(){
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>