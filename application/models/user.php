<?php

class User extends Model {
	public $id = 0;
	public $username = 'Unknown';
	public $email = 'Unknown';
	public $password = 'Unknown';
	public $studentID = 0;
	public $timeInLab = 0;
	public $groupID = -1;
	public $group;
	public $facebookPage = "";
	public $firstName = "";
	public $lastName = "";
	public $classOf = 0;
	public $safetyTrained = false;
	public $toolTrained = false;
	public $dateJoined = 0;
	
	public function getByID($id)
	{
		$id = intval($this->escapeString($id));
		$result = $this->query('SELECT * FROM users WHERE id="'. $id .'"');

		if (!isset($result[0])) return false;

		//update this user object with our shit
		$this->id = $result[0]->id;
		$this->username = stripslashes($result[0]->username);
		$this->password = stripslashes($result[0]->password);
		$this->email = stripslashes($result[0]->email);
		$this->studentID = stripslashes($result[0]->studentid);
		$this->timeInLab = stripslashes($result[0]->timeinlab);
		$this->facebookPage = stripslashes($result[0]->facebookpage);
		$this->firstName = stripslashes($result[0]->first);
		$this->lastName = stripslashes($result[0]->last);
		$this->classOf = stripslashes($result[0]->classof);
		$this->safetyTrained = stripslashes($result[0]->tool);
		$this->toolTrained = stripslashes($result[0]->safe);
		$this->dateJoined = stripslashes($result[0]->joined);

		//Load our Group stuff
		$this->groupID = stripslashes($result[0]->group_id);
		$this->group = $this->loadModel('UserGroup');
		$this->group->getByID($this->groupID);

		return $this;
	}

	public function getByEmail($email)
	{
		$id = intval($this->escapeString(trim(urldecode($id))));
		$result = $this->query('SELECT * FROM users WHERE email="'. $email .'"');

		if (!isset($result[0])) return false;

		//update this user object with our shit
		$this->id = $result[0]->id;
		$this->username = stripslashes($result[0]->username);
		$this->password = stripslashes($result[0]->password);
		$this->email = stripslashes($result[0]->email);
		$this->studentID = stripslashes($result[0]->studentid);
		$this->timeInLab = stripslashes($result[0]->timeinlab);
		$this->facebookPage = stripslashes($result[0]->facebookpage);
		$this->firstName = stripslashes($result[0]->first);
		$this->lastName = stripslashes($result[0]->last);
		$this->classOf = stripslashes($result[0]->classof);
		$this->safetyTrained = stripslashes($result[0]->tool);
		$this->toolTrained = stripslashes($result[0]->safe);
		$this->dateJoined = stripslashes($result[0]->joined);

		//Load our Group stuff
		$this->groupID = stripslashes($result[0]->group_id);
		$this->group = $this->loadModel('UserGroup');
		$this->group->getByID($this->groupID);

		return $this;
	}

	private function generateHash($string)
	{
		return md5(trim($string).'C0lL4BLaB_SqU1rr3Lz');
	}

	public function setGroup($gr)
	{
		$this->groupID = intval($gr);
		$this->group->getByID($this->groupID);
	}

	public function isAdmin()
	{
		return $this->group->isAdmin();
	}

	public function canOpenLab()
	{
		return $this->group->canOpenLab();
	}

	public function getRealName()
	{
		return $this->firstName." ".$this->lastName;
	}

	public function getLabTimeString()
	{
		$seconds = $this->timeInLab;
		$hours = floor($seconds / 3600);
		$mins = floor(($seconds - ($hours*3600)) / 60);
		$secs = floor($seconds % 60);

		return $hours.':'.$mins.':'.$secs;
	}

