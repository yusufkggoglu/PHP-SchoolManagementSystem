<?php
class Db
{
	private $host = "db";
	private $username = "php_docker";
	private $password = "password";
	private $database = "php_docker";

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
