
<?php
set_time_limit(0);
include "../template.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/hraWebSessionServices.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/campaigncontroller.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/BasicUserServices.php";
$BasicUserID=hraWebSessionService::GetCurrentUserObject();
$HRAprofileuser=BasicUserServices::GetBasicUser_userid($BasicUserID);
//echo $HRAprofileuser->FirstName;
$completed_campaigns=campaigncontroller::GetCompletedCampaignsForUser($BasicUserID);
$inprogress_campaigns=campaigncontroller::GetInProgressCampaigns($BasicUserID);
$notstarted_campaigns=campaigncontroller::GetNotStartedCampaigns($BasicUserID);
if ($_SERVER["REQUEST_METHOD"] != "POST") {
//print_r ($completed_campaigns);
//print_r ($inprogress_campaigns);
//print_r ($notstarted_campaigns);	

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	  
</head>
<body>
<div class="container-fluid">

    <div class="row">
<div class="col-sm-4 ">

<p id="completed-campaign">Completed Campaigns</p>
<?php foreach ($completed_campaigns as $campaigns) {
	echo "<a href=\"viewcampaign.php?cid=".$campaigns->CampaignID."\">". $campaigns->CampaignNameEN."</a>";
	//echo $campaigns->CampaignNameEN;
	echo "<br>";
}?>

</div>

<div class="col-sm-4">
<p id="inprogress-campaign">InProgress Campaigns</p>
<?php foreach ($inprogress_campaigns as $campaigns) {
	echo "<a href=\"viewcampaign.php?cid=".$campaigns->CampaignID."\">". $campaigns->CampaignNameEN."</a>";
	//echo $campaigns->CampaignNameEN;
	echo "<br>";
}?>
</div>
    <div class="col-sm-4 ">
<p id="notstarted-campaign">Not Started Campaigns</p>
<?php foreach ($notstarted_campaigns as $campaigns) {
	echo "<a href=\"viewcampaign.php?cid=".$campaigns->CampaignID."\">". $campaigns->CampaignNameEN."</a>";
	//echo $campaigns->CampaignNameEN;
	echo "<br>";
}?>
</div>
</div>
</div>
</body>
</html>
