<?php
namespace Calendar;

use DateTimeInterface;
use DateTime;
use DateInterval;

class Calendar implements CalendarInterface{

	public $dateTime;
	/**
     * @param DateTimeInterface $datetime
     */
    public function __construct(DateTimeInterface $datetime){
    	$this->dateTime = $datetime;
    }

    /**
     * Get the day
     *
     * @return int
     */
    public function getDay(){
    	$day = $this->dateTime->format('j');
    	return (int) $day;
    }

    /**
     * Get the weekday of the current montth (1-7, 1 = Monday)
     *
     * @return int
     */
    public function getWeekDay(){
    	$weekday = (int) $this->dateTime->format('w');
    	if($weekday == 0){
    		return 7;
    	}else{
    		return $weekday;
    	}    	
    }

    /**
     * Get the first weekday of this month (1-7, 1 = Monday)
     *
     * @return int
     */
    public function getFirstWeekDay(){
    	$currDate = $this->dateTime->format('Y-m-d');
    	$startMonth = new DateTime(date("Y-m-01", strtotime($currDate)));
        $firstWeekday = (int) $startMonth->format('w');
        if($firstWeekday == 0){
        	return 7;
        }else{
        	return $firstWeekday;
        }
        
    }

    /**
     * Get the first week of this month (18th March => 9 because March starts on week 9)
     *
     * @return int
     */
    public function getFirstWeek(){
    	$currDate = $this->dateTime->format('Y-m-d');
    	$firstDayOfMonth = new DateTime(date("Y-m-01", strtotime($currDate)));
        $weekNumber = (int) $firstDayOfMonth->format('W');
        return $weekNumber;
    }

    /**
     * Get the number of days in this month
     *
     * @return int
     */
    public function getNumberOfDaysInThisMonth(){
    	$month = (int) $this->dateTime->format('n');
    	$year = $this->dateTime->format('Y');
    	return (int) cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }

    /**
     * Get the number of days in the previous month
     *
     * @return int
     */
    public function getNumberOfDaysInPreviousMonth(){
    	$currDate = $this->dateTime->format('Y-m-01');
    	$prevDate = new DateTime(date("Y-m-d", strtotime($currDate." -1 months")));
    	
    	return (int) cal_days_in_month(CAL_GREGORIAN, $prevDate->format('n'), $prevDate->format('Y'));
    }

    /**
     * Get the calendar array
     *
     * @return array
     */
    public function getCalendar(){
    	$calendar = array();
    	$day = $this->getFirstDayOfCalendar();
    	while($day <= $this->getLastDayOfCalendar()) {
            $this->addDayToCalendar($calendar, $day);
            $day->add(new DateInterval('P1D'));
        }
        return $calendar;
    }

    private function getFirstDayOfCalendar(){
        $day = new DateTime(date("Y-m-01", $this->dateTime->getTimestamp()));
        $firstWeekDay = $this->getFirstWeekDay();
        if($firstWeekDay > 1) {
            $diff = 'P' . ($firstWeekDay - 1) . 'D';
            $day->sub(new DateInterval($diff));
        }
        return $day;
    }

    private function getLastDayOfCalendar(){
    	$numberOfDaysInThisMonth = $this->getNumberOfDaysInThisMonth();
        $day = new DateTime(date("Y-m-".$numberOfDaysInThisMonth." 23:59:59", $this->dateTime->getTimestamp()));
        $lastDayNumber = $day->format('w');
        if($lastDayNumber > 0) {
            $diff = 'P' . (7 - $lastDayNumber) . 'D';
            $day->add(new DateInterval($diff));
        }
        return $day;
    }

    private function addDayToCalendar(&$calendar, DateTime $day)
    {
        $weekNumber = (int) $day->format('W');
        $previousWeekDay = clone $this->dateTime;
        $previousWeekDay->sub(new DateInterval('P7D'));
        $previousWeekNumber = (int) $previousWeekDay->format('W');
        if(!array_key_exists($weekNumber, $calendar)) {
            $calendar[$weekNumber] = array();
        }
        $calendar[$weekNumber][$day->format('j')] = $weekNumber == $previousWeekNumber;
    }

    /*private function setYear($year){
    	$this->datetime->setDate($year, 1, 1);
    }*/
}
?>