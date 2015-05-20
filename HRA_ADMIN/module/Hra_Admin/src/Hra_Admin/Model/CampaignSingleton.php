<?php
namespace Hra_Admin\Model;

 class CampaignSingleton{

public static function getInstance($starting_age_limit,$ending_age_limit,$campaign_name,$language_id,$start_date,$end_date,$province_id,$gender,$employer_gp_id){

$campaign=new CampaignSingleton();	
$campaign->StartingAgeLimit=$starting_age_limit;
$campaign->EndingAgeLimit=$ending_age_limit;
$campaign->CampaignNameEN=$campaign_name;
$campaign->Language=$language_id;
$campaign->StartDate=$start_date;
$campaign->EndDate=$end_date;
$campaign->ProvincesidList=$province_id;
$campaign->Gender=$gender;
$campaign->EmployerGroupsidList=$employer_gp_id;
return $campaign;
}




}

?>