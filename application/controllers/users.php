<?php

class Users extends Controller {

	function index()
	{
		//list all users
		$this->redirect('users/page/1/');
	}

	function page($page)
	{
		//see if we have this many pages

		//load our user list

		$template = $this->loadView('users_list');
		$template->render();
	}

	function view($id)
	{
		//Incluse our AuthFunction
		$this->loadPlugin('Auth');
		//see if we have edit rights
		
		$loggedIn = authIsLoggedIn();
		$isAdmin = $loggedIn ? authGetUser()->isAdmin() : false;
		$canEdit = (authIsLoggedIn() && (authGetUser()->id == intval($id) || $isAdmin));

		//load our user Model
		$user = $this->loadModel('User');

		//check if this user exists
		if (!$user->getByID($id)) {
			//this user doesn't exist
			$this->redirect('users/page/1/');
		} else {
			//We found our user!
			//Draw the page using our template!
			$template = $this->loadView('user_view');

			//set up our variables
			$template->set('realName', $user->getRealName());
			$template->set('classOf', $user->classOf);
			$template->set('email', $user->email);
			
			$facebookPage = $user->facebookPage != '' ? $user->facebookPage : false;
			$template->set('facebookPage', $facebookPage);
			
			$template->set('dateJoined', $user->dateJoinedString());
			$template->set('groupName', $user->getGroup());
			$template->set('toolTrained', $user->toolTrained);
			$template->set('safetyTrained', $user->safetyTrained);
			$template->set('labAccess', $user->canOpenLab());
			$template->set('timeInLab', $user->timeInLab);
			$template->set('timeInLabString', $user->getLabTimeString());
			$template->set('memberSince', $user->memberSince());
			
			//let's handle our AUTH stuff
			$template->set('loggedIn', $loggedIn);
			$template->set('isAdmin', $isAdmin);
			$template->set('canEdit', $canEdit);
			

			//Finally draw the thing
			$template->render();
		}
	}
    
    function register()
    {
    	//check our post stuff
    	
    	//make a new user
    	
    	//register them
    	
    	//redirect
    	
    }

    function login()
    {
    	//perform the login and reidrect
    	$this->loadPlugin('Auth');

    	if(!(getPost('username') && getPost('password'))){
    		//echo 'we are missing into';
    		$this->redirect('login/error/');
    	} else {
    		if (authLogin(getPost('username'), getPost('password'))) {
    			$this->redirect('users/view/'.authGetUser()->id.'/');//it worked!
    			//echo "we're logged in!";
    		} else {
    			$this->redirect('login/error/');//we failed
    			//echo "we failed to login";
			}
    	}
    }

    function logout()
    {
    	//perform logout
    	$this->loadPlugin('Auth');
		authLogout();

    	//redirect to root
    	$this->redirect('login/');
    }

    function edit($id)
    {
		//check if we have edit permissions
    	$this->loadPlugin('Auth');
    	if (!authIsLoggedIn() || !(authGetUser()->isAdmin() || authGetUser()->id == intval(urldecode($id)))) {
    		$this->redirect('users/page/1/');
    		return;
    	}

    	//we do!
    	//see if we're submitting edit stuff or not
    	if (isset($_POST[''])) {
    		//actually update them

    		//redirect on success

    	} else {
    		//show template
    		$template = $this->loadView('user_edit');

    		$template->render();
    	}
    }

    function remove($id)
    {
    	//check if we have edit permissions
    	$this->loadPlugin('Auth');
    	if (!authIsLoggedIn() || !(authGetUser()->isAdmin() || authGetUser()->id == intval(urldecode($id)))) {
    		$this->redirect('users/page/1/');
    		return;
    	}
		
    	if(!getPost('id')){
    		//echo 'we are missing into';
    		$template = $this->loadView('user_delete');
			
			//see if it's us
			if (authGetUser()->id == getPost('id')) {
    			//WE'RE DELETING OUT OWN ACCOUNT
    			
    		}
			
    		$template->render();
    	} else {
    		//so we have post data
    		if ($id != getPost('id')) {
    			//trying to delete a different user
    			$this->redirect('users/page/1/');
    		} else {
    			//we can delete them
    			
    		}
    	}
    }

}

?>
