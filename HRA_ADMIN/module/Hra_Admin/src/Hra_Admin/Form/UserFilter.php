<?php
namespace Hra_Admin\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

class UserFilter extends InputFilter
{
	public function __construct()
	{
		// self::__construct(); // parnt::__construct(); - trows and error
		$this->add(array(
			'name'     => 'campaign_name',
			'required' => true,
			'filters'  => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
				array('name' => 'StripNewlines'),
				
			),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min'      => 1,
						'max'      => 100,
					),
				),
			),
		));
$this->get('campaign_name')->setErrorMessage('Campaign Name cannot be empty');
       
		
		$this->add(array(
			'name'     => 'employer_gp_id',
			'required' => true,
			'filters'  => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
				array('name' => 'StripNewlines'),
			),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min'      => 1,
						'max'      => 20,
					),
				),
			),
		));
$this->get('employer_gp_id')->setErrorMessage('Employer Group cannot be empty');

		$this->add(array(
			'name'     => 'starting_age_limit',
			'required' => true,
			'filters'  => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
				array('name' => 'StripNewlines'),
			),
			'validators' => array(
				array(
					'name'    => 'Digits',
					
				),
			),
		));
$this->get('starting_age_limit')->setErrorMessage('Starting age cannot be empty');

$this->add(array(
			'name'     => 'ending_age_limit',
			'required' => true,
			'filters'  => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
				array('name' => 'StripNewlines'),
			),
			'validators' => array(
				array(
					'name'    => 'Digits',
					
				),
			),
		));
//$this->get('ending_age_limit')->setErrorMessage('Ending age cannot be empty');

$this->add(array(
			'name'     => 'start_date',
		
			'filters'  => array(
				
			),
			'validators' => array(
				array(
					'name'    => 'Date',
					'message' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "Please enter User Name!"
                            ),			
					
				),
			),
		));
$this->get('start_date')->setErrorMessage('Starting date cannot be empty');

$this->add(array(
			'name'     => 'end_date',
			'required' => true,
			'filters'  => array(
				
			),
			'validators' => array(
				array(
					'name'    => 'Date',
					
				),
			),
		));


$this->get('end_date')->setErrorMessage('End date cannot be empty');

$this->add(array(
			'name'     => 'gender',
			'required' => true,
			'filters'  => array(
				
			),
			'validators' => array(
				
			),
		));


$this->get('gender')->setErrorMessage('Gender cannot be empty');


	



	
	}
}