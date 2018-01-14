<?php
namespace Calendar;

use DateTimeInterface;

class Calendar implements CalendarInterface{

	public $this->datetime;
	/**
     * @param DateTimeInterface $datetime
     */
    public function __construct(DateTimeInterface $datetime){
    	$this->datetime = $datetime;
    }

    /**
     * Get the day
     *
     * @return int
     */
    public function getDay(){
    	$day = $this->datetime->format('j');
    	return (int) $day;
    }

    /**
     * Get the weekday (1-7, 1 = Monday)
     *
     * @return int
     */
    public function getWeekDay(){}

    /**
     * Get the first weekday of this month (1-7, 1 = Monday)
     *
     * @return int
     */
    public function getFirstWeekDay(){}

    /**
     * Get the first week of this month (18th March => 9 because March starts on week 9)
     *
     * @return int
     */
    public function getFirstWeek(){}

    /**
     * Get the number of days in this month
     *
     * @return int
     */
    public function getNumberOfDaysInThisMonth(){}

    /**
     * Get the number of days in the previous month
     *
     * @return int
     */
    public function getNumberOfDaysInPreviousMonth(){}

    /**
     * Get the calendar array
     *
     * @return array
     */
    public function getCalendar(){}
}
?>