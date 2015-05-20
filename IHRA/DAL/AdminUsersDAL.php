<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/HRABaseDAL.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/AdminUser.php";

class AdminUsersDAL extends HRABaseDAL{
public function AdminUsersDAL(){
	
} 
public function GetByUserID($userID){
	$sql_statement="Select * from AdminUsers where userID=".$userID;
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
}
public  function GetByUserName($username){
	$sql_statement="Select * from dminUsers where UserName="."'".$username."'";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
	
}
public  function GetAll(){
	$sql_statement="Select * from AdminUsers";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
}
public  function AddNewUser($adminUser){
	$sql_statement="INSERT INTO AdminUsers(UserName,GroupID,Password,IsSuperAdmin,IsActive,CreatedDate,PasswordLastUpdatedDate) VALUES (?,?,?,?,?,?,?)";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
	$stmt = $conn->prepare($sql_statement);

		$stmt->bind_param("sssiiss",$Username,$GroupID,$Password,$IsSuperAdmin,$IsActive,$CreatedDate,$PasswordLastUpdatedDate);
		$Username=$adminUser->UserName;
		$GroupID=$adminUser->GroupID;
		$Password=$adminUser->Password;
		$IsSuperAdmin=$adminUser->IsSuperAdmin;
		$IsActive=$adminUser->IsActive;
		$CreatedDate=$adminUser->CreatedDate;
		$PasswordLastUpdatedDate=$adminUser->PasswordLastUpdatedDate;
	
		$parameter->execute_nonquery($stmt, $conn);
}
		public function UpdateUser($adminUser){
			$sql_statement="UPDATE AdminUsers SET UserName=?,GroupID=?,Password=?,IsSuperAdmin=?,IsActive=?,CreatedDate=?,PasswordLastUpdatedDate=? WHERE userID=?";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
	$stmt = $conn->prepare($sql_statement);

		$stmt->bind_param("sssiissi",$Username,$GroupID,$Password,$IsSuperAdmin,$IsActive,$CreatedDate,$PasswordLastUpdatedDate,$userID);
		$Username=$adminUser->UserName;
		$GroupID=$adminUser->GroupID;
		$Password=$adminUser->Password;
		$IsSuperAdmin=$adminUser->IsSuperAdmin;
		$IsActive=$adminUser->IsActive;
		$CreatedDate=$adminUser->CreatedDate;
		$PasswordLastUpdatedDate=$adminUser->PasswordLastUpdatedDate;
		$userID=$adminUser->userID;
	
		$parameter->execute_nonquery($stmt, $conn);

			

		
		}
		public function GetUserByGuid($guidvalue){
			$sql_statement="Select AdminUsers.* from AdminUserLoginSessions INNER JOIN AdminUsers ON AdminUserLoginSessions.userID=AdminUsers.userID where AdminUserLoginSessions.SessionGuid="."'".$guidvalue."'";
		$parameter=new HRABaseDAL();//initializing an object to send query to execute
		$conn=$parameter->set_up_connection();
		$result=$parameter->execute_query($conn,$sql_statement);
		return $result;
			
			
		}
	
	
	

}
$test=new AdminUser("qasim3", "DEmo", "cricke", 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'),0);
$test1=new AdminUsersDAL();
$result=$test1->GetUserByGuid("343-545");
//$test1->AddNewUser($test);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["UserName"].$row["GroupID"].$row["Password"].$row["IsSuperAdmin"].$row["IsActive"].$row["CreatedDate"].$row["PasswordLastUpdatedDate"];
    }
} else {
    echo "0 results";
}