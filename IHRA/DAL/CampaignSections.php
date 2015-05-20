<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/HRABaseDAL.php";
class CampaignSections extends HRABaseDAL{
	public function CampaignSections(){
		
	}
	public function GetAllSectionforCampaign($id){
		$sql_statement="Select * from CampaignSectionTransaction where CampaignID="."'".$id."'";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
	}
	
	
}