<?php 
	include_once '/../database/DB.php';
	class Student
	{
		private $db;
		private $table = "tbl_students";
		private $table_dept = "tbl_departments";


		public function __construct()
		{
			$this->db = new DB();
		}

		public function index()
		{
			$query  = "SELECT $this->table.id, $this->table.name, $this->table_dept.department, $this->table.roll, $this->table.email, $this->table.phone FROM $this->table INNER JOIN $this->table_dept ON $this->table.dept_id = $this->table_dept.id ORDER BY $this->table.id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function create($data)
		{
			$dept_id = mysqli_real_escape_string($this->db->link, $data['dept_id']);
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$roll = mysqli_real_escape_string($this->db->link, $data['roll']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);

			if ($name == "" || $dept_id == "" || $roll == "" || $email == "" || $phone == "") {
				return "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!</strong> Field must not be empty.</div>";
				exit();
			} else {
				$query = "INSERT INTO $this->table(dept_id, name, roll, email, phone) VALUES ('$dept_id', '$name', '$roll', '$email', '$phone')";
				$insert_data = $this->db->insert($query);
				if ($insert_data) {
					return "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Student Added Successfully.</div>";
					exit();
				}
			}

		}

		public function getStudentById($id)
		{
			$query  = "SELECT * FROM $this->table WHERE id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function update($data)
		{
			$dept_id = mysqli_real_escape_string($this->db->link, $data['dept_id']);
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$roll = mysqli_real_escape_string($this->db->link, $data['roll']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			$id   = $data['id'];

			if ($dept_id == "" || $name == "" || $roll == "" || $email == "" || $phone == "") {
				return "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!</strong> Field must not be empty.</div>";
				exit();
			} else {
				$query = "UPDATE $this->table
						  SET
						  dept_id  = '$dept_id', 
						  name     = '$name', 
						  roll 	   = '$roll',
						  email    = '$email',
						  phone    = '$phone'
						  WHERE id = '$id'
						  ";
				$update_data = $this->db->update($query);
				if ($update_data) {
					return "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Student Updated Successfully.</div>";
					exit();
				}
			}

		}

		public function delete($id)
		{
			$query = "DELETE FROM $this->table WHERE id = '$id'";
			$delete_data = $this->db->delete($query);
			return $delete_data;
		}
	}
 ?>