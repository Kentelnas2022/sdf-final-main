<?php
include 'dbcon.php';

class TaskManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addTask($task) {
        $sql = "INSERT INTO tb_add (add_task) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $task);

        if ($stmt->execute()) {
            $this->redirectUserDashboard();
        } else {
            echo "Error: " . $this->conn->error;
        }
    }

    private function redirectUserDashboard() {
        header("location: ./user_dashboard.php");
        exit();
    }
}

// Usage:
if (isset($_POST['addTask'])) {
    $taskToAdd = $_POST['add_task'] ?? '';

    $taskManager = new TaskManager($conn);
    $taskManager->addTask($taskToAdd);
}
?>
