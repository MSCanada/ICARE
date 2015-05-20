<?php
namespace Hra_Admin\CRUDLayer;
class Select implements InterfaceCRUD{
	public function perform($table_campaign,$campaign){
$result=$table_campaign->select();
	$result->buffer();
	return $result;
	}
	
}
?>