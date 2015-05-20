<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Hra_Admin\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Hra_Admin\CRUDLayer\Factory;
use Zend\View\Model\ViewModel;
use Hra_Admin\Form\UserForm;
use Hra_Admin\Form\UserFilter;
use Hra_Admin\Model\CampaignSingleton;
use Hra_Admin\CRUDLayer\Insert;
use Zend\Json\Json;
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        
       $form=new UserForm();
     
       $request = $this->getRequest();
 if ($request->isPost()) {

 	$form->setInputFilter(new UserFilter());
    $form->setData($request->getPost());
   
     if ($form->isValid()) {
    $data = $form->getData();
//print_r($data);
$starting_age_limit= $data["starting_age_limit"];
$ending_age_limit= $data["ending_age_limit"];
$campaign_name= $data["campaign_name"];
$language_id= $data["language_id"];
$start_date= $data["start_date"];
$end_date= $data["end_date"];
$province_id= $data["province_id"];
$gender= $data["gender"];
$employer_gp_id= $data["employer_gp_id"];
$campaign=(CampaignSingleton::getInstance($starting_age_limit,$ending_age_limit,$campaign_name,$language_id,$start_date,$end_date,$province_id,$gender,$employer_gp_id));
$array_campaign=(array)$campaign;
Factory::Insert($array_campaign);

}
 	
 }
       return new ViewModel(array('form'=>$form));

    }
public function tableAction(){
    $result=(Factory::select());
    $result_json =  Json::encode($result);
  
      return new ViewModel(array('result'=>$result));
}





}

