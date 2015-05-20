<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/BasicUsersDAL.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/HRAprofileuser.php";
class BasicUserServices{
	public function BasicUserServices(){
		
	}
	public function GetBasicUsers($certNumber){
		$result=BasicUsersDAL::GetALlBasicUsers($certNumber);
	return $result;
	}
	
	public function AddNewUser($HRAprofileuser){
		BasicUsersDAL::AddNewBasicUsers($HRAprofileuser);
	}
	public function GetBasicUser_userid($UserID){
		$result=BasicUsersDAL::GetUser_ID($UserID);
		if ($result->num_rows > 0) {
				// output data of each row
				$row = $result->fetch_assoc();
				$Hraprofileuser=new HRAprofileuser($row["FirstName"], $row["LastName"], $row["Password"], $row["Age"], $row["Gender"], $row["EmployerGroup"],$row["Department"],$row["EmailAddress"],$row["Language"],$row["ProvinceID"],$row["UserStatus"],"",$row["IsPrimaryPolicyHolder"],"");
				return $Hraprofileuser;
		}
		
	}
	
}
