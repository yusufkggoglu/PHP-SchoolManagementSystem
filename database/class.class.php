<?php
class Classes extends Db {
	public function getClass() {
		try {
			$sql = "SELECT * from classes";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getClassForTeacher($id) {
		try {
			$sql = "SELECT c.*, u.name, u.surname FROM classes c INNER JOIN users u ON c.class_teacher_id = u.id WHERE c.class_teacher_id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id
			]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	
	public function getClassForStudent($id) {
		try {
			$sql = "SELECT c.*, u.name, u.surname FROM classes c 
			INNER JOIN users u ON c.class_teacher_id = u.id 
			INNER JOIN classes_students cs ON c.id=cs.class_id
			WHERE cs.student_id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id
			]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getClassForList() {
		try {
			$sql = "SELECT c.*, u.name, u.surname FROM classes c INNER JOIN users u ON c.class_teacher_id = u.id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function countStudentOfClass($id) {
		try {
			$sql = "SELECT  COUNT(student_id) AS countStudent FROM classes_students WHERE class_id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(['id' => $id]);
			$row =  $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['countStudent'];
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function averageOfClass($id) {
		try {
			$sql = "SELECT  AVG(exam_score) AS average FROM exams e WHERE e.class_id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(['id' => $id]);
			$row =  $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['average'];
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getClassById($id) {
		try {
			$sql = "SELECT * from classes WHERE id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
			]);
			return $stmt->fetch();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getInClass($id) {
		try {
			$sql = "SELECT u.id,u.name,u.surname from classes_students cs JOIN users u ON cs.student_id = u.id WHERE class_id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
			]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getHaveNoClass() {
		try {
			$sql = " SELECT * FROM users WHERE id NOT IN (SELECT student_id FROM classes_students) AND role=:role";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'role' => 'Student',
			]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function deleteStudentFromClass($student_id,$class_id) {
		try {
			$sql = "DELETE FROM classes_students WHERE student_id=:student_id AND class_id=:class_id ";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'student_id' => $student_id,
				'class_id' => $class_id,
			]);
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function createClass($class_name,$class_teacher_id) {
		try {
			$sql = "INSERT INTO classes(class_name,class_teacher_id) VALUES(:class_name,:class_teacher_id)";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'class_name' => $class_name,
				'class_teacher_id' => $class_teacher_id,
			]);
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function addStudent($class_id,$student_id) {
		try {
			$sql = "INSERT INTO classes_students(class_id,student_id) VALUES(:class_id,:student_id)";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'class_id' => $class_id,
				'student_id' => $student_id,
			]);
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function editClass($id,$class_name,$class_teacher_id) {
		try {
            $sql = "UPDATE classes SET class_name=:class_name,class_teacher_id=:class_teacher_id WHERE id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
				'class_name' => $class_name,
				'class_teacher_id' =>$class_teacher_id,
			]);
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function deleteClass($id) {
		try {
			$sql = "DELETE FROM classes_students WHERE class_id=:id;DELETE FROM classes WHERE id=:id;";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
			]);
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
}
