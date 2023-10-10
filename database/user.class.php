<?php
session_start();
class User extends Db
{

	public function login($username, $password)
	{
		try {
			$sql = "SELECT * FROM users";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute();
			$row = $stmt->fetchAll();

			if (!($row)) {
				$sql = "INSERT INTO users(name,surname,username,password,role) VALUES('admin','admin','admin',:password,'Admin')";
				$stmt = $this->connect()->prepare($sql);
				$password = password_hash("admin", PASSWORD_ARGON2ID, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
				$stmt->execute([
					'password' => $password
				]);
			}

			$sql = "SELECT * FROM users WHERE username =:username";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'username' => $username,
			]);
			$db = $stmt->fetch();
			if ($db) {
				if (password_verify($password, $db->password)) {
					$_SESSION["loggedIn"] = true;
					$_SESSION["id"] = $db->id;
					$_SESSION["username"] = $db->username;
					$_SESSION["role"] = $db->role;
					header("location:login/index.php");
				}
			}
			return 1;
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function changePassword($user_id, $password)
	{
		try {
			$sql = "UPDATE users SET password=:password WHERE id=:user_id";
			$stmt = $this->connect()->prepare($sql);
			$password = password_hash($password, PASSWORD_ARGON2ID, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
			$stmt->execute([
				'user_id' => $user_id,
				'password' => $password,
			]);
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getById($id)
	{
		try {
			$sql = "SELECT * FROM users WHERE id = :id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id
			]);
			return $stmt->fetch();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getByUsername($username)
	{
		try {
			$sql = "SELECT COUNT(username) AS count FROM users WHERE username=:username";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'username' => $username
			]);
			$row =  $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['count'];
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getByUsernameForEdit($username, $id)
	{
		try {
			$sql = "SELECT COUNT(username) AS count FROM users WHERE username=:username AND id!=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'username' => $username,
				'id' => $id
			]);
			$row =  $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['count'];
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}

	public function isLoggedIn()
	{
		return (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true);
	}
}
