<? 
class report_handler { 
	var $error;
	var $message;
	var $report;
	/* Constructor
	*/
	function report_handler() {
		$this->message = $this->getReport();
	}
	/*	This Function populates the array with reports (ERRORS,MESSAGES)
	*	Syntax: setReport($reportType,$string)
	*/
	function setReport($reportType,$string='')	{
		$_SESSION[$reportType] = $string;
	}
	/* Output the report to the user
	*/
	function getReport() {
		if(isset($_SESSION['message']))
			$message = "<p><strong>Message: </strong>".$_SESSION['message']."</p>";
		else
			$message = NULL;
		return $message;
	}
	/* Reset the array ellements
	*/
	function resetReport()	{
		if(isset($_SESSION['message']))
		   unset($_SESSION['message']);
	}
}
/**********************************************************
*************** TEST For the error Class and its Functions*/
/*$report = new report_handler();
$report->setReport('Message','e.g. Succesfull login');
$report->resetReport();
$report->setReport('Error','Syntax Error');
$report->getReport();
//$report->validateReportTypes('message');
*/
?>
