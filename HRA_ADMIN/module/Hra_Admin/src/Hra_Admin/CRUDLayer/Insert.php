<?php
namespace Hra_Admin\CRUDLayer;
class Insert implements InterfaceCRUD{
	public function perform($table_campaign,$campaign){
$table_campaign->insert($campaign);
	}
	
}

?>