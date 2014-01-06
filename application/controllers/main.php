<?php

class Main extends Controller {
	
	function index()
	{
		$this->loadPlugin('Auth');
		//see if we have edit rights
		
		$loggedIn = authIsLoggedIn();
		$isAdmin = $loggedIn ? authGetUser()->isAdmin() : false;
		$canEdit = (authIsLoggedIn() && (authGetUser()->id == intval($id) || $isAdmin));
		
		$template = $this->loadView('main_view');
		
		//let's handle our AUTH stuff
		$template->set('loggedIn', $loggedIn);
		$template->set('isAdmin', $isAdmin);
		$template->set('canEdit', $canEdit);
		
		$template->render();
	}
    
}

?>
