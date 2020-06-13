<?php
/**
 * 
 */
class Exercise extends Model
{
	public $tableName = 'exercises';
	public $perPage = 3;
	function getExercises($page, $order, $type){
		$offset = ((int)$page-1)*$this->perPage;
		$query = $this->db->prepare("SELECT * FROM $this->tableName ORDER BY $order $type LIMIT $offset, $this->perPage");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
	}

	function hasNext($page){
		$offset = (int)$page*$this->perPage;
		$query = $this->db->prepare("SELECT count(id) as count FROM $this->tableName");
        $query->execute();
        $count = (int)$query->fetch(PDO::FETCH_ASSOC)['count'];
        return $count > $offset;
	}

	function setStatus($id){
		$query = $this->db->prepare("SELECT count(id) from $this->tableName WHERE id = $id");
		$query->execute();
		if(!$query->fetch(PDO::FETCH_ASSOC)){
			return false;
		}
		$query = $this->db->prepare("UPDATE $this->tableName SET status = 'finish' WHERE id = $id");
		$query->execute();
		return true;
	}

	function changeText($id, $desc){
		$query = $this->db->prepare("SELECT count(id) from $this->tableName WHERE id = $id");
		$query->execute();
		if(!$query->fetch(PDO::FETCH_ASSOC)){
			return false;
		}
		$desc = str_replace("'", '"', $desc);
		$query = $this->db->prepare("UPDATE $this->tableName SET description = '$desc' WHERE id = $id");
		$query->execute();
		return true;
	}

	function newEx($username, $email, $description){
		$description = str_replace("'", '"', $description);
		$query = $this->db->prepare("INSERT INTO $this->tableName (`username`, `email`, `description`) 
			VALUES ('$username', '$email', '$description')
			");
		$query->execute();
	}
}