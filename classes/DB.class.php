<?php

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/config/database.php';

class DB {
	private $PDOInstance = NULL;
	private static $instance = NULL;

	private function __construct() {
		try {
			$this->PDOInstance = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
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
		$this->PDOInstance->exec('USE '.DB_NAME);
		return $this->PDOInstance->prepare($statement);
	}

	public function exec($command) {
		return $this->PDOInstance->exec($command);
	}
}

?>