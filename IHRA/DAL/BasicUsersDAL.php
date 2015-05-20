<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/HRABaseDAL.php";
class BasicUsersDAL extends HRABaseDAL{
	public function BasicUsersDAL() {
		
	}
	
	public function GetALlBasicUsers($certNumber){
		$sql_statement="Select * from BasicUsers where CertNumber="."'".$certNumber."'";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
	}
	
	public function AddNewBasicUsers($HRAuser){
		$sql_statement="INSERT INTO BasicUsers(FirstName,LastName,EmailAddress,Password,Age,Gender,EmployerGroup,Department,ProvinceID,Language,UserStatus,IsPrimaryPolicyHolder,CertNumber) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
	$stmt = $conn->prepare($sql_statement);

		$stmt->bind_param("ssssisssisiis",$FirstName,$LastName,$EmailAddress,$Password,$Age,$Gender,$EmployerGroup,$Department,$ProvinceID,$Language,$UserStatus,$IsPrimaryPolicyHolder,$CertNumber);
		
		$FirstName=$HRAuser->FirstName;
		$LastName=$HRAuser->LastName;
		$EmailAddress=$HRAuser->EmailAddress;
		$Password=$HRAuser->Password;
		$Age=$HRAuser->Age;
		$Gender=$HRAuser->Gender;
		$EmployerGroup=$HRAuser->EmployerGroup;
		$Department=$HRAuser->Department;
		$ProvinceID=$HRAuser->ProvinceID;
		$Language=$HRAuser->Language;
		$UserStatus=$HRAuser->UserStatus;
		$IsPrimaryPolicyHolder=$HRAuser->IsPrimaryPolicyHolder;
		$CertNumber=$HRAuser->CertificateNumber;
	
		$parameter->execute_nonquery($stmt, $conn);
		
	}
	public function GetUser_ID($BasicUSerID){
		$sql_statement="Select * from BasicUsers where UserID="."'".$BasicUSerID."'";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
	}
	
	
	
	
}