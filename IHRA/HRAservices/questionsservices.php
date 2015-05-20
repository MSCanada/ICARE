<?php
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DomainObjects/questions.php";
include_once $_SERVER['DOCUMENT_ROOT']."/IHRA/DAL/questionsDAL.php";
class questionsservices{
	public function questionsservices(){

	}

	public function GetallQuestions($sectionid){
		$a=array();
		$results=	questionsDAL::GetFirstQuestion($sectionid);
		if ($results->num_rows > 0) {
			// output data of each row
			while($row = $results->fetch_assoc()) {
				$allquestions=new questions($row["SectionID"], $row["QuestionNumber"], $row["QuestionTextEN"]);
				array_push($a, $allquestions);
			}


		}
		return $a;
	}

	public function GetFirstQuestion($sectionid){
		$a=array();
		$allquestions=questionsservices::GetallQuestions($sectionid);
		foreach ($allquestions as $all){
			array_push($a, $all->QuestionNumber);
		}
		arsort($a);
		return $a[0];
	}

	public function GetQuestionByQuestionNumber($QuestionNumber){

		$result=questionsDAL::GetQuestionByQuestionNumber($QuestionNumber);
		if ($result->num_rows > 0) {
			// output data of each row
			($row = $result->fetch_assoc()) ;
			$question=new questions($row["SectionID"], $row["QuestionNumber"], $row["QuestionTextEN"]);



		}




		return $question;
	}



}

