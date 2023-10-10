<?php
class Teacher extends Db {
	public function getTeacherForList() {
		try {
			$sql = "SELECT u.id,u.name,u.surname FROM users u 
			WHERE u.role=:role";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'role' => 'Teacher'
			]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function findClassName($id) {
		try {
			$sql = "SELECT class_name FROM classes WHERE class_teacher_id =:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(['id'=> $id]);
			$row =  $stmt->fetch(PDO::FETCH_ASSOC);
			return $row;
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function findLessonName($id) {
		try {
			$sql = "SELECT lesson_name FROM lessons WHERE teacher_user_id =:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(['id'=> $id]);
			$row =  $stmt->fetch(PDO::FETCH_ASSOC);
			return $row;
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getAll() {
		try {
			$sql = "SELECT * FROM users WHERE role=:role";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(['role' => 'Teacher']);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getTeacherById($id) {
		try {
			$sql = "SELECT * from users WHERE id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
			]);
			return $stmt->fetch();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function createTeacher($name,$surname,$username,$password) {
		try {
			$sql = "INSERT INTO users(name,surname,username,password,role) VALUES(:name,:surname,:username,:password,:role)";
			$stmt = $this->connect()->prepare($sql);
			$password = password_hash($password, PASSWORD_ARGON2ID, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
			$stmt->execute([
				'name' => $name,
				'surname' => $surname,
				'username' => $username,
				'password' => $password,
				'role' => 'Teacher',
			]);
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function editTeacher($id,$name,$surname,$username,$password) {
		try {
            $sql = "UPDATE users SET name=:name,surname=:surname,username=:username,password=:password,role=:role WHERE id=:id";
			$stmt = $this->connect()->prepare($sql);
			$password = password_hash($password, PASSWORD_ARGON2ID, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
			$stmt->execute([
				'id' => $id,
				'name' => $name,
				'surname' =>$surname,
				'username' => $username,
				'password' => $password,
				'role' => 'Teacher',
			]);
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function deleteTeacher($id) {
		try {
			$sql = "DELETE FROM users WHERE id=:id ";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
			]);
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function searchByLesson($lesson_id) {
		try {
			$sql = "SELECT u.name,u.surname,c.class_name,c.id,l.lesson_name,l.id FROM users u INNER JOIN classes c ON u.id=c.class_teacher_id INNER JOIN lessons l ON u.id=l.teacher_user_id WHERE role=:role AND l.id=:lesson_id ";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'role' => 'Teacher',
				'lesson_id' => $lesson_id
			]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function searchByClass($class_id) {
		try {
			$sql = "SELECT u.name,u.surname,c.class_name,c.id,l.lesson_name,l.id FROM users u INNER JOIN classes c ON u.id=c.class_teacher_id INNER JOIN lessons l ON u.id=l.teacher_user_id WHERE role=:role AND c.id=:class_id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'role' => 'Teacher',
				'class_id' => $class_id
			]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
}
