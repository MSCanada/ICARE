<?php
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/ResultsTableServices.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/subsection.php";
class section4report{
	public function section4report(){
		
	}
	public function GetResultsDataForSection($UserID,$CampaignID){
		$resultofsection=array();
	$results=ResultsTableService::GetResultfromUserID($UserID,$CampaignID);
			foreach ($results as $section_result) {
				if($section_result->SectionID==2)
				array_push($resultofsection, $section_result);
			}
		return $resultofsection;
	}
	public function GetSection4Report(){
		$result=section4report::GetResultsDataForSection(5,4);
$result_section=array();
$str= $result[0]->Result;
$result_section= (explode("||",$str));
if($result_section[0]==RiskFactor::RiskTypeLow)
{
	$section4overviewrisk="low";
}
else if($result_section[0]==RiskFactor::RiskTypeModerate)
{
	$section4overviewrisk="moderate";
}
else if($result_section[0]==RiskFactor::RiskTypeHigh)
{
	$section4overviewrisk="high";
}

$subsection_array=array();
$subsection=new subsection("section4overviewrisk",$section4overviewrisk);
array_push($subsection_array, $subsection);

return $subsection_array;


	}
	
}


