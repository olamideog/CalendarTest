<?php
namespace Calendar;

use DateTimeInterface;
use DateTime;

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
    	$startDate = $this->dateTime->format('Y-m-01');
    	$currMonth = $this->dateTime->format('m');
    	$startDate = new DateTime(date('Y-m-d', strtotime($startDate)));

    }
}
?>