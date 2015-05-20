<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/hraWebSessionServices.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/PortalServices.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/BasicUserServices.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/BasicProfileUser.php";

class SelectUserProfile{
	public function SelectUserProfile(){
	}

	public  function CheckValid ($sgid){
		$check_valid=new PortalServices();
		if($check_valid->CheckValidDsfUser($sgid)){
			return true;
		}else return false;

	}

}
clearstatcache();
$hraWebSession=hraWebSessionService::isValidAndLoggedUser();

$hraWeb_Session=0;
if($hraWebSession!=null)
{
	$hraWeb_Session=$hraWebSession->WebSessionGuid;

}
$valid=SelectUserProfile::CheckValid($hraWeb_Session);
if($valid==true)
{
	$hraWebSession=hraWebSessionService::GetCertificateNumber($hraWeb_Session);
	$a=array();
	$certnumber=$hraWebSession->CertNumber;
	$result=BasicUserServices::GetBasicUsers($certnumber);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$user=new BasicProfileUser($row["UserID"], $row["FirstName"], $row["LastName"], $row["EmailAddress"], $row["Password"], $row["Age"], $row["Gender"], $row["EmployerGroup"], $row["Department"], $row["ProvinceID"], $row["Language"], $row["UserStatus"], $row["IsPrimaryPolicyHolder"], $row["CertNumber"], $row["CreatedDate"]);
			//echo "id: " . $row["Age"]. " - Name: " . $row["CertNumber"]. " " . $row["CreatedDate"]." " . $row["Department"]. " " . $row["EmailAddress"]." " . $row["EmployerGroup"]." " . $row["FirstName"]." " . $row["Gender"]." " . $row["IsPrimaryPolicyHolder"]." " . $row["Language"]." " . $row["LastName"]." " . $row["Password"]." " . $row["ProvinceID"]." " . $row["UserID"]." " . $row["UserStatus"]."<br>";
		array_push($a,$user);
		}
	} else {
		echo "0 results";
	}
// Select user ID
if ($_SERVER["REQUEST_METHOD"] == "GET"){
echo json_encode($a);}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$BasicUserID= $_POST['basicuserid'];




$HRAWebSessionGUID=$hraWebSession->HraSessionGuid;
echo true;
hraWebSessionService::updateHRAwebSession($BasicUserID,$HRAWebSessionGUID);



}




}
else echo "invalid user";
?>
