<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/CampaignSections.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/CampaignServiceSections.php";
class CampaignServices{
	public function CampaignServices(){
		
		
	}
	public function GetAllSectionforCampaign($id){
		$section=CampaignSections::GetAllSectionforCampaign($id);
	
		$a=array();
		if ($section->num_rows > 0) {
    // output data of each row
    while($row = $section->fetch_assoc()) {
    	$campaign_section=new CampaignServiceSections($row["CampaignID"],$row["SectionID"], $row["CreatedDate"]);
   
  
    	array_push($a,$campaign_section);
    }
} 

return $a;
	}
	
	
	
}