	public function save()
	{
		//update mysql with our current info
		//check if we exist
		$result = $this->query('SELECT * FROM users WHERE id="'. $this->id .'"');
		//if we don't... register us
		if (!isset($result[0])) return $this->register();

		//so we do exist, let's save our info!
		$result = $this->query('UPDATE users SET 
		password = "'.mysql_escape_string($this->password).'", 
		email = "'.trim(mysql_escape_string($this->email)).'",
		studentid = "'.trim(mysql_escape_string($this->studentID)).'",
		group_id = "'.intval(mysql_escape_string($this->groupID)).'",
		first = "'.trim(mysql_escape_string($this->firstName)).'",
		last = "'.trim(mysql_escape_string($this->lastName)).'",
		facebookpage = "'.trim(mysql_escape_string($this->facebookPage)).'",
		classof = "'.intval(mysql_escape_string($this->classOf)).'",
		tool = "'.intval(mysql_escape_string($this->toolTrained)).'",
		safe = "'.intval(mysql_escape_string($this->safetyTrained)).'" 
		WHERE id="'.$this->id.'";');
		
		//check if we're updated
		if (!$result) return false;

		return true;
	}

	private function generateRandomString()
	{
		$random_string = "";
		$valid_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$length = 15;

	    // count the number of chars in the valid chars string so we know how many choices we have
	    $num_valid_chars = strlen($valid_chars);
	
	    // repeat the steps until we've created a string of the right length
	    for ($i = 0; $i < $length; $i++)
	    {
	        // pick a random number from 1 up to the number of valid chars
	        $random_pick = mt_rand(1, $num_valid_chars);
	
	        // take the random character out of the string of valid chars
	        // subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
	        $random_char = $valid_chars[$random_pick-1];
	
	        // add the randomly-chosen char onto the end of our string so far
	        $random_string .= $random_char;
	    }
	
	    // return our finished random string
	    return $random_string;
	}

	public function resetPassword()
	{
		//reset their password
		$randPassword = $this->generateRandomString();
		$this->password = $this->generateHash($randPassword);
		
		//update SQL
		$result = $this->query('UPDATE users SET 
		password = "'.mysql_escape_string($this->password).'" 
		WHERE id="'.$this->id.'"');
		
		if(!$result) return false;

		//send them an email
		$this->loadPlugin('Mail');
		return sendMail($this->email, "Your password has been reset!", "Hello,
		
		Your password has been reset for your CollabLab account.  Your new password is:
		
		".$randPassword."
		
		Thanks,
		The CollabLab Squirrel");
	}

	public function dateJoinedString()
	{
		return $this->to_datetime(strtotime($this->dateJoined));
	}

	public function memberSince()
	{
		$now = time();
	 
		// Difference from given timestamp
		$difference = $now - strtotime($this->dateJoined);
	 
		// If less than one hour (59 minutes and 30 seconds, to be precise), we count minutes
		if($difference < 3570)
		{
			$output = round($difference / 60).' Minutes';
		}
		// If less than 23 hours 59 minutes and 30 seconds, we count hours
		elseif ($difference < 86370)
		{
			$output = round($difference / 3600).' Hours';
		}
		// If less than 6 days 23 hours 59 minutes and 30 seconds, we count days
		elseif ($difference < 604770)
		{
			$output = round($difference / 86400).' Days';
		}
		// If less than 164 days 23 hours 59 minutes and 30 seconds, we count weeks
		elseif ($difference < 31535970)
		{
			$output = round($difference / 604770).' Weeks';
		}
		// Else we count years
		else
		{
			$output = round($difference / 31536000).' Years';
		}
	 
		return $output;
	}

	public function getGroup()
	{
		return $this->group->name;
	}

	public function register()
	{
		//instert them into the table
		//so we do exist, let's save our info!
		$result = $this->query('INSERT INTO users 
		(`username`, 
		`password`, 
		`email`, 
		`studentid`, 
		`group_id`, 
		`first`, 
		`last`, 
		`facebookpage`, 
		`classof`
		) VALUES (
		"'.mysql_escape_string($this->username).'", 
		"'.mysql_escape_string($this->password).'", 
		"'.trim(mysql_escape_string($this->email)).'", 
		"'.trim(mysql_escape_string($this->studentID)).'", 
		"'.intval(mysql_escape_string($this->groupID)).'", 
		"'.trim(mysql_escape_string($this->firstName)).'", 
		"'.trim(mysql_escape_string($this->lastName)).'", 
		"'.trim(mysql_escape_string($this->facebookPage)).'", 
		"'.intval(mysql_escape_string($this->classOf)).'");"');
		
		if (!isset($result)) return false;
		
		return $this;
	}

	public function getByStudentID($WPI_ID)
	{
		//extract the student ID form the string
		$WPI_ID = trim($WPI_ID);
		$WPI_ID = str_replace("%", "", $WPI_ID);
		$WPI_ID = str_replace(";", "", $WPI_ID);
		$WPI_ID = str_replace("+", "", $WPI_ID);
		$WPI_ID = str_replace("01?", "?", $WPI_ID);
		$WPI_ID = str_replace("02?", "?", $WPI_ID);
		$WPI_ID = str_replace("03?", "?", $WPI_ID);
		$WPI_ID = str_replace("04?", "?", $WPI_ID);
		$WPI_ID = str_replace("05?", "?", $WPI_ID);
		$strtab = explode("?", $WPI_ID);
		
		if (isset($strtab[0]) && strlen($strtab[0]) == 9) $WPI_ID = $strtab[0];
		else if (isset($strtab[1]) && strlen($strtab[1]) == 9) $WPI_ID = $strtab[1];
		else if (isset($strtab[2]) && strlen($strtab[2]) == 9) $WPI_ID = $strtab[2];
		else return false;
		
		//hash the ID
		$WPI_ID = $this->generateHash($WPI_ID);
		
		//check if matches our HASH in SQL
		$id = intval($this->escapeString($WPI_ID));
		$result = $this->query('SELECT * FROM users WHERE studentid="'. $id .'"');

		if (!isset($result[0])) return false;

		//update this user object with our shit
		$this->id = $result[0]->id;
		$this->username = stripslashes($result[0]->username);
		$this->password = stripslashes($result[0]->password);
		$this->email = stripslashes($result[0]->email);
		$this->studentID = stripslashes($result[0]->studentid);
		$this->timeInLab = stripslashes($result[0]->timeinlab);
		$this->facebookPage = stripslashes($result[0]->facebookpage);
		$this->firstName = stripslashes($result[0]->first);
		$this->lastName = stripslashes($result[0]->last);
		$this->classOf = stripslashes($result[0]->classof);
		$this->safetyTrained = stripslashes($result[0]->tool);
		$this->toolTrained = stripslashes($result[0]->safe);
		$this->dateJoined = stripslashes($result[0]->joined);

		//Load our Group stuff
		$this->groupID = stripslashes($result[0]->group_id);
		$this->group = $this->loadModel('UserGroup');
		$this->group->getByID($this->groupID);

		return $this;
	}

	public function delete()
	{
		//update mysql with our current info
		//check if we exist
		$result = $this->query('SELECT * FROM users WHERE id="'. $this->id .'"');
		//if we don't exist, we can't be deleted
		if (!isset($result[0])) return false;
		
		//actually delete
		$result = $this->query('DELETE FROM users WHERE id="'. $this->id .'"');
		if (!isset($result[0])) return false;
		return true;
	}
}

?>
