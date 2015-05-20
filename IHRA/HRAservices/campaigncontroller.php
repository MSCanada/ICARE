<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/CampaignsDAL.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/campaign.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/CampaiignServices.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/QuestionResponseService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/QuestionAnswerController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/ResultsForCampandUser.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/BMIDetailsServices.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/HRAprofileuser.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/BasicUserServices.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/sectionsservices.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/ResultsTableServices.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/ResultsTableDAL.php";

class campaigncontroller{
	
	
	
	public function campaigncontroller(){
		
		
		
	}
	public function GetAllCampaigns($HRAprofileuser){
		$userage=$HRAprofileuser->Age;
		$province=$HRAprofileuser->ProvinceID;
		$employergp=$HRAprofileuser->EmployerGroup;
		$campaigns=CampaignsDAL::GetAllCampaigns();
		$language_user=$HRAprofileuser->Language;
		//echo "language is ".$language_user.".";
	
	$livecampaign=array();
	$a=array();
	if ($campaigns->num_rows > 0) {
    // output data of each row
    while($row = $campaigns->fetch_assoc()) {
    	$campaign_new=new campaign("","","","","","","","","","","","","","","","");
    	$campaign_new->CampaignID=$row["CampaignID"];
    	$campaign_new->CampaignNameEN=$row["CampaignNameEN"];
    	$campaign_new->CampaignNameFR=$row["CampaignNameFR"];
    	$campaign_new->Language=$row["Language"];
    	$campaign_new->StartDate=$row["StartDate"];
    	$campaign_new->EndDate=$row["EndDate"];
    	$campaign_new->ProvincesidList=$row["ProvincesidList"];
    	$campaign_new->StartingAgeLimit=$row["StartingAgeLimit"];
    	$campaign_new->EndingAgeLimit=$row["EndingAgeLimit"];
    	$campaign_new->Gender=$row["Gender"];
    	$campaign_new->DepartmentsidList=$row["DepartmentsidList"];
    	$campaign_new->EmployerGroupsidList=$row["EmployerGroupsidList"];
    	$campaign_new->EmployerSubGroupsList=$row["EmployerSubGroupsList"];
    	$campaign_new->CurrentState=$row["CurrentState"];
    	$campaign_new->ClientID=$row["ClientID"];
    	$campaign_new->CreatedDate=$row["CreatedDate"];
   	
         array_push($a, $campaign_new);
    }
} else {
    echo "0 results";
}
foreach ($a as $filtered){
	$provinces=array();
	$provinces=explode(",",$filtered->ProvincesidList);
	$employergps=array();
	$employergps=explode(",",$filtered->EmployerGroupsidList);
	
	$language_campaign=$filtered->Language;
	if($language_campaign=="B" || $language_user==$language_campaign)
	{
		$language_exists=true;
	}
	else 
	{
		$language_exists=false;
	}

	if($filtered->StartingAgeLimit<=$userage && $filtered->EndingAgeLimit>=$userage && $filtered->StartDate<=date("Y-m-d") && $filtered->EndDate>=date("Y-m-d") && $filtered->CurrentState==1 && in_array($province,$provinces)
	&& in_array($employergp,$employergps) && $language_exists)
	{
		array_push($livecampaign, $filtered);
		
	}
}



	return $livecampaign;
		
	}
public function GetNotStartedCampaigns($UserID){
	$HRAprofileuser=BasicUserServices::GetBasicUser_userid($UserID);
	$notstartedcampaign=array();
	$campaigns=campaigncontroller::GetAllCampaigns($HRAprofileuser);
	foreach ($campaigns as  $campaign){
		$count=0;
     $campaign_sections= CampaignServices::GetAllSectionforCampaign($campaign->CampaignID);

		foreach ($campaign_sections as $sec){
			
			$response=QuestionResponseService::GetAllResponseForUserForSection($UserID,$campaign->CampaignID,$sec->SectionID);
			if($response!=null){
				$count=$count+1;
			}

		}
		
		if($count==0){
			array_push($notstartedcampaign,$campaign);
		}
		
		
	}
	
	return ($notstartedcampaign);
	
}

public function GetCompletedCampaignsForUser($userid){
	$HRAprofileuser=BasicUserServices::GetBasicUser_userid($userid);
	$a=array();
$campaigns=campaigncontroller::GetAllCampaigns($HRAprofileuser);

 

foreach($campaigns as $filtered)
{
$section_number=QuestionAnswerController::GetTheCurrentSectionNumber($filtered->CampaignID,$userid);


if($section_number==-1){
array_push($a,$filtered);
		
	}
}
return $a;


}



public function GetInProgressCampaigns($userid){
	$HRAprofileuser=BasicUserServices::GetBasicUser_userid($userid);
	$inprogresscampaign=array();
	$campaigns=campaigncontroller::GetAllCampaigns($HRAprofileuser);
	
	
	foreach ($campaigns as  $campaign){
	$isInProgressCampaigns=false;
     $campaign_sections= CampaignServices::GetAllSectionforCampaign($campaign->CampaignID);
    
     foreach ($campaign_sections as $sec){
			$exists=0;
			$answers_section=QuestionResponseService::GetAllResponseForUserForSection($userid,$campaign->CampaignID,$sec->SectionID);

			$allsections_result=ResultsForCampandUser::GetResult($userid,$campaign->CampaignID);
     foreach ($allsections_result as $all_result){
     	if($all_result->SectionID==$sec->SectionID){
     		
     		$exists=1;//entry exists in results table
     	}
     }
     if((count($answers_section)!=0)&&($exists==0)){
     	//echo "cid:".$campaign->CampaignID." secid:".$sec->SectionID;
     $isInProgressCampaigns=true;
          }
          
          else if((QuestionAnswerController::GetTheCurrentSectionNumber($campaign->CampaignID,$userid)!=-1)&&(BMIDetailsServices::GetBMIDetails($userid,$campaign->CampaignID)!=null)){
        // echo "campaign complete";
          //	echo "cid:".$campaign->CampaignID." secid:".$sec->SectionID;
          	$isInProgressCampaigns=true;
          }
       	
           
          
     }
     if($isInProgressCampaigns==true){
     	//	print_r($campaign);
     	array_push($inprogresscampaign, $campaign);
     }
     
     
	}
	return ($inprogresscampaign);
	
}

public function GetCampaignResults($userid,$campaignid)
{$results=array();
	$a=array();
	$total_section_result="";
	$total_section_name="";
	$results_section=array();
	//ak array hai aur es mei 4 objects hain
	$allresult=array();
	$available_sectionforcampaign=array();
$campaign_sections= CampaignServices::GetAllSectionforCampaign($campaignid);	

foreach ($campaign_sections as $sec) {
	array_push($available_sectionforcampaign, $sec->SectionID);
}

for($i=1;$i<=8;$i++){
	$result_section=sectionsservices::GetSectionName($i);
$sectionname=$result_section->sectionnameEN;
	if(in_array($i, $available_sectionforcampaign))
	{
		$result=ResultsDAL::GetResultForUserIDandCampaign($userid,$campaignid);
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    $allresult=new ResultsTableDAL($row["UserID"], $row["CampaignID"], $row["SectionID"], $row["Result"], $row["SSOS"], $row["CompletionDate"]);
        array_push($a, $allresult);
        
        
    }
} 
foreach ($a as $filtered) {
	if($i==$filtered->SectionID)
	{
		$result_section=$filtered;
	}
	;
}

$sectionresultvalue=$result_section->Result;
$results_section=explode("||",$sectionresultvalue);
$sectionresult=$results_section[0];
$completionDate=$result_section->CompletionDate;

	
	}
else{
	$sectionresult="NA";
}

if($total_section_result!=null)
$total_section_result=$total_section_result."||".$sectionresult;
else 
$total_section_result=$sectionresult;

if($total_section_name!=null)
$total_section_name=$total_section_name."||".$sectionname;
else 
$total_section_name=$sectionname;
	
	

}

