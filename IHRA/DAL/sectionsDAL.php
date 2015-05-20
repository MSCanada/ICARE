<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/HRABaseDAL.php";
class sectionsDAL extends HRABaseDAL{
	public function sectionsDAL(){
		
	}
public function GetSectionName($sectionID){
	$sql_statement="Select * from Sections where SectionID=".$sectionID;
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
}	
	
	
	
}