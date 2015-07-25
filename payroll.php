<?php

class payroll {
	
	private $day, $month, $year, $paymentDaysRequired;
	
	private function setDay( $day ) {
		$this->day = $day;
	}
	
	private function setMonth( $month ) {
		$this->month = $month;
	}
	
	private function setYear( $year ) {
		$this->year = $year;
	}
	
	private function setPaymentDaysRequired( $daysrequired ) {
		$this->paymentDaysRequired = $daysrequired;
	}
	
	public function setters( $month, $year, $paymentDays = '-4' ) {
		$this->setYear($year);
		$this->setMonth($month);
		$this->setDay( ( $this->daysinmonth($month, $year) ) -1 ) ;
		$this->paymentDaysRequired = $paymentDays;
	}
	
	public function daysinmonth($month, $year) {		
		return cal_days_in_month ( CAL_GREGORIAN, $month, $year );	
	}

	public function getDate( ) {	
		$day = $this->day; $month = $this->month; $year = $this->year;
		return date( "Y-m-d", mktime( 0, 0, 0, $month, $day, $year ) );		
	}

	public function getSubmissionDate( ) {
		$day = $this->day; $month = $this->month; $year = $this->year; $daysPrior = $this->paymentDaysRequired . " weekdays";
		$submissionDate  = date( 'Y-m-d', strtotime ( $daysPrior, strtotime ( $date = $this->getDate() ) ) );
		return $submissionDate;
	}
	
}
 

/**
 * Need 5 working days - 4 whole days for payment to clear + 1 day to submit request.
 * 
 * Assumptions:
 * Submit on the 1st working day - next 4 working days required for payment.
 * I.e. Submit on monday - hit bank on friday after 4 whole days.
 * (If it was 4 whole days inclusive of the day of submission then submitting on monday 
 * would mean payment would be made by thursday - 4 whole working days.)
 *
 * Must have 5 working days before penultimate day of month
 *
 */
 
?>