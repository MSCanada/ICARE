<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/QuestionResponseDAL.php";
class QuestionResponseService{
	public function QuestionResponseService(){
		
	}
	public function GetAllResponseForUserForSection($UserID,$CampaignID,$SectionID){
		$a=array();
		$response=QuestionResponseDAL::GetALlResponseForUser($UserID);
		
		foreach($response as $filtered)
		{
			if (($filtered->CampaignID==$CampaignID)&&($filtered->SectionID==$SectionID)){
				array_push($a,$filtered);
			}
			
			
		}
	
	return $a;	
	}	
	
	public function GetAllResponseForUserForCampaign($campaign_id,$user_id){
		$a=array();
		$response=QuestionResponseDAL::GetAllResponseForUser($user_id);
		foreach ($response as $filtered) {
			if($filtered->CampaignID==$campaign_id){
				array_push($a,$filtered);
			}
		}
		return $a;
		
	}
	
	public function InsertResponse($response){
		QuestionResponseDAL::InsertResponse($response);
	}
	
	
	
	
	}
