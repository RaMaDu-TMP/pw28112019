<?php
    class Database {
        private static $instance;
        private static $conn;

        private $host = 'localhost';
        private $db = 'pw28112019';
        private $user = 'root';
        private $pass = '';

        private function __construct() {
            try {
                Database::$conn = new PDO('mysql:'.
                                    'host='.$this->host.
                                    ';dbname='.$this->db.
                                    ';charset=utf8mb4',
                                    $this->user,
                                    $this->pass
                                );

                Database::$conn->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );
            } catch(Trowable $e) {
                die("ERROR: Could not connect. ".$e.getMessage());
            }
        }

        public static function connection() {

            if (is_null(Database::$instance)) {
                Database::$instance = new Database();
            }

            return Database::$conn;
        }
    }
?>