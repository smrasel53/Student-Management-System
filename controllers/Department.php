<?php 
	session_start();
	include_once '/../database/DB.php';
	class Department
	{
		private $db;
		private $table = "tbl_departments";


		public function __construct()
		{
			$this->db = new DB();
		}

		public function index()
		{
			$query  = "SELECT * FROM $this->table ORDER BY id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function create($data)
		{
			$department = mysqli_real_escape_string($this->db->link, $data['department']);

			if ($department == "") {
				return "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!</strong> Field must not be empty.</div>";
				exit();
			} else {
				$query  = "SELECT department FROM $this->table WHERE department = '$department'";
				$result = $this->db->select($query);
				if ($result) {
 					return "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!</strong> Department Already Exists !</div>";
 					exit();
				} else {
					$query = "INSERT INTO $this->table(department) VALUES ('$department')";
					$insert_data = $this->db->insert($query);
					if ($insert_data) {
						$_SESSION['message'] = "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Department Added Successfully.</div>";
						header('location: /../sms/departmentlist.php');
					}
					
				}
				
			}

		}

		public function getDepartmentById($id)
		{
			$query  = "SELECT * FROM $this->table WHERE id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function update($data)
		{
			$department = mysqli_real_escape_string($this->db->link, $data['department']);
			$id   = $data['id'];

			if ($department == "") {
				return "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!</strong> Field must not be empty.</div>";
				exit();
			} else {
				$query = "UPDATE $this->table
						  SET department   = '$department'
						  WHERE id = '$id'
						  ";
				$update_data = $this->db->update($query);
				if ($update_data) {
					$_SESSION['message'] = "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Department Updated Successfully.</div>";
						header('location: /../sms/departmentlist.php');
				}
			}

		}

		public function delete($id)
		{
			$query = "DELETE FROM $this->table WHERE id = '$id'";
			$delete_data = $this->db->delete($query);
			if ($delete_data) {
				$_SESSION['message'] = "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Department Deleted Successfully.</div>";
					header('location: /../sms/departmentlist.php');
			}
		}
	}
 ?>