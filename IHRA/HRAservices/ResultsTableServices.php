<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/ResultsDAL.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/ResultsTableDAL.php";

class ResultsTableService{
	public function ResultsTableService(){
		
	}
	public function InsertRecord($Result){
		ResultsDAL::AddResultForSection($Result);
	}
	
	public function GetResultfromUserID($UserID,$CampaignID){
		$a=array();
	$result=ResultsDAL::GetResultForUserIDandCampaign($UserID,$CampaignID);
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$results=new ResultsTableDAL($row["UserID"], $row["CampaignID"], $row["SectionID"], $row["Result"], $row["SSOS"], $row["CompletionDate"]);
   
  
    	array_push($a,$results);
    }
} 
	
	return $a;
	
	
	
	}
	
	
}