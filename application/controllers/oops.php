<?php

class Oops extends Controller {
	
	function index()
	{
		$template = $this->loadView('oops');

		//get stuff from post
		$this->loadPlugin('Auth');
		if (!getPost('message'))
			$template->set('message', "It looks like an unknown error occured.");
		else
			$template->set('message', getPost('message'));

		$template->render();
	}

}

?>