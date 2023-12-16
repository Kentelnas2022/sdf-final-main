<?php
include 'dbcon.php';
session_start();

if (!isset($_SESSION['user_id'])) {
   header("Location: reglog.php?error=Please Login First."); // kung direct sa file
   exit();
}

$user_id = $_SESSION['user_id'];

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM tb_add WHERE add_task LIKE '%$search%'";
$result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html lang="en">
 <head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

   <title>| Welcome |</title>
 </head>
 <body>

   <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Welcome to the Dashboard!</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <form class="d-flex ms-auto" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
   		<input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
   		<button class="btn btn-outline-success" type="submit">Search</button>
	</form>
		<a class="nav-link ms-2" href="user_dashboard_profile.php">Profile</a>
        <a class="nav-link ms-2" href="logout.php">Log Out</a>
      </div>
    </div>
   </nav>

   <h1 class="text-center py-4 my-4"><br>TO DO LIST</h1>

   <div class="w-50 m-auto">

       <form action="user_add_data.php" method="post" autocomplete="off">
         <div class="form-group">
             <label for="add_task">Task</label>
             <input class="form-control" type="text" name="add_task" id="add_task" placeholder="Add Your List Here." required>
         </div><br>
         <button class="btn btn-success" name="addTask">Add List</button>
      </form>

   </div><br>
   <hr class="bg-dark w-50 m-auto">
   <div class="lists w-50 m-auto my-4">
       <h1>Your Lists</h1>
       <div id="lists">
       <table class="table table-dark table-hover">
 <thead>
   <tr>
     <th scope="col" name="id">No.</th>
     <th scope="col">To Do</th>
   <th>Action</th>
   </tr>
 </thead>
 <tbody>
 <?php
       if ($result && mysqli_num_rows($result) > 0) {
           while ($row = mysqli_fetch_assoc($result)) {
               $id = $row['id'];
               $title = $row['add_task'];

               ?>
               <tr>
                  <td><?php echo $id ?></td>
                  <td><?php echo $title ?></td>
                  <td>
                    <a class="btn btn-success btn-sm" href="user_dashboard_edit.php?id=<?php echo $id; ?>" role="button">Edit</a>
                    <a class="btn btn-danger btn-sm" href="user_dashboard_delete.php?id=<?php echo $id; ?>" role="button">Delete</a>
                  </td>
               </tr>
               <?php
           }
       } else {
           ?>
           <tr>
               <td colspan="3">No tasks found.</td>
           </tr>
           <?php
       }
   ?>
 </tbody>
</table>
       </div>
   </div>

   <!-- Optional JavaScript; choose one of the two! -->

   <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

   <!-- Option 2: Separate Popper and Bootstrap JS -->
   <!--
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hI```