<?php
include 'dbcon.php';

class TaskUpdater {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getTaskDetails($taskId) {
        $sql = "SELECT * FROM tb_add WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $taskId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['add_task'];
        }
        return null;
    }

    public function updateTask($taskId, $newTask) {
        $sql = "UPDATE tb_add SET add_task = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $newTask, $taskId);
        
        if ($stmt->execute()) {
            header('Location: user_dashboard.php');
            exit();
        } else {
            echo "Error updating task: " . $this->conn->error;
        }
    }
}

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    $taskUpdater = new TaskUpdater($conn);
    $title = $taskUpdater->getTaskDetails($taskId);
} else {
    echo "Invalid task ID";
    exit();
}

if (isset($_POST['updateTask'])) {
    $newTitle = $_POST['title'];
    $taskUpdater->updateTask($taskId, $newTitle);
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>| Welcome |</title>
</head>

<body>
    <h1 class="text-center py-4 my-4">Update Your List</h1>
    <div class="w-50 m-auto">
        <form action="" method="post" autocomplete="off">
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" value="<?php echo $title; ?>"
                    placeholder="Edit Here Your ToDo'S" required>
                <input type="hidden" name="id" value="<?php echo $taskId; ?>">
            </div><br>
            <button class="btn btn-success" name="updateTask">Update List</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
</body>

</html>
