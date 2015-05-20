<?php
class AdminUser{
	public function AdminUser($UserName,$GroupID,$Password,$IsSuperAdmin,$IsActive,$CreatedDate,$PasswordLastUpdatedDate,$userID){
		$this->UserName=$UserName;
		$this->GroupID=$GroupID;
		$this->Password=$Password;
		$this->IsSuperAdmin=$IsSuperAdmin;
		$this->IsActive=$IsActive;
		$this->CreatedDate=$CreatedDate;
		$this->PasswordLastUpdatedDate=$PasswordLastUpdatedDate;
		$this->userID=$userID;
	}
	
	
	
	
}