<?php
class BMIDetailsObjects{
	public function BMIDetailsObjects($UserID,$CampaignID,$Height,$Weight,$BMI,$IsPregnant,$MeasureType){
		$this->UserID=$UserID;
		$this->CampaignID=$CampaignID;
		$this->Height=$Height;
		$this->Weight=$Weight;
		$this->BMI=$BMI;
		$this->IsPregnant=$IsPregnant;
		$this->MeasureType=$MeasureType;
	}
}