<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/QuestionResponseService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/CampaiignServices.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/ResultsDAL.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/ResultsTableDAL.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/questionsservices.php";
class QuestionAnswerController{
	public function GetTheCurrentSectionNumber($campaign_id,$user_id){
		$currentsectionnumber=-1;
		$lastsection=QuestionAnswerController::GetLastAnsweredSectionForUser($campaign_id,$user_id);
		//echo $lastsection."<br>";
		if($lastsection==0)
		{
		$currentsectionnumber=QuestionAnswerController::GetFirstAllowedSectionForCampaign($campaign_id);
		
		}
	else if(QuestionAnswerController::IsSectionCompleted($user_id,$campaign_id,$lastsection)){
		
		$currentsectionnumber=QuestionAnswerController::NextAvailableSectionForCampaign($campaign_id,$lastsection);
		
	}
	else{
		$currentsectionnumber=$lastsection;
	}
	if($currentsectionnumber==0){
		$currentsectionnumber=$currentsectionnumber+1;
	}
	return $currentsectionnumber;
		
		
		
			}
			
		public function GetFirstAllowedSectionForCampaign($id){
			$a=array();
			$sections=CampaignServices::GetAllSectionforCampaign($id);
	
			foreach ($sections as $filtered)
			{
				array_push($a,$filtered->SectionID);
			}
			arsort($a);
		
			return $a[0];
		}	
			
			
	public function GetLastAnsweredSectionForUser($campaign_id,$user_id){
		$maxsectionid=0;
		$a=array();
		$response=QuestionResponseService::GetAllResponseForUserForCampaign($campaign_id,$user_id);
		
		if(count($response)>0){
			foreach ($response as $filtered){
				array_push($a,$filtered->SectionID);
			}
			arsort($a);
		
			return $a[count($a)-1];
			
		}
		else return $maxsectionid;
		
	}
	
	public function IsSectionCompleted($userid,$campaignid,$max_sectionid){
		
		$a=array();
		$count=0;
		$result=ResultsDAL::GetResultForUserIDandCampaign($userid,$campaignid);
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    $allresult=new ResultsTableDAL($row["UserID"], $row["CampaignID"], $row["SectionID"], $row["Result"], $row["SSOS"], $row["CompletionDate"]);
        array_push($a, $allresult);
        
        
    }
} else {
   // echo "0 results";
}
	
foreach ($a as $filtered){
		if($filtered->SectionID==$max_sectionid){
			$count=1;
		}
		
	}	
	if ($count==1)
	return true;
	else return false;
	}
	
	public function NextAvailableSectionForCampaign($campaignID,$sectionID){
		$nextavailablesectionnumber=null;
		$a=array();
		$sections=CampaignServices::GetAllSectionforCampaign($campaignID);
		foreach ($sections as $filtered)
			{
				array_push($a,$filtered->SectionID);
			}
			arsort($a);
			for ($i=0;$i<count($a);$i++){
				if($a[$i]==$sectionID)
				$nextavailablesectionnumber=$i+1;
			}
			
			  if($nextavailablesectionnumber<count($a)){
		
			return $a[$nextavailablesectionnumber];
			  }
			  else return -1;
			
			
			
	}
	public function GetCurrentQuestionNumber($userid,$campaignid,$SectionID){
		$last_answered_question=QuestionAnswerController::GetLastAnsweredQuestionNumber($userid, $campaignid, $SectionID);
	if($last_answered_question==null){
		$current_question_number=questionsservices::GetFirstQuestion($SectionID);
		
	}
	else {
		$current_question_number=$last_answered_question;
	}
	
	return $current_question_number;
	}
	
	
	
	
	public function GetLastAnsweredQuestionNumber($user_id,$campaign_id,$sectionID){
		$created_date=array();
		$last_answered_question=null;
		$response=QuestionResponseService::GetAllResponseForUserForCampaign($campaign_id,$user_id);
	if(count($response)>0){
			foreach ($response as $filtered){
				if($filtered->SectionID==$sectionID){
					array_push($created_date, $filtered->CreatedDate);
				}
			}
			arsort($created_date);
			if($created_date!=null){
			$last_created_date=$created_date[count($created_date)-1];	
	foreach ($response as $filtered){
				if($filtered->SectionID==$sectionID && $filtered->CreatedDate==$last_created_date){
					$last_answered_question=$filtered->QuestionNumber;
				}
			}	
			}
			
			
		}
		return $last_answered_question;
	}
	
	
	
}

