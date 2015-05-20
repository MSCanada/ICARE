<?php
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/hraWebSessionServices.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/BasicUserServices.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/HRAprofileuser.php";
include "../template.php";

$password="";
$status=1;

$department=0;
$count=0;
$EmailAddress="";

$UserStatus=0;
$HashValue=0;

$server = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$nickname= $_POST['firstname'];
$lastname=$_POST['lastname'];
$age=$_POST['age'];
$sex=$_POST['sel1'];
$Language=$_POST['sel2'];
$ProvinceID=$_POST['sel3'];
$IsPrimaryPolicyHolder=$_POST['sel4'];

$hraWebSession=hraWebSessionService::isValidAndLoggedUser();
$certNumber=$hraWebSession->CertNumber;
$result=BasicUserServices::GetBasicUsers($certNumber);
if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			if($row["FirstName"]==$nickname){
				$count=$count+1;
			}
			 
		
	}
}
if($count==0){
$result=BasicUserServices::GetBasicUsers($certNumber);
if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			if($row["IsPrimaryPolicyHolder"]==1){
				$count=$count+1;
			}
			 
		
	}
}
	if($count==1 && $IsPrimaryPolicyHolder==1){
	
	echo "Only one primary policy holder allowed";
	
	}
	else {
		$employer_group=$hraWebSession->EmployerGroup;
		
	$Hraprofileuser=new HRAprofileuser($nickname, $lastname, $password, $age, $sex, $employer_group, $department, $EmailAddress, $Language, $ProvinceID, $UserStatus, $HashValue, $IsPrimaryPolicyHolder, $certNumber);
	BasicUserServices::AddNewUser($Hraprofileuser);
	
	header( 'Location:http://'.$server.'/IHRA/SelectUserProfile.php' );
	}
}
else echo "Name Already registered with this certificate number";

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
	<div class="container-fluid">

    <div class="row">
<div class="col-sm-6 col-sm-push-3">

<div class="create-profile"><span class="create-profile-text"> Create New Profile </span>
<form role="form" action="#" method="post">
    <div class="form-group">
      <label for="firstname">First Name:</label>
      <input type="text" class="form-control" id="firstname" name="firstname"  placeholder="First Name">
    </div>
    <div class="form-group">
      <label for="lastname">Last Name:</label>
      <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
    </div>
    <div class="form-group">
      <label for="age">Age:</label>
      <input type="text" class="form-control" id="age" name="age" placeholder="Age">
    </div>
    <div class="form-group">
  <label for="sel1">Select Gender:</label>
  <select class="form-control" name="sel1"  id="sel1">
    <option value="Male">Male</option>
    <option value="Female">Female</option>
    
  </select>
</div>
<div class="form-group">
  <label for="sel2">Language:</label>
  <select class="form-control" id="sel2" name="sel2">
    <option value="E">English</option>
    <option value="F">French</option>
    
  </select>

</div>

<div class="form-group">
  <label for="sel3">Province:</label>
  <select class="form-control" id="sel3" name="sel3">
    <option value="1">Ontario</option>
    <option value="2">Alberta</option>
    <option value="1">Saskatchewan</option>
    <option value="2">British Columbia</option>
    
  </select>

</div>

<div class="form-group">
  <label for="sel4">Is Primary Policy Holder</label>
  <select class="form-control" id="sel4" name="sel4">
    <option value="1">Yes</option>
    <option value="0">No</option>
    
    
  </select>

</div>



    <button type="submit" class="btn btn-default">Submit</button>
  </form> </div>

</div>
    
</div>
</div>
	</body>
	</html>


