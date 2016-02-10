<?php

/*Login_model
This model gets email and password from the Login controller
and logs in the admin through the doLogin() function.
Database used all through this project is Parse.com's backend as a service.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

use Parse\ParseUser;
use Parse\ParseException;

class Login_model extends CI_Model {

	public function __construct()
        {
                parent::__construct();
        }

    public function doLogin($userName, $password){

    	try {
  			$user = ParseUser::logIn($userName, $password);
  			// Do stuff after successful login.
  			// return true to the Login controller so that it can load the dashBoard
  			return ['status' => true,];

			} catch (ParseException $ex) {
				//return false to the Login controller along with the error message 
				//so that it can send the error message to the view 
				//through the notification_helper
				return ['status' => false, 'parseMsg' => $ex->getMessage()];

		}

    }
	
}

/*
End of Login_Model.
 */
