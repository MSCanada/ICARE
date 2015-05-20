<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/ResultsDAL.php";
class ResultsForCampandUser{
	public function ResultsForCampandUser(){
		
	}
	
	public function GetResult($userid,$campaignid){
		$a=array();
$result=ResultsDAL::GetResultForUserIDandCampaign($userid,$campaignid);
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    $allresult=new ResultsTableDAL($row["UserID"], $row["CampaignID"], $row["SectionID"], $row["Result"], $row["SSOS"], $row["CompletionDate"]);
        array_push($a, $allresult);
        
        
    }
} else {
   // echo "0 results";
}
return $a;
	}
}


	