array_push($results,$total_section_result);
array_push($results,$total_section_name);
array_push($results,$completionDate);
return ($results);


}




public function StoreSectionResults($userid,$cid,$sid){
	
	switch($sid){
	case "1":
	$next=campaigncontroller::StoreSection1Result($userid,$cid);
	
	break;
	case "2":
	$next=campaigncontroller::StoreSection2Result($userid,$cid);
	
	break;
	
	case "3":
	$next=campaigncontroller::StoreSection3Result($userid,$cid);
	
	break;
	
	case "4":
	$next=campaigncontroller::StoreSection4Result($userid,$cid);
	
	break;
	
	
	
	
	}
	return $next;
}


public function StoreSection4Result($userid,$cid){
	$options_risk=campaigncontroller::GetSectionRiskofOptions($userid, $cid, 4);
	$section4_risktype=RiskFactor::RiskTypeLow;
	if (in_array('High', $options_risk)){
		$section4_risktype=RiskFactor::RiskTypeHigh;
	}
else if (in_array('Moderate', $options_risk)){
		$section4_risktype=RiskFactor::RiskTypeModerate;
	}
	
else if (in_array('Low', $options_risk)){
		$section4_risktype=RiskFactor::RiskTypeLow;
	}
	
	
	$result=new ResultsTableDAL($userid, $cid, '4', $section4_risktype, "", date("Y/m/d"));
ResultsTableService::InsertRecord($result);
	return QuestionAnswerController::NextAvailableSectionForCampaign($cid,"4");
}

