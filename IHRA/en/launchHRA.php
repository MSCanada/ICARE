<?php
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/PortalServices.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/hraWebSessionServices.php";

include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/GroupServices.php";


class launchHRA{

	public function launchHRA(){
	}
	public function getGUID(){
		if (function_exists('com_create_guid')){
			return com_create_guid();
		}else{
			mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
			$charid = strtoupper(md5(uniqid(rand(), true)));
			$hyphen = chr(45);// "-"
			$uuid = chr(123)// "{"
			.substr($charid, 0, 8).$hyphen
			.substr($charid, 8, 4).$hyphen
			.substr($charid,12, 4).$hyphen
			.substr($charid,16, 4).$hyphen
			.substr($charid,20,12)
			.chr(125);// "}"
			return $uuid;
		}
	}

}

$server = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
$sgid=$_GET["sgid"];
$test=new launchHRA();
if (strcmp($sgid, null)!=0)
{
	if(strlen($sgid)<50)

	{
		$check_valid=new PortalServices();
		if($check_valid->CheckValidDsfUser($sgid)){
			clearstatcache();
			$employer_group=$check_valid->GetEmployerGroup($sgid);
			echo $employer_group;
			echo "valid user";
			$groups=new GroupServices();
			$employerGroups=$groups->GetEmployerGroup($employer_group);
			if ($employerGroups!=null){
					
				echo $employerGroups->EmployerGroupNameEN;
				if($employerGroups->AccessToHRA)
				{
					$create_guid=new launchHRA();
					$guid= $create_guid->getGUID();// create GUID
					setcookie("HRAguidString", $guid, time() + (86400 * 30), "/");
					$certNumber=$check_valid->GetCertNumber($sgid);
					$HRAwebsession=new hraWebSessionService();
					
					
						$HRAwebsession->AddNewUserSession($sgid, $certNumber, $employer_group, $guid);
					
					header( 'Location:http://'.$server.'/IHRA/SelectUserProfile.php' );
						
						
				}
				else echo "Access not allowed";

			}
			else{

			 header( 'Location:http://'.$server.'/IHRA/error.html' );
			}
				
		}
		else
		echo "invalid user";
	}
}


