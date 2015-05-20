<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/HRABaseDAL.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/QuestionResponse.php";
class QuestionResponseDAL extends HRABaseDAL{
	public function QuestionResponseDAL(){

	}
	public function GetALlResponseForUser($UserID){
		$sql_statement="Select * from QuestionResponses where UserID="."'".$UserID."'";
		
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		
		$a=array();
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$response=new QuestionResponse($row["UserID"], $row["CampaignID"], $row["SectionID"], $row["QuestionNumber"], $row["OptionID"], $row["CreatedDate"]);
				array_push($a,$response);
			}
		}
	
		return $a;


	}
	
	public function InsertResponse($questionresponse){
		$sql_statement="INSERT INTO QuestionResponses(UserID,CampaignID,SectionID,QuestionNumber,OptionID,CreatedDate) VALUES (?,?,?,?,?,?)";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
	$stmt = $conn->prepare($sql_statement);

		$stmt->bind_param("iiisis",$UserID,$CampaignID,$SectionID,$QuestionNumber,$OptionID,$CreatedDate);
		
		$UserID=$questionresponse->UserID;
		$CampaignID=$questionresponse->CampaignID;
		$SectionID=$questionresponse->SectionID;
		$QuestionNumber=$questionresponse->QuestionNumber;
		$OptionID=$questionresponse->OptionID;
		$CreatedDate=$questionresponse->CreatedDate;
	
		$parameter->execute_nonquery($stmt, $conn);
		
		
	}



}