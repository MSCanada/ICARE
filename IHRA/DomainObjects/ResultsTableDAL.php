<?php
class ResultsTableDAL{
	public function ResultsTableDAL($UserID,$CampaignID,$SectionID,$Result,$SSOS,$CompletionDate){
		$this->UserID=$UserID;
		$this->CampaignID=$CampaignID;
		$this->SectionID=$SectionID;
		$this->Result=$Result;
		$this->SSOS=$SSOS;
		$this->CompletionDate=$CompletionDate;
	}
}