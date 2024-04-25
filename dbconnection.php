<?php 
	class DbConnect {
		private $host = 'localhost';
		private $dbName = 'u154566579_Alphaa';
		private $user = 'u154566579_root';
		private $pass = 'Alphabetagamma@12345';

		public function connect() {
			try {
				$conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->dbName, $this->user, $this->pass);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conn;
			} catch( PDOException $e) {
				echo 'Database Error: ' . $e->getMessage();
			}
		}
	}
 ?>

 
