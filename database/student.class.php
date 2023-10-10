<?php
class Student extends Db {
	public function getStudent() {
		try {
			$sql = "SELECT * FROM users WHERE role=:role";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(['role' => 'Student']);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function FindClassName($id) {
		try {
			$sql = "SELECT c.class_name AS class FROM classes_students cs JOIN users u ON cs.student_id = u.id JOIN classes c ON cs.class_id = c.id  WHERE u.role=:role AND cs.student_id =:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(['role' => 'Student','id'=> $id]);
			$row =  $stmt->fetch(PDO::FETCH_ASSOC);
			return $row;
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getAvgScoreByStudentId($id) {
		try {
			$sql = "SELECT AVG(exam_score) AS exam_avg FROM exams WHERE student_id=:student_id ";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(['student_id' => $id]);
			$row =  $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['exam_avg'];
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getAvgLessonByStudentId($id) {
		try {
			$sql = "SELECT AVG(exam_score) AS exam_avg FROM exams WHERE lesson_id=:student_id ";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(['student_id' => $id]);
			$row =  $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['exam_avg'];
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getHistoryExam($id) {
		try {
			$sql = "SELECT e.exam_date,e.lesson_id,e.exam_score,l.lesson_name FROM exams e JOIN lessons l ON e.lesson_id = l.id WHERE e.student_id=:student_id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(['student_id' => $id]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getStudentById($id) {
		try {
			$sql = "SELECT * FROM users WHERE id=:id AND role=:role";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
				'role' => 'Student',
			]);
			return $stmt->fetch();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function createStudent($name,$surname,$username,$password) {
		try {
			$sql = "INSERT INTO users(name,surname,username,password,role) VALUES(:name,:surname,:username,:password,:role)";
			$stmt = $this->connect()->prepare($sql);
			$password = password_hash($password, PASSWORD_ARGON2ID, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
			$stmt->execute([
				'name' => $name,
				'surname' => $surname,
				'username' => $username,
				'password' => $password,
				'role' => 'Student',
			]);
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function editStudent($id,$name,$surname,$username,$password) {
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
				'role' => 'Student',
			]);
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function deleteStudent($id) {
		try {
			$sql = "
			DELETE FROM classes_students WHERE student_id=". $id.";
			DELETE FROM exams WHERE student_id=". $id .";
			DELETE FROM users WHERE id=:id;";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
			]);
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}

	public function getClassByStudent($id) {
		try {
			$sql = "SELECT * from classes_students WHERE student_id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
			]);
			return $stmt->fetch();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function searchStudent($class_id) {
		try {
			$sql = "SELECT u.id, u.name,u.surname,c.class_name,cs.class_id FROM users u JOIN classes_students cs ON u.id = cs.student_id JOIN classes c ON c.id=cs.class_id  WHERE role=:role AND cs.class_id=:class_id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'role' => 'Student',
				'class_id' => $class_id
			]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
}
