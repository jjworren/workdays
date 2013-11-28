<?php
/**
 * Created by PhpStorm.
 * User: jjworren
 * Date: 27.11.13
 * Time: 12:59
 */

class WorkingDays {
    const DAY_MONTH_FORMAT      = 'j.n';
    const DAY_MONTH_YEAR_FORMAT = 'j.n.Y';
    const DAY_NUMBER_FORMAT     = 'N';
    protected $fixedRepeatingHolidayDates = array(
        '1.1',
        '1.5',
        '8.5',
        '5.7',
        '6.7',
        '28.9',
        '28.10',
        '17.11',
        '24.12',
        '25.12',
        '26.12',
    );
    protected $fixedNonWorkingDays = array(6, 7);
    protected $variableHolidayDates = array(
        '2.4.2013',
        '21.4.2014',
        '6.4.2015',
        '28.3.2016',
        '17.4.2017',
        '2.4.2018',
        '22.4.2019',
        '13.4.2020',
        '5.4.2021',
        '18.4.2022',
        '10.4.2023',
        '1.4.2024',
        '21.4.2025',
    );

    public function isWorkingDay(\DateTime $date) {
        $isFixedRepeatingHoliday = in_array($date->format(self::DAY_MONTH_FORMAT), $this->fixedRepeatingHolidayDates);
        $isNonWorkingDay = in_array($date->format(self::DAY_NUMBER_FORMAT), $this->fixedNonWorkingDays);
        $isVariableHoliday = in_array($date->format(self::DAY_MONTH_YEAR_FORMAT), $this->variableHolidayDates);

        return !($isFixedRepeatingHoliday || $isNonWorkingDay || $isVariableHoliday);
    }

    /**
     * @param DateTime $date
     * @param int      $offSet
     *
     * @return DateTime
     */
    public function getNextWorkingDay(\DateTime $date = null) {
        $day = clone $date;
        $interval = DateInterval::createFromDateString('1 day');
        do {
            $day->add($interval);
        } while(!$this->isWorkingDay($day));

        return $day;
    }

    public function getNextWorkingDays(\DateTime $start = null, \DateTime $end) {
        $day = clone $start;
        $interval = DateInterval::createFromDateString('1 day');
        $return = array();
        do {
            $day->add($interval);
            if ($this->isWorkingDay($day)) {
                $return[] = clone $day;
            }
        } while($day < $end);

        return $return;
    }
}
