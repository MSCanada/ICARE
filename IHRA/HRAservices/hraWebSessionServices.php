<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/HRAwebsessionDAL.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/HRAWebsession.php";

class hraWebSessionService{
	public function hraWebSessionService()
	{
		
	}
	public function AddNewUserSession($sessionGUID,$certNumber,$employerGroup,$hraGuidString){
		$HRA=new HRAwebsessionDAL();
		$HRAWebSession_obj=new HRAWebSession(0, $certNumber, date('Y-m-d H:i:s'), $employerGroup, $hraGuidString, $sessionGUID);
		$HRA->insert($HRAWebSession_obj);
		
		
	}
	public function isValidAndLoggedUser(){
	
		$guid= $_COOKIE["HRAguidString"];
		$result=HRAwebsessionDAL::GetWebSessionForGuid($guid);
		if ($result->num_rows > 0) {
				// output data of each row
				$row = $result->fetch_assoc();
				$HraWebSession=new HRAWebSession($row["BasicUserID"], $row["CertNumber"], $row["CreatedDate"], $row["EmployerGroup"], $row["HraSessionGuid"], $row["WebSessionGuid"]);
				
	return $HraWebSession;
		}
	}
	
	public function GetCertificateNumber($sgid)
	{

		$guid= $_COOKIE["HRAguidString"];
		$result=HRAwebsessionDAL::GetWebSessionForGuid($guid);
		if ($result->num_rows > 0) {
				// output data of each row
				$row = $result->fetch_assoc();
				$HraWebSession=new HRAWebSession($row["BasicUserID"], $row["CertNumber"], $row["CreatedDate"], $row["EmployerGroup"], $row["HraSessionGuid"], $row["WebSessionGuid"]);
				
	return $HraWebSession;
		}
		
	}
	public function GetCurrentUserObject(){
		$guid=$_COOKIE["HRAguidString"];
		$result=HRAwebsessionDAL::GetWebSessionForGuid($guid);
		if ($result->num_rows > 0) {
				// output data of each row
				$row = $result->fetch_assoc();
	$BasicUserID= $row["BasicUserID"];
	return $BasicUserID;
		}
		
	}
	
	public function updateHRAwebSession($BasicUserID,$HRAWebSessionGUID){
		HRAwebsessionDAL::UpdateHRAWebSession($BasicUserID,$HRAWebSessionGUID);
	}
	
	
	
}