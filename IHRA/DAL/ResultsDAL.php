<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/HRABaseDAL.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/ResultsTableDAL.php";
class ResultsDAL extends HRABaseDAL{
	public function GetResultForUserIDandCampaign($UserID,$CampaignID){
		$sql_statement="Select * from ResultsTable where UserID="."'".$UserID."'"." and CampaignID="."'".$CampaignID."'";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
	}
	
	public function AddResultForSection($results){
		$sql_statement="INSERT INTO ResultsTable(UserID,CampaignID,SectionID,Result,SSOS,CompletionDate) VALUES (?,?,?,?,?,?)";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
	$stmt = $conn->prepare($sql_statement);

		$stmt->bind_param("iiisss",$UserID,$CampaignID,$SectionID,$Result,$SSOS,$CompletionDate);
		$UserID=$results->UserID;
		$CampaignID=$results->CampaignID;
		$SectionID=$results->SectionID;
		$Result=$results->Result;
		$SSOS=$results->SSOS;
		$CompletionDate=$results->CompletionDate;
		$parameter->execute_nonquery($stmt, $conn);
	}
	
	
	
	
}