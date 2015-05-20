<?php
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/hraWebSessionServices.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/BasicUserServices.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/QuestionAnswerController.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/BMIDetailsServices.php";
class viewcampaign{
	public function viewcampaign(){
		
	}		
}
$server = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
$BasicUserID=hraWebSessionService::GetCurrentUserObject();
$HRAprofileuser=BasicUserServices::GetBasicUser_userid($BasicUserID);
$cid=$_GET["cid"];
$currentsectionnumber=QuestionAnswerController::GetTheCurrentSectionNumber($cid,$BasicUserID);

if($currentsectionnumber==-1)
{
	header( 'Location:http://'.$server.'/IHRA/en/campaignsummary.php?cid='.$cid );
	
}
else if($currentsectionnumber==-2)
{
	header( 'Location:http://'.$server.'/IHRA/error.html' );
}

else {
	$bmidetails=BMIDetailsServices::GetBMIDetails($BasicUserID,$cid);
	if($currentsectionnumber==1 && $bmidetails==null){
		header( 'Location:http://'.$server.'/IHRA/en/bmidetails.php?cid='.$cid );

		
	}
	else{
		$qid=QuestionAnswerController::GetCurrentQuestionNumber($BasicUserID,$cid,$currentsectionnumber);
		
		header( 'Location:http://'.$server.'/IHRA/en/questions.php?cid='.$cid.'&qid='.$qid."&sid=".$currentsectionnumber.'&rate_value=0' );
	
	}
}
