<?php	
	require_once('setup/config.php');
	require_once('setup/common.functions.php');
	require_once('classes/class.db.php');
	require_once('classes/class.oauth.php');
	require_once('classes/class.report_handler.php');
	$db = new DB();
   
    $query = "SELECT * FROM ".PRODUCT_ATTRIBUTE_VALUES." WHERE productAttributeId='1'";
    $results = $db->get_results( $query );
    
  foreach($results as $key => $value) {
    $row[$key]['id'] = $value['id'];
    $row[$key]['name'] = $value['attributeValue'];  
} 
$data = $row;
echo json_encode($data);
?>    