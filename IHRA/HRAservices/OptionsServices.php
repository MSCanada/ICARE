<?php
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/options.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/optionsDAL.php";
class OptionsServices{
	public  function OptionsServices(){
		
	}
	public function GetOptionsByQuestion($QuestionNumber){
		$a=array();
	
		$result=optionsDAL::GetOptionsByQuestion($QuestionNumber);
		if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$options=new options($row["OptionID"], $row["OptionOrderNumber"], $row["OptionTextEN"], $row["OptionTextFR"], $row["QuestionNumber"], $row["NextQuestionNumber"], $row["OptionType"], $row["RiskType"]);
   
  
    	array_push($a,$options);
    }
} 
		return $a;
		
	}
	
public function GetOptionsByOptionID($OptionID){
		
	
		$result=optionsDAL::GetOptionsByOptionID($OptionID);
		if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$options=new options($row["OptionID"], $row["OptionOrderNumber"], $row["OptionTextEN"], $row["OptionTextFR"], $row["QuestionNumber"], $row["NextQuestionNumber"], $row["OptionType"], $row["RiskType"]);
   
  
    
    }
} 
		return $options;
		
	}
	
	
	
}