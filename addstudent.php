<?php 
	spl_autoload_register(function($class_name){
		include_once 'controllers/'.$class_name.'.php';
	});
	$student = new Student();
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
                  Add Student
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <?php 
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                      $addstudent = $student->create($_POST);
                      if (isset($addstudent)) {
                        echo $addstudent;
                      }
                    }
                 ?>
                  <form action="" method="post">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" name="name" id="name" class="form-control" placeholder="Please enter student name">
                    </div>
                    <div class="form-group">
                      <label for="dept_id">Department</label>
                      <select class="form-control" id="dept_id" name="dept_id">
                      <option>-- Select One --</option>
                     <?php 
                        $result = $department->index();
                        if ($result) {
                          while ($data = $result->fetch_assoc()) {
                      ?>
                      <option value="<?php echo $data['id'] ?>"><?php echo $data['department']; ?></option>
                      <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="roll">Roll</label>
                      <input type="text" name="roll" id="roll" class="form-control" placeholder="Please enter student roll">
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" id="email" class="form-control" placeholder="Please enter student email">
                    </div>
                    <div class="form-group">
                      <label for="phone">Phone no.</label>
                      <input type="text" name="phone" id="phone" class="form-control" placeholder="Please enter student phone no.">
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
