<?php
    function sendMail($to, $subject = 'No Subject', $body = ''){
    		
		/*
    	if(!isset($to)) return false;
		
		//do some cleaning
		$body = trim($body);
		$subject = stripslashes(nl2br(trim($subject)));
		
		$replyName = 'WPI CollabLab';
		$replyEmail = 'donotreply@collablab.wpi.edu';
		
		//use pear's SMTP mail factory
		require_once("Mail.php");
		
		$from = $replyName." <".$replyEmail.">";

		$host = '';
		$username = 'rcstipanovich@wpi.edu';
		$password = 'R@yce3393';
		$auth = true;
		$port = $coreSettings['preferences']['mail_smtp_port'];
		
		 
		$headers = array (	'From' => $from,
		   					'To' => $to,
		   					'Subject' => $subject);
		$smtp = Mail::factory('smtp',
			array (	'host' => $host,
					'auth' => $auth,
					'port' => $port,
					'username' => $username,
					'password' => $password));
		 
		$mail = $smtp->send($to, $headers, $body);
		 
		if (PEAR::isError($mail)) {
			_debug("Email Failed: ".$mail->getMessage());
			return false;
		}
		 */
		
		//everything worked
		return true;
    }
?>