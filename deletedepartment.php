<?php 
	spl_autoload_register(function($class_name){
		include_once 'controllers/'.$class_name.'.php';
	});
	$department = new Department();

	if (isset($_GET['id'])) {
	  $id = $_GET['id'];
	  $delete_data = $department->delete($id);
	}

 ?>