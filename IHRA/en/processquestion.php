<?php
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/optionsservices.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/hraWebSessionServices.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/QuestionResponseService.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/QuestionResponse.php";
class processquestion{
	public function processquestion(){
		
	}
}
$cid= $_GET["cid"];
$sid=$_GET["sid"];
echo "<br>";
$oid= $_GET["oid"];

$option_answer=array();
$option_answer=explode("||",$oid);




for($i=0;$i<count($option_answer);$i++){
$options=OptionsServices::GetOptionsByOptionID($option_answer[$i]);

$BasicUserID=hraWebSessionService::GetCurrentUserObject();
$response=new QuestionResponse($BasicUserID, $cid, $sid, $options->QuestionNumber, $options->OptionID,date("Y-m-d"));

QuestionResponseService::InsertResponse($response);

$server = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
$next_Question_number=$options->NextQuestionNumber;
echo $next_Question_number;}
// next question number obtain from options and send it to questions.apsx
if($next_Question_number=="End of section"){
	header( 'Location:http://'.$server.'/IHRA/en/questionsreview.php?cid='.$cid.'&sid='.$sid);
}

else{
	header( 'Location:http://'.$server.'/IHRA/en/questions.php?cid='.$cid.'&qid='.$next_Question_number."&sid=".$sid.'&rate_value=0' );
}