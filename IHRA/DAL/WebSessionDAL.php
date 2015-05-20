<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/HRABaseDAL.php";
class WebSessionDAL extends HRABaseDAL{
	
	public function WebSessionDAL(){
		
	}
	public function GetUserBySession($sessionGuid){
		$sql_statement="Select * from webSession where sessionID="."'".$sessionGuid."'"." and sessionStatus=1";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
	}
	
	
	
	
	
}
