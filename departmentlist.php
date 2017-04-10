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
  <!-- DataTables CSS -->
  <link href="public/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

  <!-- DataTables Responsive CSS -->
  <link href="public/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
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
          <?php 
            if (isset($_GET['msg'])) {
              $msg = $_GET['msg'];
              echo "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$msg."</div>";
            }

            if (isset($_SESSION['message'])) {
              echo $_SESSION['message'];
              unset($_SESSION['message']);
            }
           ?>
          <div class="panel panel-default">
              <div class="panel-heading">
                  Department List
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                      <thead>
                          <tr>
                              <th>Sl</th>
                              <th>Name</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php 
                            $result = $department->index();
                            if ($result) {
                              $sl = 0;
                              while ($data = $result->fetch_assoc()) {
                                $sl++;
                         ?>
                          <tr class="odd gradeX">
                              <td><?php echo $sl; ?></td>
                              <td><?php echo $data['department']; ?>
                              <td>
                                <a href="editdepartment.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="deletedepartment.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this data?');">Delete</a>
                              </td>
                          </tr>
                          <?php } } ?>
                      </tbody>
                  </table>
                  <!-- /.table-responsive -->
                  
              </div>
              <!-- /.panel-body -->
          </div>
          <!-- /.panel -->
      </div>
      <!-- /.col-lg-6 -->
  </div>
              <!-- /.row -->
</div>

<!-- DataTables JavaScript -->
 <script src="public/datatables/js/jquery.dataTables.min.js"></script>
 <script src="public/datatables-plugins/dataTables.bootstrap.min.js"></script>
 <script src="public/datatables-responsive/dataTables.responsive.js"></script>
 <!-- Page-Level Demo Scripts - Tables - Use for reference -->
 <script>
 $(document).ready(function() {
     $('#dataTables-example').DataTable({
         responsive: true
     });
 });
 </script>

</body>
</html>
