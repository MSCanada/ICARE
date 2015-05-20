<?php
namespace Hra_Admin\Form;

use Zend\Form\Form;

class UserForm extends Form

{
    
    public function __construct($name = null)
    {
        parent::__construct('user');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'campaign_name',
            'attributes' => array(
                'type'  => 'text',
                'class'=>'cam_name'
            ),
            'options' => array(
                'label' => 'Campaign Name',
            ),
        ));
        
    $this->add(array(
            'name' => 'language_id',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'class'=>'lang_id'
            ),
            'options' => array(
                'label' => 'Language',
                'value_options' => array(
                    'E' => 'English',
                    'F' => 'French',
                    'B' => 'Both',
                ),
            ),
        )); 

      
        $this->add(array(
            'name' => 'start_date',
            'attributes' => array(
                'type'  => 'date',
                'class'=>'date'
            ),
            'options' => array(
                'label' => 'Start Date',
                'format' => 'Y-m-d',
            ),
        ));


 $this->add(array(
            'name' => 'end_date',
            'attributes' => array(
                'type'  => 'date',
                'class'=>'date'
            ),
            'options' => array(
                'label' => 'End Date',
                'format' => 'Y-m-d',
            ),
        ));

$this->add(array(
            'name' => 'province_id',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'class'=>'prov_id'
            ),
            'options' => array(
                'label' => 'Language',
                'value_options' => array(
                    '1' => 'Ontario',
                    '2' => 'Quebec',
                    '3' => 'Saskatchewan',
                    '4' => 'Alberta',
                ),
            ),
        )); 

$this->add(array(
            'name' => 'starting_age_limit',
            'attributes' => array(
                'type'  => 'text',
                'class'=>'age'
            ),
            'options' => array(
                'label' => 'Starting Age',
            ),
        ));

$this->add(array(
            'name' => 'ending_age_limit',
            'attributes' => array(
                'type'  => 'text',
                'class'=>'age'
            ),
            'options' => array(
                'label' => 'Ending Age',
            ),
        ));

$this->add(array(
        'type' => 'Zend\Form\Element\Radio',
        'name' => 'gender',
        'attributes' => array(
               'class'=>'gender'
            ),
        'options' => array(
            'label' => 'Gender',
            'value_options' => array(
                '0' => 'Female',
                '1' => 'Male',
            ),
        ),
    ));

$this->add(array(
            'name' => 'employer_gp_id',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                
                'class'=>'emp_gp'
            ),
            'options' => array(
                'label' => 'Employer Group',
                'value_options' => array(
                    'DemoGroupNumber' => 'DemoGroupNumber',
                    
                ),
            ),
        )); 

 $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        )); 

    
    }
}
