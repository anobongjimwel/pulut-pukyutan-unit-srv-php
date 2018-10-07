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
            const SUNDAY = 7;
            private $pdo;
            private $username, $password, $destination;
            public function __construct()
            {
                $this->username = 'root';
                $this->password = '';
                $this->destination = 'mysql:host=localhost;dbname=pulutpukyutan';
                $this->pdo = new PDO($this->destination, $this->username, $this->password);
            }

            public function compareDate($date) {
                $theSame = false;
                $getDaysinSchedule = $this->pdo->query("SELECT prefValue FROM settings WHERE prefName = 'schedules'");
                $days = explode(', ', $getDaysinSchedule->fetch(PDO::FETCH_ASSOC)['prefValue']);
                foreach ($days as $day) {
                    if (date('N',strtotime($date)) == $day) {
                        $theSame = true;
                    }
                }
                return $theSame;
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
                for ($i=1;$i<=31;$i++) {
                    $currentDate = date_create($date);
                    date_add($currentDate, date_interval_create_from_date_string($i.' days'));
                    array_push($dates, $currentDate->format('Y-m-d'));
                }
                return $dates;
            }

            public function changeSchedules ($days) {
                $dayStr = '';
                foreach ($days as $day) {
                    $dayStr.=$day.', ';
                }
                $dayStr = strlen($dayStr)!=0 ? substr($dayStr, 0, -2) : $dayStr;
                $setSchedules = $this->pdo->prepare("UPDATE settings SET prefValue = '$dayStr' WHERE prefName = 'schedules'");
                $setSchedules->execute();
            }

            public function clearSchedules() {
                $setSchedules = $this->pdo->prepare("UPDATE settings SET prefValue = '' WHERE prefName = 'schedules'");
                $setSchedules->execute();
            }

            public function getSchedules() {
                $queryForSchedules = $this->pdo->query("SELECT prefValue FROM settings WHERE prefName = 'schedules'");
                $schedules = array();
                foreach(explode(', ', $queryForSchedules->fetch(PDO::FETCH_ASSOC)) as $schedule) {
                    array_push($schedules, $schedule);
                }
                return $schedules;
            }

            public function returnLongDateFmt($date) {
                return date('l, F d, Y, (e, T P)', strtotime($date));
            }

            public function returnShortMonth($date) {
                return mb_strtoupper(date('M', strtotime($date)));
            }

            public function returnDay($date) {
                return date('d', strtotime($date));
            }

            public function getIfChecked($dayNum) {
                $isChecked = false;
                $queryForSchedules = $this->pdo->query("SELECT prefValue FROM settings WHERE prefName = 'schedules'");
                foreach(explode(', ', $queryForSchedules->fetch(PDO::FETCH_ASSOC)['prefValue']) as $schedule) {
                    if ($schedule == $dayNum) {
                        $isChecked = true;
                    }
                }
                return $isChecked;
            }
        }
    }
