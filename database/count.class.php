<?php
class Count extends Db
{

	public function countStudentForAdmin()
	{
		try {
			$sql = "SELECT COUNT(id) AS count FROM users WHERE role='Student'";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute();
			$row =  $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['count'];
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function countTeacher()
	{
		try {
			$sql = "SELECT COUNT(id) AS count FROM users WHERE role='Teacher'";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute();
			$row =  $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['count'];
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function countClassForAdmin()
	{
		try {
			$sql = "SELECT COUNT(id) AS count FROM classes";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute();
			$row =  $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['count'];
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function averageOfClass($id)
	{
		try {
			$sql = "SELECT  AVG(exam_score) AS average FROM exams e JOIN classes c ON e.class_id=c.id  WHERE c.class_teacher_id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(['id' => $id]);
			$row =  $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['average'];
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function countStudentForTeacher($id)
	{
		try {
			$sql = "SELECT COUNT(student_id) AS count FROM classes_students cs JOIN classes c ON cs.class_id=c.id WHERE c.class_teacher_id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(['id' => $id]);
			$row =  $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['count'];
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function countExam($id)
	{
		try {
			$sql = "SELECT COUNT(id) AS count FROM exams e WHERE e.student_id=:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(['id' => $id]);
			$row =  $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['count'];
		} catch (Exception $e) {
			echo "Hata : {$e->getMessage()}";
		}
	}
	public function getAvgScoreByStudentId($id)
	{
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
}
