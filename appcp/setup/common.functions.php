<?

function getSiteData($siteId){

	$sql="SELECT email, phone1, phone2, siteName, domainName FROM users WHERE siteId='".$siteId."'";
	$res=mysql_query($sql) or die('page: common.functions.php  - Error:'.mysql_error());
	$row=mysql_fetch_assoc($res);
	return $row;
}

function getLogo($siteId){

	$sql="SELECT logo FROM setting WHERE siteId='".$siteId."'";
	$res=mysql_query($sql) or die('page: common.functions.php  - Error:'.mysql_error());
	$row=mysql_fetch_assoc($res);
	return $row['logo'];
}


function appointmentEmailTemplate($msgContent,$siteId){

	$siteData=getSiteData($siteId);
	$logo='';
	$logo=getLogo($siteId);

	$contacts= "";;
	$contacts[]=$siteData['phone1'];
	if(!empty($siteData['phone2'])){
		$contacts[]=$siteData['phone2'];
	}

	$newContacts=implode(", ", $contacts);	
	$contactContent='';

	if($newContacts!=''){
		$contactContent='<div style="display:block; padding:0 0 0 50px; margin:0 0 5px; word-wrap:break-word; max-width:230px; position:relative;"><span style="float:left; width:50px; position:absolute; left:0; top:0;">Phone:</span>'.$newContacts.'</div>';		
	}

	$contactContent.='<div style="display:block; padding:0 0 0 50px; margin:0 0 0px; word-wrap:break-word; max-width:230px; position:relative;"><span style="float:left; width:50px; position:absolute; left:0; top:0;">Email:</span>'.$siteData['email'].'</div>';

	$content.='<table width="600"  border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;  background-color:#0866C6; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#FFF;"  >
	
	<tr>
		 <td valign="middle" height="83">
		 	<div style="display:inline-block; padding:17px; width: 566px; ">
			 	<div style="background: none repeat scroll 0 0 rgba(255, 255, 255, 0.2); float: left; height: 55px; padding: 3px; width: 170px;">
					<a href="'.$siteData['domainName'].'" target="_blank" style="display: table-cell; height:55px;  vertical-align: middle;  width: 170px;">
						<img src="'.$logo.'" style=" float: left;  max-height: 55px; max-width: 170px;" alt="'.$siteData['siteName'].'">
					</a>
				</div>

				<div style="float: right; height: 55px; padding: 0px; max-width: 280px;">
					<div style="display: table-cell; height:55px;  vertical-align: middle;  width: 170px;">
						'.$contactContent.'
					</div>
				</div>			 
		</td>
	</tr>

	<tr>
			<td  valign="top" >
				<div style="display:inline-block; padding:15px 15px 7px; width: 566px; background-color:#fff; color:#444; font-size:12px;  margin:0 2px; ">
				'.$msgContent.'
				</div>
			</td>
		</tr>
		<tr>
		 <td valign="top">

			 <div style="display:inline-block; float:left; margin:0px; padding:8px 17px; width: 566px;  color:#0f5695; font-size:13px; text-align:center;">

			 	<a href="http://www.realtyweb.in/demo" style=" color: #FFF;  text-decoration:none;  ">www.kumarrealty.in</a>
								
		</td>
	</tr>

	</table>';
	return $content;

}

	function getExtension($image)
	{     
		$m=0;
		$extension=explode(".",$image);		
		$ext=strtolower(end($extension));
		//$extension=explode(".",$image);
		//$ext=strtolower($extension[1]);
		if($ext=="jpg" || $ext=="jpeg" || $ext=="png" || $ext=="gif")
		{
		 $m=0;
		return $ext;
		}
		else{
			$m=1;
			 return $ext; 
		 }	
	}

	function randomPassword() {
    $alphabet = 'abcdefghjkmnpqrstuvwxyz23456789';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
function humanTiming ($time){

                    $time = time() - $time; // to get the time since that moment
                    $time = ($time<1)? 1 : $time;
                    $tokens = array (
                        31536000 => 'year',
                        2592000 => 'month',
                        604800 => 'week',
                        86400 => 'day',
                        3600 => 'hour',
                        60 => 'minute',
                        1 => 'second'
                    );

                    foreach ($tokens as $unit => $text) {
                        if ($time < $unit) continue;
                        $numberOfUnits = floor($time / $unit);
                        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
                    }

    }
    function get_all_substrings($input, $delim = '') {
	    $arr = explode($delim, $input);
	    $out = array();
	    for ($i = 0; $i < count($arr); $i++) {
	        for ($j = $i; $j < count($arr); $j++) {
	            $out[] = implode($delim, array_slice($arr, $i, $j - $i + 1));
	        }       
	    }
	    return $out;
	}
?>