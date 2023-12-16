<?php
include 'dbcon.php';

class TaskDeletion {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function deleteTask($taskId) {
        $deleteQuery = "DELETE FROM tb_add WHERE id = ?";
        $stmt = $this->conn->prepare($deleteQuery);
        $stmt->bind_param("i", $taskId);

        if ($stmt->execute()) {
            $this->checkAndResetAutoIncrement();
            $this->redirectUserDashboard();
        } else {
            echo "Error deleting task: " . $this->conn->error;
        }
    }

    private function checkAndResetAutoIncrement() {
        $checkEmptyQuery = "SELECT COUNT(*) as count FROM tb_add";
        $result = $this->conn->query($checkEmptyQuery);
        $row = $result->fetch_assoc();

        if ($row['count'] == 0) {
            $this->conn->query("ALTER TABLE tb_add AUTO_INCREMENT = 1");
        }
    }

    private function redirectUserDashboard() {
        header('Location: user_dashboard.php');
        exit();
    }
}

// Usage:
if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    
    $taskDeletion = new TaskDeletion($conn);
    $taskDeletion->deleteTask($taskId);
} else {
    echo "Invalid task ID";
}
?>