public function StoreSection1Result($userid,$cid){
	$options_list=campaigncontroller::GetSectionResults($userid,$cid,1);
	$bmiRiskType=RiskFactor::RiskTypeLow;
	$smokingRiskType=RiskFactor::RiskTypeLow;
	$personalHealthRiskType=RiskFactor::RiskTypeLow;
	$medicationRiskType=RiskFactor::RiskTypeModerate;
	$bloodPressureRiskType=RiskFactor::RiskTypeHigh;
	$bloodGlucoseRiskType=RiskFactor::RiskTypeModerate;
	$bloodCholesterolRiskType=RiskFactor::RiskTypeHigh;
	
	$bmiScore="23";
	$smokingScore="12";
	$personalHealthScore="11";
	$bloodPressureScore="21";
	$bloodGlucoseScore="13";
	$bloodCholesterolScore="11";
	$medicationScore="11";
	
	
	
	
	$bmi_user=BMIDetailsServices::GetBMIDetails($userid,$cid);
	$bmi=$bmi_user->BMI;
	
	if($bmi<24.9){
		$bmiScore="11";
		$bmiRiskType=RiskFactor::RiskTypeLow;
	}
if($bmi>25 && $bmi<29.9){
		$bmiScore="21";
		$bmiRiskType=RiskFactor::RiskTypeModerate;
	}
	if($bmi>=30){
		$bmiScore="31";
		$bmiRiskType=RiskFactor::RiskTypeHigh;
	}

	
if (in_array('15', $options_list))
{
	$smokingScore="11";
	$smokingRiskType=RiskFactor::RiskTypeLow;
}

if (in_array('14', $options_list))
{
	$smokingScore="31";
	$smokingRiskType=RiskFactor::RiskTypeHigh;
}

if (in_array('18', $options_list))
{
	$personalHealthScore="11";
	$personalHealthRiskType=RiskFactor::RiskTypeLow;
}

if (in_array('19', $options_list))
{
	$personalHealthScore="31";
	$personalHealthRiskType=RiskFactor::RiskTypeHigh;
}

if (in_array('20', $options_list))
{
	$personalHealthScore="21";
	$personalHealthRiskType=RiskFactor::RiskTypeModerate;
}


if (in_array('30', $options_list))
{
	$personalHealthScore="11";
	$personalHealthRiskType=RiskFactor::RiskTypeLow;
}

if (in_array('36', $options_list))
{
	$personalHealthScore="11";
	$personalHealthRiskType=RiskFactor::RiskTypeLow;
}

if (in_array('38', $options_list))
{
	$personalHealthScore="11";
	$personalHealthRiskType=RiskFactor::RiskTypeModerate;
}

if (in_array('39', $options_list))
{
	$personalHealthScore="11";
	$personalHealthRiskType=RiskFactor::RiskTypeHigh;
}
if($bmiRiskType==RiskFactor::RiskTypeLow || $smokingRiskType==RiskFactor::RiskTypeLow || $personalHealthRiskType==RiskFactor::RiskTypeLow || $medicationRiskType==RiskFactor::RiskTypeLow || $bloodPressureRiskType==RiskFactor::RiskTypeLow || $bloodGlucoseRiskType==RiskFactor::RiskTypeLow || $bloodCholesterolRiskType==RiskFactor::RiskTypeLow)
$overviewRiskType=RiskFactor::RiskTypeLow;

else if($bmiRiskType==RiskFactor::RiskTypeModerate || $smokingRiskType==RiskFactor::RiskTypeModerate || $personalHealthRiskType==RiskFactor::RiskTypeModerate || $medicationRiskType==RiskFactor::RiskTypeModerate || $bloodPressureRiskType==RiskFactor::RiskTypeModerate || $bloodGlucoseRiskType==RiskFactor::RiskTypeModerate || $bloodCholesterolRiskType==RiskFactor::RiskTypeModerate)
$overviewRiskType=RiskFactor::RiskTypeModerate;

else $overviewRiskType=RiskFactor::RiskTypeHigh;



$Result=$overviewRiskType."||".$bmiRiskType."||".$smokingRiskType."||".$personalHealthRiskType."||".$medicationRiskType."||".$bloodPressureRiskType."||".$bloodGlucoseRiskType."||".$bloodCholesterolRiskType;
$SSOS=$bmiScore."||".$smokingScore."||".$personalHealthScore."||".$medicationScore."||".$bloodPressureScore."||".$bloodGlucoseScore."||".$bloodCholesterolScore;
$result=new ResultsTableDAL($userid, $cid, '1', $Result, $SSOS, date("Y/m/d"));
ResultsTableService::InsertRecord($result);

return QuestionAnswerController::NextAvailableSectionForCampaign($cid,"1");
	
}

