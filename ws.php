<?php

# Use the link format below: add a month and a year
# http://localhost/payroll/ws.php?month=?&year=?

require_once 'payroll.php';

$wsMonth = isset( $_GET['month'] ) ? intval( $_GET['month'] ) : '' ;
$wsYear = isset( $_GET['year'] ) ? intval( $_GET['year'] ) : '' ;

if( $wsMonth && $wsYear ) {

	$wsPayroll = new payroll();
	$wsPayroll->setters($wsMonth, $wsYear);
	$wsPayrollDate = $wsPayroll->getSubmissionDate();
	
	$returnJsonDate = array( "$wsPayrollDate" ) ;
	
	header('Content-type: application/json') ;
	echo json_encode($returnJsonDate);
	
	dbconn( $wsMonth, $wsYear );
	
} else {
	echo "<pre>No Data Sent. <br /><br />"
    . "Use http://localhost/payroll/ws.php?month=?&year=? specifying a month (mm) and a year (yyyy)</pre>";
}

function dbconn( $m, $y ) {
	
	$mysqli = new mysqli("localhost", "pyuser", "pypass", "py");
	
	if ($mysqli->connect_errno) {
	    printf("Connect failed: %s\n", $mysqli->connect_error);
	    exit();
	}
	
	mysqli_query($mysqli,"INSERT INTO `log`( `month`, `year` ) VALUES ( $m ,$y )");
	
	mysqli_close($mysqli);
}

?>