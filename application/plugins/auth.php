<?php

//let's require our php script...
require_once(APP_DIR .'models/user.php');

function getPost($post = '')
{
	if (isset($_POST[urldecode($post)]))
	{
		return urldecode($_POST[urldecode($post)]);
	} else {
		return false;
	}
}

function generateHash($string)
{
	return md5(trim($string).'C0lL4BLaB_SqU1rr3Lz');
}


function authLogin($username, $password)
{
	//no sense logging in twice!
	if (authIsLoggedIn()) return true;
	
	//let's see if our password is right
	
	//echo 'AUTH: '.$username.' '.$password."<br>";
	$username = mysql_escape_string(trim(urldecode($username)));
	$password = generateHash(mysql_escape_string(urldecode($password)));
	
	//echo 'AUTH: '.$username.' '.$password."<br>";
	
	//now we're clean... leat's do a query
	global $config;	
	//var_dump($config);
	$connection = mysql_connect($config['db_host'], $config['db_username'], $config['db_password']) or die('MySQL Error: '. mysql_error());
	mysql_select_db($config['db_name'], $connection);
	
	//check our hashed password
	$qry = "SELECT `id` FROM users WHERE username = '".$username."' AND password = '".$password."';";
	
	//echo 'AUTH: '.$qry."<br>";
	
	//get our nice result
	$result = mysql_query($qry) or die('MySQL Error: '. mysql_error());
	$resultObjects = array();
	while($row = mysql_fetch_object($result)) $resultObjects[] = $row;
	
	//var_dump($resultObjects);
	
	//see if we actually found anything
	if (isset($resultObjects[0]) && isset($resultObjects[0]->id))
	{
		//we exist!  let's load our shit
		//echo 'AUTH: '."We foudn oru user"."<br>";
		$user = new User;
		if ($user->getByID($resultObjects[0]->id)) 
		{
			//so we exist and are loaded
			$_SESSION['user_id'] = $user->id;
			$_SESSION['user_group'] = $user->groupID;
			return true;
			
		} else return false;
	} else return false;
}

function authLogout()
{
	session_destroy();
	return true;
}

function authGetUser()
{
	if (!authIsLoggedIn()) return false;
	
	$user = new User;
	return $user->getByID($_SESSION['user_id']);
}

function authIsLoggedIn()
{
	if (isset($_SESSION['user_id'])) {
		$user = new User;
		if (!$user->getByID($_SESSION['user_id'])) return false;
		return true;
	}
	return false;
}

function authResetPassword($email)
{
	if (authIsLoggedIn()) return false;
	
	$user = new User;
	if (!$user->getByEmail($email)) return false;
	
	return $user->resetPassword();
}

?>