<?php

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/config/database_test.php';

class DB {
	private $PDOInstance = NULL;
	private static $instance = NULL;

	private function __construct() {
		try {
			$this->PDOInstance = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
			$command = "use mydb";
			$this->PDOInstance->exec($command);
			
		} catch(PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
	}

	public static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new DB();
		}
		return self::$instance;
	}

	public function prepare($statement) {
		return $this->PDOInstance->prepare($statement);
	}

	public function exec($command) {
		return $this->PDOInstance->exec($command);
	}
}

?>