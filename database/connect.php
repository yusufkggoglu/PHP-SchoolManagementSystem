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

			$sql = "SELECT * FROM users";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$row = $stmt->fetchAll();

			if (!($row > 0)) {
				$sql = "INSERT INTO users(name,surname,username,password,role) VALUES('admin','admin','admin',:password,'Admin')";
				$stmt = $pdo->prepare($sql);
				$password = password_hash("admin", PASSWORD_ARGON2ID, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
				$stmt->execute([
					'password' => $password
				]);
			}
			return $pdo;
		} catch (PDOException $e) {
			echo "Bağlantı hatası : " . $e->getMessage();
		}
	}
}
