<?php

class Me extends Controller {

	function index()
	{
		$this->loadPlugin('Auth');
		if (authIsLoggedIn()) {
			//redirect
    		$this->redirect('users/view/'.authGetUser()->id.'/');
    	} else {
    		$this->redirect('login/');
    	}
	}
	
}

?>