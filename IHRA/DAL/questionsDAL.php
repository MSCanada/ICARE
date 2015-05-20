<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/HRABaseDAL.php";

class questionsDAL extends HRABaseDAL{
	public function questionsDAL(){
		
	}
	
	public function GetFirstQuestion($sectionid){
		$sql_statement="Select * from Questions where SectionID=".$sectionid;
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
	}
	public function  GetQuestionByQuestionNumber($QuestionNumber){
		$sql_statement="Select * from Questions where QuestionNumber='".$QuestionNumber."'";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
	}
	
	
	
	
	
}