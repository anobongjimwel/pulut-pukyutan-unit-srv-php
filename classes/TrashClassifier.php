<?php
namespace pulut {

    use PDO;

    class TrashClassifier
    {
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

        public function deleteTrashClassification($item) {
            $executeDelete = $this->pdo->query("DELETE FROM wasteObjects WHERE objectName = '$item'");
            if ($executeDelete) {
                return true;
            } else {
                return false;
            }
        }

        public function assignObject($item, $classification) {
            $searchItem = $this->pdo->query("SELECT * FROM wasteobjects WHERE objectName = '$item'");
            if ($searchItem) {
                switch ($classification) {
                    case $this::BIODEGRADABLE:
                        $executeClassification = $this->pdo->query("UPDATE wasteObjects SET objectType = 'biodegradable' WHERE objectName = '$item'");
                        break;

                    case $this::NONBIODEGRADEABLE:
                        $executeClassification = $this->pdo->query("UPDATE wasteObjects SET objectType = 'non-biodegradable' WHERE objectName = '$item'");
                        break;

                    case $this::UNSPECIFIED:
                        $executeClassification = $this->pdo->query("UPDATE wasteObjects SET objectType = 'unspecified' WHERE objectName = '$item'");
                        break;
                }
            } else {
                switch ($classification) {
                    case $this::BIODEGRADABLE:
                        $executeClassification = $this->pdo->query("INSERT INTO wasteobjects (objectName, objectType) VALUES ('$item','biodegradable');");
                    break;

                    case $this::NONBIODEGRADEABLE:
                        $executeClassification = $this->pdo->query("INSERT INTO wasteobjects (objectName, objectType) VALUES ('$item','non-biodegradable');");
                        break;

                    case $this::UNSPECIFIED:
                        $executeClassification = $this->pdo->query("INSERT INTO wasteobjects (objectName, objectType) VALUES ('$item','unspecified');");
                        break;
                }
            }
            if ($executeClassification) {
                return true;
            } else {
                return false;
            }
        }

        public function gatherObjectsByClassification($classification) {
            switch ($classification) {
                case $this::BIODEGRADABLE:
                    $itemsSearch = $this->pdo->query("SELECT * FROM wasteobjects WHERE objectType = 'biodegradable' LIMIT 10");
                    break;

                case $this::NONBIODEGRADEABLE:
                    $itemsSearch = $this->pdo->query("SELECT * FROM wasteobjects WHERE objectType = 'non-biodegradable' LIMIT 10");
                    break;

                case $this::UNSPECIFIED:
                    $itemsSearch = $this->pdo->query("SELECT * FROM wasteobjects WHERE objectType = 'unspecified' LIMIT 10");
                    break;
            }
            if ($itemsSearch->rowCount()==0) {
                return 0;
            } else {
                return $itemsSearch->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        public function countObjectsByClassification($classification) {
            switch ($classification) {
                case $this::BIODEGRADABLE:
                    $itemsSearch = $this->pdo->query("SELECT * FROM wasteobjects WHERE objectType = 'biodegradable' LIMIT 10");
                    break;

                case $this::NONBIODEGRADEABLE:
                    $itemsSearch = $this->pdo->query("SELECT * FROM wasteobjects WHERE objectType = 'non-biodegradable' LIMIT 10");
                    break;

                case $this::UNSPECIFIED:
                    $itemsSearch = $this->pdo->query("SELECT * FROM wasteobjects WHERE objectType = 'unspecified' LIMIT 10");
                    break;
            }
            if ($itemsSearch->rowCount()==0) {
                return 0;
            } else {
                return $itemsSearch->rowCount();
            }
        }

        public function gatherObjectsByItem($item) {
            $searchItem = $this->pdo->query("SELECT * FROM wasteobjects WHERE objectName = '$item' LIMIT 10");
            if ($searchItem->rowCount()==0) {
                return 0;
            } else {
                return $searchItem->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        public function countObjectsByItem($item) {
            $searchItem = $this->pdo->query("SELECT * FROM wasteobjects WHERE objectName = '$item' LIMIT 10");
            if ($searchItem->rowCount()==0) {
                return 0;
            } else {
                return $searchItem->rowCount();
            }
        }

        public function gatherObjectsByItemInClassification($item, $classification) {
            switch ($classification) {
                case $this::BIODEGRADABLE:
                    $itemsSearch = $this->pdo->query("SELECT * FROM wasteobjects WHERE objectType = 'biodegradable' AND objectName LIKE '%$item%' LIMIT 10");
                    break;

                case $this::NONBIODEGRADEABLE:
                    $itemsSearch = $this->pdo->query("SELECT * FROM wasteobjects WHERE objectType = 'non-biodegradable' AND objectName LIKE '%$item%' LIMIT 10");
                    break;

                case $this::UNSPECIFIED:
                    $itemsSearch = $this->pdo->query("SELECT * FROM wasteobjects WHERE objectType = 'unspecified' AND objectName LIKE '%$item%' LIMIT 10");
                    break;
            }
            if ($itemsSearch->rowCount()==0) {
                return 0;
            } else {
                return $itemsSearch->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        public function countObjectsByItemInClassification($item, $classification) {
            switch ($classification) {
                case $this::BIODEGRADABLE:
                    $itemsSearch = $this->pdo->query("SELECT * FROM wasteobjects WHERE objectType = 'biodegradable' AND objectName LIKE '%$item%' LIMIT 10");
                    break;

                case $this::NONBIODEGRADEABLE:
                    $itemsSearch = $this->pdo->query("SELECT * FROM wasteobjects WHERE objectType = 'non-biodegradable' AND objectName LIKE '%$item%' LIMIT 10");
                    break;

                case $this::UNSPECIFIED:
                    $itemsSearch = $this->pdo->query("SELECT * FROM wasteobjects WHERE objectType = 'unspecified' AND objectName LIKE '%$item%' LIMIT 10");
                    break;
            }
            if ($itemsSearch->rowCount()==0) {
                return 0;
            } else {
                return $itemsSearch->rowCount();
            }
        }
    }
}