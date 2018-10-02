<?php
    namespace pulut {
        use PDO;
        class Securer {
            private $pdo;
            private $username, $password, $destination;

            public function __construct()
            {
                $this->username = 'root';
                $this->password = '';
                $this->destination = 'mysql:host=localhost;dbname=pulutpukyutan';
                $this->pdo = new PDO($this->destination, $this->username, $this->password);
        }

            public function checkIfCredentialSet() {
                $qry1 = $this->pdo->query("SELECT prefValue FROM settings WHERE prefName = 'username'");
                $qry2 = $this->pdo->query("SELECT prefValue FROM settings WHERE prefName = 'password'");
                $username = $qry1->fetch(PDO::FETCH_ASSOC)['prefValue'];
                $password = $qry2->fetch(PDO::FETCH_ASSOC)['prefValue'];
                if ($username != '' && $password != '') {
                    return true;
                } else {
                    return false;
                }
            }

            public function checkIfInformationSet() {
                $qry1 = $this->pdo->query("SELECT prefValue FROM settings WHERE prefName = 'fullname'");
                $qry2 = $this->pdo->query("SELECT prefValue FROM settings WHERE prefName = 'subtitle'");
                $fullname = $qry1->fetch(PDO::FETCH_ASSOC)['prefValue'];
                $subtitle = $qry2->fetch(PDO::FETCH_ASSOC)['prefValue'];
                if ($fullname != '' && $subtitle != '') {
                    return true;
                } else {
                    return false;
                }
            }

            public function checkIfAllSet() {
                if ($this->checkIfCredentialSet() && $this->checkIfInformationSet()) {
                    return true;
                } else {
                    return false;
                }
            }

            public function checkIfLoggedIn() {
                if (!empty($_SESSION['user'])) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }