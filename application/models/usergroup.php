<?php

class UserGroup extends Model {
	
	public $admin = false;
	public $name = "Unknown";
	public $id = 0;
	public $labPermission = false;
	
	public function getByID($id)
	{
		//let's see if this group exists
		$id = intval($this->escapeString($id));
		$result = $this->query('SELECT * FROM groups WHERE id="'. $id .'"');

		if (!isset($result[0])) return false;

		//update this user object with our shit
		$this->id = $result[0]->id;
		$this->name = $result[0]->name;
		$this->admin = $result[0]->admin;
		$this->labPermission = $result[0]->lab;

		return $this;
	}

	public function canOpenLab()
	{
		return $this->labPermission;
	}

	public function isAdmin()
	{
		return $this->admin;
	}
	
}

?>