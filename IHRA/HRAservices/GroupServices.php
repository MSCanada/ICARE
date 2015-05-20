<?php
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/GroupsDAL.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/EmployerGroups.php";
class GroupServices{
	public function GroupServices(){
	}

	public function GetEmployerGroup($employer_group){
		$groups=new GroupsDAL();
		$group_unique=$groups->GetAllEmployerGroupById($employer_group);
		if ($group_unique->num_rows > 0) {
				// output data of each row
				$row = $group_unique->fetch_assoc();
				$employerGroups=new EmployerGroups($row["EmployerGroupID"],$row["EmployerGroupNameEN"],$row["EmployerGroupNameFR"],$row["EmployerGroupMemberCount"],$row["IsActive"],$row["AccessToHRA"]);
	return $employerGroups;
		}

	}
}