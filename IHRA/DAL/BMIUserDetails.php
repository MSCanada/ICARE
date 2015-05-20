<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/HRABaseDAL.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/BMIDetailsObjects.php";
class BMIUserDetails extends HRABaseDAL{
	public function BMIUserDetails(){
		
	}
	public function GetBMIDetails($UserID,$CampaignID){
		$sql_statement="CALL GetBMIDetails('$UserID','$CampaignID')";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
	}
	
	public function InsertBMIDetails($bmidetails){
		$sql_statement="INSERT INTO UserBMIDetails(UserID,CampaignID,Height,Weight,BMI,IsPregnant,MeasureType) VALUES (?,?,?,?,?,?,?)";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
	$stmt = $conn->prepare($sql_statement);

		$stmt->bind_param("iiiisbs",$UserID,$CampaignID,$Height,$Weight,$BMI,$IsPregnant,$MeasureType);
		$UserID=$bmidetails->UserID;
		$CampaignID=$bmidetails->CampaignID;
		$Height=$bmidetails->Height;
		$Weight=$bmidetails->Weight;
		$BMI=$bmidetails->BMI;
		$IsPregnant=$bmidetails->IsPregnant;
		$MeasureType=$bmidetails->MeasureType;
		
		
		$parameter->execute_nonquery($stmt, $conn);
		
	}
	
	
	
	
	
}


