<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/HRABaseDAL.php";
class CampaignsDAL extends HRABaseDAL{
	public function GetAllCampaigns(){
		$sql_statement="Select * from Campaigns";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
		
	
	}
	
	
	
}