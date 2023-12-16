<?php
include 'dbcon.php';

class TaskUpdater {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function updateTask($id, $title) {
        $sql = "UPDATE tb_add SET add_task = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $title, $id);
        
        if ($stmt->execute()) {
            header('Location: user_dashboard.php');
            exit();
        } else {
            echo "Error updating task: " . $this->conn->error;
        }
    }
}

if (isset($_POST['updateTask'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];

    $taskUpdater = new TaskUpdater($conn);
    $taskUpdater->updateTask($id, $title);
}
?>
