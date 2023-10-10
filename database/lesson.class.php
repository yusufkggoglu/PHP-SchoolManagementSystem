<?php
class Lesson extends Db {
	public function getLesson() {
		try {
			$sql = "SELECT l.*, u.name, u.surname FROM lessons l INNER JOIN users u ON l.teacher_user_id = u.id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}

	public function getLessonForTeacher($id) {
		try {
			$sql = "SELECT l.*, u.name, u.surname FROM lessons l INNER JOIN users u ON l.teacher_user_id = u.id WHERE l.teacher_user_id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
			]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getLessonById($id) {
		try {
			$sql = "SELECT * from lessons WHERE id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
			]);
			return $stmt->fetch();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function createLesson($teacher_user_id,$lesson_name) {
		try {
			$sql = "INSERT INTO lessons(teacher_user_id,lesson_name) VALUES(:teacher_user_id,:lesson_name)";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'teacher_user_id' => $teacher_user_id,
				'lesson_name' => $lesson_name,
			]);
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function editLesson($id,$teacher_user_id,$lesson_name) {
		try {
            $sql = "UPDATE lessons SET teacher_user_id=:teacher_user_id,lesson_name=:lesson_name WHERE id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
				'teacher_user_id' => $teacher_user_id,
				'lesson_name' =>$lesson_name,
			]);
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function deleteLesson($id) {
		try {
			$sql = "DELETE FROM exams WHERE lesson_id=:id; DELETE FROM lessons WHERE id=:id; ";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'id' => $id,
			]);
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function searchByTeacher($user_id) {
		try {
			$sql = "SELECT l.*, u.name, u.surname FROM lessons l INNER JOIN users u ON l.teacher_user_id = u.id WHERE l.teacher_user_id=:user_id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([
				'user_id' => $user_id,
			]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
}
