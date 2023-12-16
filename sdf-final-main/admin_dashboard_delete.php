<?php
include 'dbcon.php';

class UserDeletion {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function deleteUser($id) {
        $sqlDelete = "DELETE FROM tb_reglog WHERE id='$id'"; // delete user
        if ($this->conn->query($sqlDelete) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function resetIDs() {
        $sqlUpdate = "SET @num := 0;
                      UPDATE tb_reglog SET id = @num := @num + 1;"; // reset id no 1
        if ($this->conn->multi_query($sqlUpdate) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $userHandler = new UserDeletion($conn);

    if ($userHandler->deleteUser($id)) {
        if ($userHandler->resetIDs()) {
            header("Location: admin_dashboard.php");
        } else {
            echo "Error updating user IDs: " . $conn->error;
        }
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}

$conn->close();
?>