public function StoreSection2Result($userid,$cid){
	$options_list=campaigncontroller::GetSectionResults($userid,$cid,2);
	if (in_array('53', $options_list)){
		$section_risk=RiskFactor::RiskTypeLow;
		$SSOS="12";
	}
	if (in_array('54', $options_list)){
		$section_risk=RiskFactor::RiskTypeHigh;
		$SSOS="22";
	}
if (in_array('58', $options_list)){
		$section_risk=RiskFactor::RiskTypeModerate;
		$SSOS="32";
	}
	
if (in_array('60', $options_list)){
		$section_risk=RiskFactor::RiskTypeLow;
		$SSOS="12";
	}
	
if (in_array('63', $options_list)){
		$section_risk=RiskFactor::RiskTypeLow;
		$SSOS="32";
	}
	else{
		$section_risk=RiskFactor::RiskTypeHigh;
		$SSOS="12";
	}
	
	$result=new ResultsTableDAL($userid, $cid, '2', $section_risk, $SSOS, date("Y/m/d"));
ResultsTableService::InsertRecord($result);
	
	
	return QuestionAnswerController::NextAvailableSectionForCampaign($cid,"2");
}
public function StoreSection3Result($userid,$cid){
$options_list=campaigncontroller::GetSectionResults($userid,$cid,3);
if (in_array('65', $options_list)){
		$FGC_Risk =RiskFactor::RiskTypeLow;
		$SSOS_FGC_Risk="12";
	}
	
if (in_array('66', $options_list)){
		$FGC_Risk =RiskFactor::RiskTypeModerate;
		$SSOS_FGC_Risk="11";
	}
	
if (in_array('67', $options_list)){
		$FGC_Risk =RiskFactor::RiskTypeHigh;
		$SSOS_FGC_Risk="12";
	}
	
	else {
		$FGC_Risk =RiskFactor::RiskTypeHigh;
		$SSOS_FGC_Risk="12";
	}
	
if (in_array('68', $options_list)){
		$FIN_Risk =RiskFactor::RiskTypeModerate;
		$SSOS_FIN_Risk="11";
	}

if (in_array('69', $options_list)){
		$FIN_Risk =RiskFactor::RiskTypeLow;
		$SSOS_FIN_Risk="12";
	}
	
if (in_array('71', $options_list)){
		$FIN_Risk =RiskFactor::RiskTypeHigh;
		$SSOS_FIN_Risk="13";
	}
	
	else{
		$FIN_Risk =RiskFactor::RiskTypeLow;
		$SSOS_FIN_Risk="23";
	}
	
if (in_array('72', $options_list)){
		$SSS_Risk =RiskFactor::RiskTypeLow;
		$SSOS_SSS_Risk="11";
	}	
	
if (in_array('73', $options_list)){
		$SSS_Risk =RiskFactor::RiskTypeModerate;
		$SSOS_SSS_Risk="11";
	}
	
if (in_array('75', $options_list)){
		$SSS_Risk =RiskFactor::RiskTypeHigh;
		$SSOS_SSS_Risk="11";
	}
	
	else{
	
		$SSS_Risk =RiskFactor::RiskTypeLow;
		$SSOS_SSS_Risk="11";
	
	}
$overviewrisk=RiskFactor::RiskTypeLow;
if($FGC_Risk==RiskFactor::RiskTypeHigh || $FIN_Risk==RiskFactor::RiskTypeHigh || $SSS_Risk==RiskFactor::RiskTypeHigh)	
$overviewrisk=RiskFactor::RiskTypeHigh;

if($FGC_Risk==RiskFactor::RiskTypeModerate || $FIN_Risk==RiskFactor::RiskTypeModerate || $SSS_Risk==RiskFactor::RiskTypeModerate)	
$overviewrisk=RiskFactor::RiskTypeModerate;

if($FGC_Risk==RiskFactor::RiskTypeLow || $FIN_Risk==RiskFactor::RiskTypeLow || $SSS_Risk==RiskFactor::RiskTypeLow)	
$overviewrisk=RiskFactor::RiskTypeLow;

$risk_section3=$overviewrisk."||".$FGC_Risk."||".$FIN_Risk."||".$SSS_Risk;
$score_section3=$SSOS_FGC_Risk."||".$SSOS_FIN_Risk."||".$SSOS_SSS_Risk;

$result=new ResultsTableDAL($userid, $cid, '3', $risk_section3,$score_section3, date("Y/m/d"));
ResultsTableService::InsertRecord($result);

return QuestionAnswerController::NextAvailableSectionForCampaign($cid,"3");


}
public function GetSectionResults($userid,$cid,$sid){
	$options_list=array();
	$result=QuestionResponseService::GetAllResponseForUserForSection($userid,$cid,$sid);
foreach ($result as $filtered){
	array_push($options_list,$filtered->OptionID);
}
return $options_list;
	
}

public function GetSectionRiskofOptions($userid,$cid,$sid){
	$options_list=array();
	$result=QuestionResponseService::GetAllResponseForUserForSection($userid,$cid,$sid);
foreach ($result as $filtered){
	array_push($options_list,$filtered->OptionType);
}
return $options_list;
	
}






}

class RiskFactor{
	const RiskTypeLow=1;
	const RiskTypeModerate=2;
	const RiskTypeHigh=3;
	const RiskTypeNA='NA';
	
}


