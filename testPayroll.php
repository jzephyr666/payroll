<?php

include 'payroll.php';
$subDate = new payroll();
$subDate->setters( '7', '2015' );
$submissionDate = $subDate->getSubmissionDate( ); 
$payday = $subDate->getDate();
echo "<br />
Payment should be submitted by end of play on <strong>$submissionDate</strong> to reach accounts by <strong>$payday</strong>.
<br /><br />";



?>