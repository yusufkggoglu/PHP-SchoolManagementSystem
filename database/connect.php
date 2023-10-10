<?php
class Db
{
	private $host = "localhost";
	private $username = "root";
	private $password = "";
	private $database = "siber_vatan_yetkinlik_merkezi";

	public function connect()
	{
		try {
			$dsn = "mysql:host=" . $this->host . ";dbname=" . $this->database;
			$pdo = new PDO($dsn, $this->username, $this->password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			return $pdo;
		} catch (PDOException $e) {
			echo "Bağlantı hatası : " . $e->getMessage();
		}
	}
}
