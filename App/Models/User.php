<?php
/**
 * 
 */
class User extends Model
{
	public $tableName = 'users';
	public function checkLogin($login, $pass){
		$query = $this->db->prepare("SELECT * FROM $this->tableName where username = '$login' and password = '$pass' LIMIT 1");
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
	}
}