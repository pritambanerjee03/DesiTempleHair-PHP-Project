<?php
session_start();
if(isset($_SESSION['adminId']) && $_SESSION['adminId']!=''){

}else{
 header('location:http://www.chitki.com');
 exit;
}
require_once('setup/config.php');
require_once('setup/common.functions.php');
require_once('classes/class.db.php');
require_once('classes/class.oauth.php');
require_once('classes/class.report_handler.php');
require_once('admin.fns.php');
 $db = new DB();
 $report= new report_handler();
 $adminEnd = new adminEnd();
    $aColumns = array( 'id', 'invoiceNo', 'fullName', 'mobileNumber', 'orderStatus','paymentType','onlinePaymentStatus','userId','foundUsOn','chicken','mutton','source');
    
    /* Indexed column (used for fast and accurate table cardinality) */
    $sIndexColumn = "id";
    
    /* DB table to use */
    $sTable = "order_details";
    
    /* 
     * Paging
     */
    $sLimit = "";
    if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
    {
        $sLimit = "LIMIT ".$db->filter( $_GET['iDisplayStart'] ).", ".
            $db->filter( $_GET['iDisplayLength'] );
    }
    
    
    /*
     * Ordering
     */
    if ( isset( $_GET['iSortCol_0'] ) )
    {
        $sOrder = "ORDER BY ";
        $sOrder .= 'dateTime desc, ';
        for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
        {
            if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
            {
                $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
                    ".$db->filter( $_GET['sSortDir_'.$i] ) .", ";
            }
        }
        
        $sOrder = substr_replace( $sOrder, "", -2 );
        if ( $sOrder == "ORDER BY" )
        {
            $sOrder = "";
        }
    }
    
    
    /* 
     * Filtering
     * NOTE this does not match the built-in DataTables filtering which does it
     * word by word on any field. It's possible to do here, but concerned about efficiency
     * on very large tables, and MySQL's regex functionality is very limited
     */
    $sWhere = "";
    if ( $_GET['sSearch'] != "" )
    {
        $sWhere = "WHERE (";
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            $sWhere .= $aColumns[$i]." LIKE '%".$db->filter( $_GET['sSearch'] )."%' OR ";
        }
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ')';
    }
    
    /* Individual column filtering */
    for ( $i=0 ; $i<count($aColumns) ; $i++ )
    {
        if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
        {
            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
            $sWhere .= $aColumns[$i]." LIKE '%".$db->filter($_GET['sSearch_'.$i])."%' ";
        }
    }
    
    
    /*
     * SQL queries
     * Get data to display
     */
    $sQuery = "SELECT ".str_replace(" , ", " ", implode(", ", $aColumns))." FROM $sTable $sWhere $sOrder $sLimit";
    $rResult = $db->get_results( $sQuery);
    
    /* Data set length after filtering */
    $sQuery = "SELECT ".$sIndexColumn." FROM $sTable $sWhere";
    $iFilteredTotal = $db->num_rows( $sQuery);
    
    /* Total data set length */
    $sQuery = "SELECT ".$sIndexColumn." FROM $sTable";
    $iTotal = $db->num_rows( $sQuery);
       
    
    /*
     * Output
     */
    $output = array(
        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );
    $k=$_GET['iDisplayStart'];
    array_push($aColumns,"action");
    foreach ($rResult as $aRow) {
        $userOrdercount = $adminEnd->getUserOrderCount($aRow['userId']);
        //$userOrderedChicken = $adminEnd->getUserOrderedChicken($aRow['id']);
        //$userOrderedMutton = $adminEnd->getUserOrderedMutton($aRow['id']);  
        $row = array();
        $k++;
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {   
            
            if ( $aColumns[$i] == "orderStatus" )
            {  
                $orderStatus = $aRow[$aColumns[$i]]; 
                if($orderStatus == 'Cancel'){ $orderStatusVal = "Canceled";}else{ $orderStatusVal = $orderStatus; }
                $row[] = $orderStatusVal;
            }
            else if ( $aColumns[$i] == "id" )
            {
                /* Special output formatting for 'id' column */
                $orderId = $aRow[$aColumns[$i]];
                $orderId = $aRow[$aColumns[$i]];
                $source = '<span class="orderSource">';
                if($aRow['source']=='web'){
                   // $source .= '<span class="fa fa-globe fa-lg" aria-hidden="true" title="Web"></span>';
                }else if($aRow['source']=='android'){
                    $source .= '<span class="fa fa-android fa-lg" aria-hidden="true" title="Android"></span>';
                }else if($aRow['source']=='ios'){
                   $source .= '<span class="fa fa-apple fa-lg" aria-hidden="true" title="Ios"></span>'; 
                }else if($aRow['source']=='windows'){
                   $source .= '<span class="fa fa-windows fa-lg" aria-hidden="true" title="windows"></span>'; 
                } 
                $source .='</span>';                                             
                $row[] = $k.'&nbsp;'.$source;               
            }
            else if ( $aColumns[$i] == "action" )
            {
                $foundUsOnVal ='';
                $userCountVal = '';
                $OrderedChickenVal = '';
                $OrderedMuttonVal = '';
                /* Special output formatting for 'action' column */
                if($userOrdercount =='1'){ $userCountVal = "<i class='fa fa-th-list alert-success' title='New order'></i>&nbsp;<span class='alert-success' title='New order'>(".$userOrdercount.")</span>";}else{ $userCountVal = "<a href=\"".APP_URL."/index.php?page=manageUsersOrder&userId=".$aRow['userId']."\" title='See all orders'><i class='fa fa-th-list'></i></a>&nbsp;<span title='Save order'>(".$userOrdercount.")</span>";}
                if($aRow['foundUsOn']!='NA'){ $foundUsOnVal ="<a href=\"#\" title=".$aRow['foundUsOn']." style=\"width:10px;height:10px;-webkit-border-radius: 99px;-moz-border-radius: 99px;border-radius: 99px;background-color:#E3A20B;padding:3px\">#".substr($aRow['foundUsOn'], 0, 1)."</a> ";}
                if($aRow['chicken']==1){ $OrderedChickenVal = "<a href=\"#\" title=\"Chicken\" style=\"width:10px;height:10px;-webkit-border-radius: 99px;-moz-border-radius: 99px;border-radius: 99px;background-color:#BD1212;color:#fff;padding:3px\">#C</a>";}
                if($aRow['mutton']==1){ $OrderedMuttonVal = "<a href=\"#\" title=\"Mutton\" style=\"width:10px;height:10px;-webkit-border-radius: 99px;-moz-border-radius: 99px;border-radius: 99px;background-color:#BD1212;color:#fff;padding:3px\">#M</a>";}
                                                
                $row[] = '<a href="'.APP_URL.'/index.php?page=viewOrderDetail&orderId='.$orderId.'" title="View Order Detail"><i class="fa fa-eye"></i></a>&nbsp;<a href="'.APP_URL.'/index.php?page=editOrderDetail&orderId='.$orderId.'&orderStatus='.$orderStatus.'&prevPage=manageOrders" title="Edit Order Detail"><i class="fa fa-pencil-square-o"></i></a>&nbsp;'.$userCountVal.'&nbsp;'.$OrderedChickenVal.'&nbsp;'.$OrderedMuttonVal.'&nbsp;'.$foundUsOnVal;

            }
            else if( $aColumns[$i] == "paymentType" )
            {
                if($aRow[ $aColumns[$i] ] =='Online')
                {
                   if($aRow[$aColumns[6]] == 'Complete'){
                     $aRow[$aColumns[6]] = 'Paid';
                   } 
                   $onlinePaymentStatus = '- '.$aRow[$aColumns[6]];
                }else{
                    $onlinePaymentStatus = '';
                }
                $row[] = $aRow[ $aColumns[$i] ]." ".$onlinePaymentStatus ;
            }
            else if ($aColumns[$i] == 'invoiceNo' || $aColumns[$i] == 'fullName' || $aColumns[$i] == 'mobileNumber')
            {
                /* General output */
                $row[] = $aRow[ $aColumns[$i] ];
            }
       
        }

        $output['aaData'][] = $row;
    }
    
    echo json_encode( $output );
?>
