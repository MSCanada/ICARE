<?php
namespace Hra_Admin\CRUDLayer;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\TableGateway\TableGateway;
use Hra_Admin\CRUDLayer\Insert;
use Hra_Admin\CRUDLayer\Select;


class Factory{
public function insert($campaign){
$table_campaign=Factory::getDB();
Insert::perform($table_campaign,$campaign);
}

public function select(){
$table_campaign=Factory::getDB();
$campaign_array=Select::perform($table_campaign,"");
return $campaign_array;
}







	public function getDB()
    {
       $table_campaign=  new TableGateway(
                'campaigns', 
                AbstractActionController::getServiceLocator()->get('Zend\Db\Adapter\Adapter')
//              
            );
       
        return $table_campaign;
    }
}



?>