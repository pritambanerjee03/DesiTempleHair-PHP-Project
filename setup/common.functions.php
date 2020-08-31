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


/**
 * mb_stripos all occurences
 * based on http://www.php.net/manual/en/function.strpos.php#87061
 *
 * Find all occurrences of a needle in a haystack
 *
 * @param string $haystack
 * @param string $needle
 * @return array or false
 */
function mb_stripos_all($haystack, $needle) {
 
  $s = 0;
  $i = 0;
 
  while(is_integer($i)) {
 
    $i = mb_stripos($haystack, $needle, $s);
 
    if(is_integer($i)) {
      $aStrPos[] = $i;
      $s = $i + mb_strlen($needle);
    }
  }
 
  if(isset($aStrPos)) {
    return $aStrPos;
  } else {
    return false;
  }
}
 
/**
 * Apply highlight to row label
 *
 * @param string $a_json json data
 * @param array $parts strings to search
 * @return array
 */
function apply_highlight($a_json, $parts) {
 
  $p = count($parts);
  $rows = count($a_json);
 
  for($row = 0; $row < $rows; $row++) {
 
    $label = $a_json[$row]["label"];
    $a_label_match = array();
 
    for($i = 0; $i < $p; $i++) {
 
      $part_len = mb_strlen($parts[$i]);
      $a_match_start = mb_stripos_all($label, $parts[$i]);
 
      foreach($a_match_start as $part_pos) {
 
        $overlap = false;
        foreach($a_label_match as $pos => $len) {
          if($part_pos - $pos >= 0 && $part_pos - $pos < $len) {
            $overlap = true;
            break;
          }
        }
        if(!$overlap) {
          $a_label_match[$part_pos] = $part_len;
        }
 
      }
 
    }
 
    if(count($a_label_match) > 0) {
      ksort($a_label_match);
 
      $label_highlight = '';
      $start = 0;
      $label_len = mb_strlen($label);
 
      foreach($a_label_match as $pos => $len) {
        if($pos - $start > 0) {
          $no_highlight = mb_substr($label, $start, $pos - $start);
          $label_highlight .= $no_highlight;
        }
        $highlight = mb_substr($label, $pos, $len);
       
        //$highlight = '<span class="hl_results">' . mb_substr($label, $pos, $len) . '</span>';
        $label_highlight .= $highlight;
        $start = $pos + $len;
      }
 
      if($label_len - $start > 0) {
        $no_highlight = mb_substr($label, $start);
        $label_highlight .= $no_highlight;
      }
 
      $a_json[$row]["label"] = $label_highlight;
    }
 
  }
 
  return $a_json;
 
}

?>