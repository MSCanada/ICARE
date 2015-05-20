<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/HRABaseDAL.php";
class optionsDAL extends HRABaseDAL{
	public function optionsDAL(){
		
	}
	public function GetOptionsByQuestion($QuestionNumber){
		$sql_statement="Select * from Options where QuestionNumber='".$QuestionNumber."'";
		
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
	}
	
	public function GetOptionsByOptionID($OptionID){
		$sql_statement="Select * from Options where OptionID=".$OptionID;
		
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
	}
	
	
	
}