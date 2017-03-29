<?php 
	spl_autoload_register(function($class_name){
		include_once 'controllers/'.$class_name.'.php';
	});
	$student = new Student();

	if (isset($_GET['id'])) {
	  $id = $_GET['id'];
	  $delete_data = $student->delete($id);
	  if (isset($delete_data)) {
	  	header('location: studentlist.php?msg='.urlencode('Student Deleted Successfully'));
	  }
	}

 ?>