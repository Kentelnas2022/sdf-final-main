<?php
include 'dbcon.php';

class Login {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function authenticateUser($username, $password) {
        $sql = "SELECT * FROM tb_reglog WHERE username = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $hashedPassword = $user['password'];

            if (password_verify($password, $hashedPassword)) {
                session_start();
                $_SESSION['user_id'] = $user['id'];

                if ($user['role'] == 'admin') {
                    header('Location: admin_dashboard.php');
                } else {
                    header('Location: user_dashboard.php');
                }

                $stmt->close();
                $this->conn->close();
                exit();
            } else {
                $this->redirectWithError("Incorrect password");
            }
        } else {
            $this->redirectWithError("This Account is not Registered.");
        }
    }

    private function redirectWithError($errorMessage) {
        header("Location: reglog.php?error=$errorMessage");
        exit();
    }
}

// Usage:
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$login = new Login($conn);
$login->authenticateUser($username, $password);
?>
