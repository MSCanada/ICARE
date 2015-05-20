<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/HRABaseDAL.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/AdminUserLoginSession.php";
class AdminUserLoginSessionDAL extends HRABaseDAL{
	public function AdminUserLoginSessionDAL(){

	}

	public function GetBySessionGuid($guid){
		$sql_statement="Select * from AdminUserLoginSessions where SessionGuid="."'".$guid."'";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
	}

	public function CreateNewRecord($adminUserLoginSession)
	{
		$sql_statement="INSERT INTO AdminUserLoginSessions(SessionGuid,userID,sessionStatus) VALUES (?,?,?)";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$stmt = $conn->prepare($sql_statement);

		$stmt->bind_param("ssi",$SessionGuid,$userID,$sessionStatus);
		$SessionGuid=$adminUserLoginSession->SessionGuid;
		$userID=$adminUserLoginSession->userID;
		$sessionStatus=$adminUserLoginSession->sessionStatus;

		$parameter->execute_nonquery($stmt, $conn);
	}
	public function Update($adminUserLoginSession)
	{

		$sql_statement="UPDATE AdminUserLoginSessions SET sessionStatus=? WHERE userID=? and SessionGuid=?";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$stmt = $conn->prepare($sql_statement);

		$stmt->bind_param("iss",$sessionStatus,$userID,$SessionGuid);
		$sessionStatus=$adminUserLoginSession->sessionStatus;
		$userID=$adminUserLoginSession->userID;
		$SessionGuid=$adminUserLoginSession->SessionGuid;

		$parameter->execute_nonquery($stmt, $conn);

	}

}
$test=new AdminUserLoginSession(0,"23","444");
$test1=new AdminUserLoginSessionDAL();
$result=$test1->GetBySessionGuid("343-545");
//$test1->Update($test);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["SessionGuid"].$row["userID"].$row["sessionStatus"];
    }
} else {
    echo "0 results";
}