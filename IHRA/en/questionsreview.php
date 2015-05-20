<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/hraWebSessionServices.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/BasicUserServices.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/campaigncontroller.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/QuestionAnswerController.php";

$BasicUserID=hraWebSessionService::GetCurrentUserObject();
$HRAprofileuser=BasicUserServices::GetBasicUser_userid($BasicUserID);
$cid=$_GET["cid"];
$sid=$_GET["sid"];
$next_section=campaigncontroller::StoreSectionResults($BasicUserID,$cid,$sid);
$server = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
if($next_section!=-1){
	$qid=QuestionAnswerController::GetCurrentQuestionNumber($BasicUserID,$cid,$next_section);
	header( 'Location:http://'.$server.'/IHRA/en/questions.php?cid='.$cid.'&qid='.$qid."&sid=".$next_section.'&rate_value=0' );
	
}
else 
{
	
	header( 'Location:http://'.$server.'/IHRA/en/CampaignComplete.php?cid='.$cid );
}

	
