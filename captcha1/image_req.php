<?php

// Echo the image - timestamp appended to prevent caching
echo '<img src="captcha/images/image.php?' . time() . '" width="120" height="36" style="float:left">';

?>
