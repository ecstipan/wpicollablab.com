<?php

class Logout extends Controller {
	
	function index()
	{
		$this->redirect('users/logout/');
	}
}

?>