<?php
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/ResultsTableServices.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/subsection.php";
class section3report{
	public function section3report(){
		
	}
	public function GetResultsDataForSection($UserID,$CampaignID){
		$resultofsection=array();
	$results=ResultsTableService::GetResultfromUserID($UserID,$CampaignID);
			foreach ($results as $section_result) {
				if($section_result->SectionID==3)
				array_push($resultofsection, $section_result);
			}
		return $resultofsection;
	}
	public function GetSection3Report(){

$result=section3report::GetResultsDataForSection(5,4);
$result_section=array();
$str= $result[0]->Result;
$result_section= (explode("||",$str));

if($result_section[0]==RiskFactor::RiskTypeLow)
{
	$section3overviewrisk="low";
}
else if($result_section[0]==RiskFactor::RiskTypeModerate)
{
	$section3overviewrisk="moderate";
}
else if($result_section[0]==RiskFactor::RiskTypeHigh)
{
	$section3overviewrisk="high";
}

if($result_section[1]==RiskFactor::RiskTypeLow)
{
	$section3fluidrisk="low";
}
else if($result_section[1]==RiskFactor::RiskTypeModerate)
{
	$section3fluidrisk="moderate";
}
else if($result_section[1]==RiskFactor::RiskTypeHigh)
{
	$section3fluidrisk="high";
}


if($result_section[2]==RiskFactor::RiskTypeLow)
{
	$section3saltsugarrisk="low";
}
else if($result_section[2]==RiskFactor::RiskTypeModerate)
{
	$section3saltsugarrisk="moderate";
}
else if($result_section[2]==RiskFactor::RiskTypeHigh)
{
	$section3saltsugarrisk="high";
}



if($result_section[3]==RiskFactor::RiskTypeLow)
{
	$section3foodgrouprisk="low";
}
else if($result_section[3]==RiskFactor::RiskTypeModerate)
{
	$section3foodgrouprisk="moderate";
}
else if($result_section[3]==RiskFactor::RiskTypeHigh)
{
	$section3foodgrouprisk="high";
}



$subsection_array=array();
$subsection=new subsection("section3overviewrisk",$section3overviewrisk);
array_push($subsection_array, $subsection);

$subsection=new subsection("section3fluidrisk",$section3fluidrisk);
array_push($subsection_array, $subsection);

$subsection=new subsection("section3saltsugarrisk",$section3saltsugarrisk);
array_push($subsection_array, $subsection);

$subsection=new subsection("section3foodgrouprisk",$section3foodgrouprisk);
array_push($subsection_array, $subsection);

return $subsection_array;





	}
}

