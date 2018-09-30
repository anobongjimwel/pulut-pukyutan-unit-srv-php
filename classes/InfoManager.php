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
                $changeUsername = $this->pdo->query("UPDATE wasteObjects SET prefValue = '$username' WHERE prefName = 'username'");
                $changePassword = $this->pdo->query("UPDATE wasteObjects SET prefValue = '".password_hash("$password", PASSWORD_DEFAULT)."' WHERE prefname = 'password'");
                if ($changePassword->rowCount() > 0 && $changeUsername->rowCount() > 0) {
                    return "GOOD";
                } else {
                    return "BAD";
                }
            }
        }

        $infoMgr = new InfoManager();
    }