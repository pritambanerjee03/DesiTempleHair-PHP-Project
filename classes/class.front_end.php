<?php 
class front_end {

    function front_end() {
        $db = new DB();
    }

function redirect($url,$time=0) {
        if($time==0){
            if(!headers_sent()) {
                header('Location: http://'.$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '' . $url);
            }
            else{
                die('Could not redirect; Headers already sent.');
            }
        }
        else{
            if(!headers_sent()){
                header('Refresh: $time; URL="http://'.$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . $url.'"');
                echo "<p>You are being redirected !</p>(If your browser doesn't support this, <a href=\"http://".$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/" . $url."\">click here</a>)";
            }
            else{
                die('Could not redirect; Headers already sent.');
            }
        }
    }
}    