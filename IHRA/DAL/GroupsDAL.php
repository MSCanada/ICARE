<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/HRABaseDAL.php";
class GroupsDAL extends  HRABaseDAL{
	public function GroupsDAL(){
		
	}
	public function GetAllEmployerGroupById($groupID){
		
		$sql_statement="Select * from EmployerGroups where EmployerGroupID="."'".$groupID."'";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
	}
	
}


