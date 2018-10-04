<?php
    namespace pulut {
        use PDO;
        class InfoManager{
            private $pdo;
            private $username, $password, $destination;

            public function __construct()
            {
                $this->username = 'root';
                $this->password = '';
                $this->destination = 'mysql:host=localhost;dbname=pulutpukyutan';
                $this->pdo = new PDO($this->destination, $this->username, $this->password);
            }

            public function updateCredentials($username, $password) {
                $changeUsername = $this->pdo->query("UPDATE settings SET prefValue = '$username' WHERE prefName = 'username'");
                $changePassword = $this->pdo->query("UPDATE settings SET prefValue = '".password_hash("$password", PASSWORD_DEFAULT)."' WHERE prefName = 'password'");
                if ($changePassword->rowCount() > 0 && $changeUsername->rowCount() > 0) {
                    return "GOOD";
                } else {
                    return "BAD";
                }
            }

            public function updateIdentity($fullname, $subtitle) {
                $changeFullName = $this->pdo->query("UPDATE settings SET prefValue = '$fullname' WHERE prefName = 'fullname'");
                $changeSubtitle = $this->pdo->query("UPDATE settings SET prefValue = '$subtitle' WHERE prefName = 'subtitle'");
                if ($changeSubtitle->rowCount() > 0 && $changeFullName->rowCount() > 0) {
                    return "GOOD";
                } else {
                    return "BAD";
                }
            }
        }

        $infoMgr = new InfoManager();
    }