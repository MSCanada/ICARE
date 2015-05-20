<?php


include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/HRABaseDAL.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/ActionLogs.php";

class ActionLogsDAL extends HRABaseDAL
{
	public function ActionLogsDAL(){

	}

	public function GetAllRecords(){
		$sql_statement="Select * from ActionLogs";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;


	}

	public function insert($ActionLogs_obj){

		$sql_statement="INSERT INTO ActionLogs(AdminUserID,ActionID,ActionDateTime) VALUES (?,?,?)";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
	$stmt = $conn->prepare($sql_statement);

		$stmt->bind_param("sss",$AdminUserID1,$ActionID1,$ActionDateTime1);
		$AdminUserID1=$ActionLogs_obj->AdminUserID;
		$ActionID1=$ActionLogs_obj->ActionID;
		$ActionDateTime1=$ActionLogs_obj->ActionDateTime;
		$parameter->execute_nonquery($stmt, $conn);
		
		
		
	}


}
$check=new ActionLogs("89","2",date('Y-m-d H:i:s'));
$test=new ActionLogsDAL();
$result=$test->GetAllRecords();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["AdminUserID"]. " - Name: " . $row["ActionID"]. " " . $row["ActionDateTime"]. "<br>";
     
    }
} else {
    echo "0 results";
}
$test->insert($check);