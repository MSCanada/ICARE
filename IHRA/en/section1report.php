<?php
set_time_limit(0);
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/ResultsTableServices.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/subsection.php";
class section1report{
	public function section1report(){
		
	}
	public function GetResultsDataForSection($UserID,$CampaignID){
		$resultofsection=array();
	$results=ResultsTableService::GetResultfromUserID($UserID,$CampaignID);
			foreach ($results as $section_result) {
				if($section_result->SectionID==1)
				array_push($resultofsection, $section_result);
			}
		return $resultofsection;
	}
public function GetSection1Report(){
	
$result=section1report::GetResultsDataForSection(5,4);
$result_section=array();
$str= $result[0]->Result;
$result_section= (explode("||",$str));
if($result_section[0]==RiskFactor::RiskTypeLow)
{
	$section1overviewrisk="low";
}
else if($result_section[0]==RiskFactor::RiskTypeModerate)
{
	$section1overviewrisk="moderate";
}
else if($result_section[0]==RiskFactor::RiskTypeHigh)
{
	$section1overviewrisk="high";
}

if($result_section[1]==RiskFactor::RiskTypeLow)
{
	$section1bmirisk="low";
}
else if($result_section[1]==RiskFactor::RiskTypeModerate)
{
	$section1bmirisk="moderate";
}
else if($result_section[1]==RiskFactor::RiskTypeHigh)
{
	$section1bmirisk="high";
}


if($result_section[2]==RiskFactor::RiskTypeLow)
{
	$section1smokingrisk="low";
}
else if($result_section[2]==RiskFactor::RiskTypeModerate)
{
	$section1smokingrisk="moderate";
}
else if($result_section[2]==RiskFactor::RiskTypeHigh)
{
	$section1smokingrisk="high";
}


if($result_section[3]==RiskFactor::RiskTypeLow)
{
	$section1personalhealthrisk="low";
}
else if($result_section[3]==RiskFactor::RiskTypeModerate)
{
	$section1personalhealthrisk="moderate";
}
else if($result_section[3]==RiskFactor::RiskTypeHigh)
{
	$section1personalhealthrisk="high";
}


if($result_section[4]==RiskFactor::RiskTypeLow)
{
	$section1mediacalrisk="low";
}
else if($result_section[4]==RiskFactor::RiskTypeModerate)
{
	$section1mediacalrisk="moderate";
}
else if($result_section[4]==RiskFactor::RiskTypeHigh)
{
	$section1mediacalrisk="high";
}

if($result_section[5]==RiskFactor::RiskTypeLow)
{
	$section1bloodpressurerisk="low";
}
else if($result_section[5]==RiskFactor::RiskTypeModerate)
{
	$section1bloodpressurerisk="moderate";
}
else if($result_section[5]==RiskFactor::RiskTypeHigh)
{
	$section1bloodpressurerisk="high";
}

if($result_section[6]==RiskFactor::RiskTypeLow)
{
	$section1bloodglucoserisk="low";
}
else if($result_section[6]==RiskFactor::RiskTypeModerate)
{
	$section1bloodglucoserisk="moderate";
}
else if($result_section[6]==RiskFactor::RiskTypeHigh)
{
	$section1bloodglucoserisk="high";
}

if($result_section[7]==RiskFactor::RiskTypeLow)
{
	$section1bloodcholesterolrisk="low";
}
else if($result_section[7]==RiskFactor::RiskTypeModerate)
{
	$section1bloodcholesterolrisk="moderate";
}
else if($result_section[7]==RiskFactor::RiskTypeHigh)
{
	$section1bloodcholesterolrisk="high";
}
/*
echo $section1overviewrisk;
echo "<br>";

echo $section1bmirisk;
echo "<br>";

echo $section1smokingrisk;
echo "<br>";

echo $section1personalhealthrisk;
echo "<br>";

echo $section1mediacalrisk;
echo "<br>";

echo $section1bloodpressurerisk;
echo "<br>";

echo $section1bloodglucoserisk;
echo "<br>";

echo $section1bloodcholesterolrisk;
echo "<br>";
*/

$subsection_array=array();
$subsection=new subsection("section1overviewrisk",$section1overviewrisk);
array_push($subsection_array, $subsection);


$subsection=new subsection("section1bmirisk",$section1bmirisk);
array_push($subsection_array, $subsection);


$subsection=new subsection("section1smokingrisk",$section1smokingrisk);
array_push($subsection_array, $subsection);


$subsection=new subsection("section1personalhealthrisk",$section1personalhealthrisk);
array_push($subsection_array, $subsection);


$subsection=new subsection("section1mediacalrisk",$section1mediacalrisk);
array_push($subsection_array, $subsection);


$subsection=new subsection("section1bloodpressurerisk",$section1bloodpressurerisk);
array_push($subsection_array, $subsection);


$subsection=new subsection("section1bloodglucoserisk",$section1bloodglucoserisk);
array_push($subsection_array, $subsection);


$subsection=new subsection("section1bloodcholesterolrisk",$section1bloodcholesterolrisk);
array_push($subsection_array, $subsection);
return $subsection_array;
}

	
}



class RiskFactor{
	const RiskTypeLow=1;
	const RiskTypeModerate=2;
	const RiskTypeHigh=3;
	const RiskTypeNA='NA';
	
}

