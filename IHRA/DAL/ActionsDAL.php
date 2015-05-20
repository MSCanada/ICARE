<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/HRABaseDAL.php";
class ActionsDAL extends HRABaseDAL{
	public function ActionsDAL(){
		
	}
	public function GetAllActions()
	{
		$sql_statement="Select * from Actions";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
	}
	public function GetActionByID($actionID){
		$sql_statement="Select * from Actions where ActionID=".$actionID;
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
		
	}
	
	
}
$test=new ActionsDAL();
$result=$test->GetActionByID(12);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["ActionID"]. " - Name: " . $row["ActionEN"]. " " . $row["ActionFR"]. "<br>";
    }
} else {
    echo "0 results";
}