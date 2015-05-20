<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/HRABaseDAL.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/AdminPasswordLog.php";
class AdminPasswordLogDAL extends HRABaseDAL{
	
	public function AdminPasswordLogDAL(){
		
	}
	
	public function GetAll()
	{
		$sql_statement="Select * from AdminPasswordLog";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
		
	}
	
	public function Insert($AdminPasswordLogDAL){
	$sql_statement="Insert into AdminPasswordLog(AdminUserID,OldPassword,CreatedDate) values(?,?,?)";
	
	$parameter=new HRABaseDAL();//initializing an object to send query to execute
	$conn=$parameter->set_up_connection();
	$stmt = $conn->prepare($sql_statement);

		$stmt->bind_param("sss",$AdminUserID,$OldPassword,$CreatedDate);


		$AdminUserID=$AdminPasswordLogDAL->AdminUserID;
		$OldPassword=$AdminPasswordLogDAL->OldPassword;
		$CreatedDate=$AdminPasswordLogDAL->CreatedDate;
		$parameter->execute_nonquery($stmt, $conn);
		
	
	
		
	}
	
	
}
$test=new AdminPasswordLogDAL();
$test1=new AdminPasswordLog(88, 88, date('Y-m-d H:i:s'));
$test->Insert($test1);

