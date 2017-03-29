<?php 
  spl_autoload_register(function($class_name){
    include_once 'controllers/'.$class_name.'.php';
  });
  $department = new Department();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="public/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="public/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Student Management System</a>
    </div>
    <ul class="nav navbar-nav pull-right">
      <li class="active"><a href="#">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Students <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="addstudent.php">Add Student</a></li>
          <li><a href="studentlist.php">Student List</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Departments <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="adddepartment.php">Add Department</a></li>
          <li><a href="departmentlist.php">Department List</a></li>
        </ul>
      </li>
      <li><a href="#">Contact</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  Add Department
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <?php 
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                      $add_department = $department->create($_POST);
                      if (isset($add_department)) {
                        echo $add_department;
                      }
                    }
                 ?>
                  <form action="" method="post">
                    <div class="form-group">
                      <label for="department">Name</label>
                      <input type="text" name="department" id="department" class="form-control" placeholder="Please enter department name">
                    </div>
                    <button type="submit" class="btn btn-success">Add</button>
                  </form>
                  
              </div>
              <!-- /.panel-body -->
          </div>
          <!-- /.panel -->
      </div>
      <!-- /.col-lg-6 -->
  </div>
</div>

</body>
</html>
