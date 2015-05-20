<?php
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/ResultsTableServices.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/subsection.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/en/section1report.php";
class section2report{
	public function section2report(){
		
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

public function GetSection2Report(){

$result=section2report::GetResultsDataForSection(5,4);
$result_section=array();
$str= $result[0]->Result;
$result_section= (explode("||",$str));
if($result_section[0]==RiskFactor::RiskTypeLow)
{
	$section2overviewrisk="low";
}
else if($result_section[0]==RiskFactor::RiskTypeModerate)
{
	$section2overviewrisk="moderate";
}
else if($result_section[0]==RiskFactor::RiskTypeHigh)
{
	$section2overviewrisk="high";
}

$subsection_array=array();
$subsection=new subsection("section2overviewrisk",$section2overviewrisk);
array_push($subsection_array, $subsection);
return $subsection_array;

}

	
}


