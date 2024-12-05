<?php 

class Auth {
    private $conn;
    private $table = 'employees';

    public function __construct($db){
        $this->conn = $db;
    }

    public function register($name, $username, $password) {
        $query = "INSERT INTO {$this->table} (name, username, password) VALUES (:name, :username, :password)";
        $stmt = $this->conn->prepare($query);
    
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
    
        try {
            if ($stmt->execute()) {
                return "Registration successful.";
            }
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                return "Username already exists.";
            }
            return "Registration failed: " . $e->getMessage();
        }
    }

    public function login($username,$password){
        $query = "SELECT * FROM {$this->table} WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
         
        $employee = $stmt->fetch(PDO::FETCH_ASSOC);

        if($employee && password_verify($password,$employee['password'])){
            session_start();
            $_SESSION['employee_id'] = $employee['id'];
            $_SESSION['employee_name'] = $employee['name'];
            return "Login successful.";
        } else {
            return "Invalid username or password";
        }
    }

    public function isLoggedIn() {
        return isset($_SESSION['employee_id']);
    }

    public function logout() {
        session_start();
        session_destroy();
        return "Logged out successfully.";
    }

}

?>