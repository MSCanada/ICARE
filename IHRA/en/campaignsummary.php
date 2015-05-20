<?php
include "../template.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/hraWebSessionServices.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/en/section1report.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/en/section2report.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/en/section3report.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/en/section4report.php";
$cid=$_GET["cid"];
$BasicUserID=hraWebSessionService::GetCurrentUserObject();
$section1report=section1report::GetSection1Report();
//print_r($section1report);
$section2report=section2report::GetSection2Report();
//print_r($section2report);

$section3report=section3report::GetSection3Report();
$section4report=section4report::GetSection4Report();
//print_r($section4report);
?>
<div class="container-fluid">

<div class="row">
<div class="col-sm-3 section1-border ">
<h4> Section1 Report</h4>
<p><?php 
foreach ($section1report as $section) {
	echo $section->subsection_name;
	echo " :";
	echo $section->risk_factor;
	echo "<br>";

}

?>
	</p>

</div>

<div class="col-sm-3 section2-border">
<h4> Section2 Report</h4>
<p><?php 
foreach ($section2report as $section) {
	echo $section->subsection_name;
	echo " :";
	echo $section->risk_factor;
	echo "<br>";

}

?>
	</p>
</div>
 <div class="col-sm-3 section3-border ">
<h4> Section3 Report</h4>
<p><?php 
foreach ($section3report as $section) {
	echo $section->subsection_name;
	echo " :";
	echo $section->risk_factor;
	echo "<br>";

}

?>
	</p>
</div>
<div class="col-sm-3 section4-border">
<h4> Section4 Report</h4>
<p><?php 
foreach ($section4report as $section) {
	echo $section->subsection_name;
	echo " :";
	echo $section->risk_factor;
	echo "<br>";

}

?>
	</p>
</div>

</div>
</div>