<?php
    namespace pulut {
        use PDO;
        use DateTime;
        use DateInterval;
        class Scheduler {
            const MONDAY = 1;
            const TUESDAY = 2;
            const WEDNESDAY = 3;
            const THURSDAY = 4;
            const FRIDAY = 5;
            const SATURDAY = 6;
            const SUNDAY = 0;
            private $pdo;
            private $username, $password, $destination;
            public function __construct()
            {
                $this->username = 'root';
                $this->password = '';
                $this->destination = 'mysql:host=localhost;dbname=pulutpukyutan';
                $this->pdo = new PDO($this->destination, $this->username, $this->password);
            }

            public function compareDate($dayNum, $date) {
                if (date(strtotime($date),'N') == $dayNum) {
                    return true;
                } else {
                    return false;
                }
            }

            public function getWeekLongDates($date) {
                $dates = array();
                for ($i=1;$i<=7;$i++) {
                    $currentDate = date_create($date);
                    date_add($currentDate, date_interval_create_from_date_string($i.' days'));
                    array_push($dates, $currentDate->format('Y-m-d'));
                }
                return $dates;
            }

            public function getTwoWeekLongDates($date) {
                $dates = array();
                for ($i=1;$i<=14;$i++) {
                    $currentDate = date_create($date);
                    date_add($currentDate, date_interval_create_from_date_string($i.' days'));
                    array_push($dates, $currentDate->format('Y-m-d'));
                }
                return $dates;
            }

            public function getThreeWeekLongDates($date) {
                $dates = array();
                for ($i=1;$i<=21;$i++) {
                    $currentDate = date_create($date);
                    date_add($currentDate, date_interval_create_from_date_string($i.' days'));
                    array_push($dates, $currentDate->format('Y-m-d'));
                }
                return $dates;
            }

            public function getMonthLongDates($date) {
                $dates = array();
                for ($i=1;$i<=7;$i++) {
                    $currentDate = date_create($date);
                    date_add($currentDate, date_interval_create_from_date_string($i.' days'));
                    array_push($dates, $currentDate->format('Y-m-d'));
                }
                return $dates;
            }
        }
    }
