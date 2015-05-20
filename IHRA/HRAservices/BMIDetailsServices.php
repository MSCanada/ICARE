<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/BMIDetailsObjects.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/BMIUserDetails.php";
class BMIDetailsServices{
	public function BMIDetailsServices(){
		
	}
	public function GetBMIDetails($UserID,$CampaignID){
		$result=BMIUserDetails::GetBMIDetails($UserID,$CampaignID);
		
	if($result!=null){	
if ($result->num_rows > 0) {
    // output data of each row
    ($row = $result->fetch_assoc()) ;
    	$BMIDetails=new BMIDetailsObjects($row["UserID"], $row["CampaignID"], $row["Height"], $row["Weight"], $row["BMI"], $row["IsPregnant"], $row["MeasureType"]);
return $BMIDetails;
}
        
    
} 

		
	}
}


