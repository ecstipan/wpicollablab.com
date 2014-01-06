<?php

class Login extends Controller {
	
	function index()
	{
		//see if we're alrady logged in and redirect if we are
		$this->loadPlugin('Auth');
		if (authIsLoggedIn()) {
			//redirect
    		$this->redirect('');
    		return;
    	}

		//we're not.. oaky... let's show our login form
		$template = $this->loadView('user_login');
		$template->render();
	}
	
	function error()
	{
		//get our posted error
		
		//load our template
		$template = $this->loadView('login_error');
		$template->render();
	}
	
	function register()
	{
		//see if we're logged in and redir if we are
		$this->loadPlugin('Auth');
		if (authIsLoggedIn()) {
			//redirect
    		$this->redirect('');
    		return;
    	}
		
		//okay, so we're not logged in
		$template = $this->loadView('login_register');
		$template->render();
	}

}

?>