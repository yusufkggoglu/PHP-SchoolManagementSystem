<?php

class Exam extends Db {
	public function getExam() {
		try {
			$sql = "SELECT e.id,e.exam_date,e.exam_score,u.name,u.surname,l.lesson_name,c.class_name,l.id AS lesson_id FROM exams e 
			JOIN lessons l ON e.lesson_id=l.id 
			JOIN classes c ON e.class_id=c.id 
			JOIN users u ON e.student_id=u.id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getHaveClass() {
		try {
			$sql = " SELECT u.name,u.surname,u.id FROM classes_students cs JOIN users u ON cs.student_id=u.id WHERE u.role=:role";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(['role' => 'Student']);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getExamById($id) {
		try {
			$sql = "SELECT e.id,e.exam_date,e.exam_score,u.name,u.surname,l.lesson_name,c.class_name FROM exams e 
			JOIN lessons l ON e.lesson_id=l.id 
			JOIN classes c ON e.class_id=c.id 
			JOIN users u ON e.student_id=u.id WHERE e.id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
			]);
			return $stmt->fetch();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getExamForTeacher($id) {
		try {
			$sql = "SELECT e.id,e.exam_date,e.exam_score,u.name,u.surname,l.lesson_name,c.class_name,l.id AS lesson_id FROM exams e 
			JOIN lessons l ON e.lesson_id=l.id 
			JOIN classes c ON e.class_id=c.id 
			JOIN users u ON e.student_id=u.id 
			WHERE l.teacher_user_id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
			]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getExamForStudent($id) {
		try {
			$sql = "SELECT e.id,e.exam_date,e.exam_score,u.name,u.surname,l.lesson_name,c.class_name,l.id AS lesson_id FROM exams e 
			JOIN lessons l ON e.lesson_id=l.id 
			JOIN classes c ON e.class_id=c.id 
			JOIN users u ON e.student_id=u.id 
			WHERE e.student_id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
			]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function lessonAverage($lesson_id) {
		try {
			$sql = "SELECT AVG(exam_score) AS exam_avg FROM exams WHERE lesson_id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $lesson_id,
			]);
			$row =  $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['exam_avg'];
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function createExam($student_id,$lesson_id,$exam_score) {
		try {
			$sql = "SELECT class_id FROM classes_students WHERE student_id=:student_id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'student_id' => $student_id,
			]);
			$class=$stmt->fetch();
			$sql = "INSERT INTO exams(student_id,lesson_id,class_id,exam_score) VALUES(:student_id,:lesson_id,:class_id,:exam_score)";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'student_id' => $student_id,
				'lesson_id' => $lesson_id,
				'class_id' => $class->class_id,
				'exam_score' => $exam_score
			]);
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function editExam($id,$student_id,$lesson_id,$exam_score) {
		try {
			$sql = "SELECT class_id FROM classes_students WHERE student_id=:student_id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'student_id' => $student_id,
			]);
			$class=$stmt->fetch();
            $sql = "UPDATE exams SET student_id=:student_id,lesson_id=:lesson_id,class_id=:class_id,exam_score=:exam_score WHERE id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
				'student_id' => $student_id,
				'lesson_id' => $lesson_id,
				'class_id' => $class->class_id,
				'exam_score' => $exam_score
			]);
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function deleteExam($id) {
		try {
			$sql = "DELETE FROM exams WHERE id=:id ";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
			]);
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function searchByLesson($id) {
		try {
			$sql = "SELECT e.exam_date,e.exam_score,u.name,u.surname,l.lesson_name,c.class_name,l.id AS lesson_id FROM exams e 
			JOIN lessons l ON e.lesson_id=l.id 
			JOIN classes c ON e.class_id=c.id 
			JOIN users u ON e.student_id=u.id WHERE e.lesson_id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
			]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function searchByLessonForStudent($lesson_id,$student_id) {
		try {
			$sql = "SELECT e.exam_date,e.exam_score,u.name,u.surname,l.lesson_name,c.class_name,l.id AS lesson_id FROM exams e 
			JOIN lessons l ON e.lesson_id=l.id 
			JOIN classes c ON e.class_id=c.id 
			JOIN users u ON e.student_id=u.id WHERE e.lesson_id=:lesson_id AND e.student_id=:student_id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'lesson_id' => $lesson_id,
				'student_id' => $student_id,
			]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
}
