<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/sectionsDAL.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/sections.php";

class sectionsservices{
	public function sectionsservices(){
		
	}
public function GetSectionName($sectionID){
	$result=sectionsDAL::GetSectionName($sectionID);
if ($result->num_rows > 0) {
				// output data of each row
				$row = $result->fetch_assoc();
				$section=new sections($row["SectionID"], $row["SectionNameEN"], $row["SectionNameFR"]);
				return $section;
		}
}	
	
	
	
}