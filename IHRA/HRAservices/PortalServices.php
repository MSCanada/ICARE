<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/WebSessionDAL.php";
class PortalServices{
	public function PortalServices(){
		
	}
	public function CheckValidDsfUser($session_guid){
		$test=new WebSessionDAL();
		$result=$test->GetUserBySession($session_guid);
	if ($result->num_rows > 0) {
    return true;
    
} else {
    return false;
}
	}
	
	public function GetEmployerGroup($session_guid){
		$test=new WebSessionDAL();
		$result=$test->GetUserBySession($session_guid);
	if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc(); 
       $employerGroup= $row["groupNumber"];
       return $employerGroup;
    
} 
		

		
	}
	
public function GetCertNumber($session_guid){
		$test=new WebSessionDAL();
		$result=$test->GetUserBySession($session_guid);
	if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc(); 
       $certNumber= $row["certNumber"];
       return $certNumber;
    
} 
		

		
	}
	
	
	
}

