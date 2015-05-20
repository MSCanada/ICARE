<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/connection_string.php";

class HRABaseDAL{

	public function HRABaseDAL(){
	
	}
	
	public function set_up_connection(){
		$connection=new mysqli(servername, username,password,dbname);
		return $connection;
	}

	public function execute_query($conn,$query1){
		


		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$result = $conn->query($query1);

		return $result;

		$conn->close();

	}
	public function execute_nonquery($stmt,$conn){
	

		// set parameters and execute

		$stmt->execute();
		echo $conn->error;
		$stmt->close();
		$conn->close();


	}

}
