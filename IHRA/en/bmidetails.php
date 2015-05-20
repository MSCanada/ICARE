<?php
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/hraWebSessionServices.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/BMIDetailsObjects.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/BMIUserDetails.php";
include "../template.php";

$server = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
$BasicUserID=hraWebSessionService::GetCurrentUserObject();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
$cid=$_GET["cid"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
$height_in_feet=$_POST["height_feet"];
$height_in_inches=$_POST["height_inches"];
$weight_in_pounds=$_POST["weight"];
$cid=$_POST["cid"];
$converted_height = ($height_in_feet * 12) + $height_in_inches;
$IsPregnant=false;
$MeasureType="M";
$BMI = $weight_in_pounds * 703 / ($converted_height * $converted_height);

$bmi_details=new BMIDetailsObjects($BasicUserID, $cid, $converted_height, $weight_in_pounds, $BMI, $IsPregnant, $MeasureType);
BMIUserDetails::InsertBMIDetails($bmi_details);


header('Location:http://'.$server.'/IHRA/en/viewcampaign.php?cid='.$cid );

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

<div class="create-bmi"><span class="create-bmi-text"> Calculate BMI </span>
<form role="form" action="#" method="post">
    <div class="form-group">
      <label for="height_feet">Height in Feet</label>
      <input type="text" class="form-control" id="height_feet" name="height_feet"  placeholder="Height in feet">
    </div>
    <div class="form-group">
      <label for="height_inches">Height in Inches</label>
      <input type="text" class="form-control" id="height_inches" name="height_inches"  placeholder="Height in inches">
    </div>
     <div class="form-group">
      <label for="weight">Weight in pounds</label>
      <input type="text" class="form-control" id="weight" name="weight"  placeholder="Weight in pounds">
    </div>
    <div class="form-group">
      
      <input type="hidden" class="form-control" id="cid" name="cid" value="<?php echo $cid ?>"/>
    </div>
      <button type="submit" class="btn btn-default">Submit</button>
  </form> 
</div>

</div>
    
</div>
</div>
	</body>
	</html>


