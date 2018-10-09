<?php
    namespace pulut {
        use PDO;
        class TrashMonitor {
            const BIODEGRADABLE = 1;
            const NONBIODEGRADEABLE = 2;
            const UNSPECIFIED = 3;
            private $pdo;
            private $username, $password, $destination;

            public function __construct()
            {
                $this->username = 'root';
                $this->password = '';
                $this->destination = 'mysql:host=localhost;dbname=pulutpukyutan';
                $this->pdo = new PDO($this->destination, $this->username, $this->password);
            }


            public function isOperational($unitNumber) {
                switch ($unitNumber) {
                    case $this::BIODEGRADABLE:
                        $getStatus = $this->pdo->query('SELECT prefValue FROM settings WHERE prefName = "bio_operational"')->fetch(PDO::FETCH_ASSOC)['prefValue'];
                    break;

                    case $this::NONBIODEGRADEABLE:
                        $getStatus = $this->pdo->query('SELECT prefValue FROM settings WHERE prefName = "non_operational"')->fetch(PDO::FETCH_ASSOC)['prefValue'];
                        break;

                    case $this::UNSPECIFIED:
                        $getStatus = $this->pdo->query('SELECT prefValue FROM settings WHERE prefName = "uns_operational"')->fetch(PDO::FETCH_ASSOC)['prefValue'];
                        break;

                    default:
                        $getStatus = 0;
                }
                if ($getStatus==1) {
                    return true;
                } else {
                    return false;
                }
            }

            public function getMaximumContent($unitNumber) {
                switch ($unitNumber) {
                    case $this::BIODEGRADABLE:
                        $content = $this->pdo->query('SELECT prefValue FROM settings WHERE prefName = "biodegMaxCount"')->fetch(PDO::FETCH_ASSOC)['prefValue'];
                        break;

                    case $this::NONBIODEGRADEABLE:
                        $content = $this->pdo->query('SELECT prefValue FROM settings WHERE prefName = "nonbioMaxCount"')->fetch(PDO::FETCH_ASSOC)['prefValue'];
                        break;

                    case $this::UNSPECIFIED:
                        $content = $this->pdo->query('SELECT prefValue FROM settings WHERE prefName = "unspecMaxCount"')->fetch(PDO::FETCH_ASSOC)['prefValue'];
                        break;

                    default:
                        $content = false;
                }
                return $content;
            }

            public function getContents($unitNumber) {
                switch ($unitNumber) {
                    case $this::BIODEGRADABLE:
                        $content = $this->pdo->query('SELECT prefValue FROM settings WHERE prefName = "biodegCount"')->fetch(PDO::FETCH_ASSOC)['prefValue'];
                        break;

                    case $this::NONBIODEGRADEABLE:
                        $content = $this->pdo->query('SELECT prefValue FROM settings WHERE prefName = "nonbioCount"')->fetch(PDO::FETCH_ASSOC)['prefValue'];
                        break;

                    case $this::UNSPECIFIED:
                        $content = $this->pdo->query('SELECT prefValue FROM settings WHERE prefName = "unspecCount"')->fetch(PDO::FETCH_ASSOC)['prefValue'];
                        break;

                    default:
                        $content = false;
                }
                return $content;
            }
        }
    }
?>