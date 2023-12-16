<?php
include 'dbcon.php';

class Registration {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function registerUser($username, $email, $password) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO tb_reglog (username, email, password) VALUES (?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password_hash);
        
        if ($stmt->execute()) {
            $stmt->close();
            $this->redirectToSuccessPage();
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    private function redirectToSuccessPage() {
        header('location: register_success.php');
        exit();
    }
}

// Usage:
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$registration = new Registration($conn);
$registration->registerUser($username, $email, $password);
?>
