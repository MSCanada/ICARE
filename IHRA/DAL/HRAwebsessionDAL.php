
<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/HRABaseDAL.php";
class HRAwebsessionDAL extends HRABaseDAL{
public function insert($ActionLogs_obj){

		$sql_statement="INSERT INTO HRAWebSessions(BasicUserID,CertNumber,CreatedDate,EmployerGroup,HraSessionGuid,WebSessionGuid) VALUES (?,?,?,?,?,?)";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
	$stmt = $conn->prepare($sql_statement);

		$stmt->bind_param("isssss",$BasicUserID,$CertNumber,$CreatedDate,$EmployerGroup,$HraSessionGuid,$WebSessionGuid);
		$BasicUserID=$ActionLogs_obj->BasicUserID;
		$CertNumber=$ActionLogs_obj->CertNumber;
		$CreatedDate=$ActionLogs_obj->CreatedDate;
		$EmployerGroup=$ActionLogs_obj->EmployerGroup;
		$HraSessionGuid=$ActionLogs_obj->HraSessionGuid;
		$WebSessionGuid=$ActionLogs_obj->WebSessionGuid;
		
		
		
		
		$parameter->execute_nonquery($stmt, $conn);
		
		
		
	}
	
	public function GetWebSessionForGuid($guid){
		$sql_statement="Select * from HRAWebSessions where HraSessionGuid="."'".$guid."'";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
		
	}
	
	public function UpdateHRAWebSession($BasicUserID,$HRASessionGuid){
		$sql_statement="Update HRAWebSessions SET BasicUserID=? where HraSessionGuid=?";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
	$stmt = $conn->prepare($sql_statement);

		$stmt->bind_param("is",$BasicUserID,$HRASessionGuid);
		$parameter->execute_nonquery($stmt, $conn);
		
		
		
		
	}
	
	
	
	
	
}

