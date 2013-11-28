<?php
/**
 * Created by PhpStorm.
 * User: jjworren
 * Date: 27.11.13
 * Time: 16:07
 */
require_once 'src/WorkingDays.php';
$day         = new \DateTime('2013-01-01');
$dayInterval = DateInterval::createFromDateString('1 day');
$endDate     = new \DateTime('2014-01-01');
$ctrl        = new WorkingDays();
while ($day < $endDate) {
    if (!$ctrl->isWorkingDay($day) && !in_array($day->format(WorkingDays::DAY_NUMBER_FORMAT), array(6, 7))) {
        echo $day->format(WorkingDays::DAY_MONTH_YEAR_FORMAT) . PHP_EOL;
    }
    $day->add($dayInterval);
}
$today   = new \DateTime('28.11.2013');
$nextDay = $ctrl->getNextWorkingDay($today);

if (!$ctrl->isWorkingDay($nextDay)) {
    echo 'nOK' . $nextDay->format(WorkingDays::DAY_MONTH_YEAR_FORMAT) . PHP_EOL;
} else {
    echo 'OK ' . $nextDay->format(WorkingDays::DAY_MONTH_YEAR_FORMAT) . PHP_EOL;
}

$today   = new \DateTime('29.11.2013');
$nextDay = $ctrl->getNextWorkingDay($today);

if (!$ctrl->isWorkingDay($nextDay)) {
    echo 'nOK' . $nextDay->format(WorkingDays::DAY_MONTH_YEAR_FORMAT) . PHP_EOL;
} else {
    echo 'OK ' . $nextDay->format(WorkingDays::DAY_MONTH_YEAR_FORMAT) . PHP_EOL;
}

