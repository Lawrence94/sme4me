<?php 

use Parse\ParseObject;
use Parse\ParseUser;

class Lockscreen extends CI_Controller{

	public function __construct()
		{
			parent::__construct();
			//Do your magic here
		    $this->load->helper(array('buildPage_helper'));
		    $this->load->model('login/Login_model', 'login');
			$this->load->helper(['notification_helper']);
			$this->load->helper(['loginval_helper']);
		    $this->load->library(array('Parseinit'));
		}

	public function index()
	{

		// This only happens if there was a post request from the lockscreen form.
		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			//declare variables
			//holding boolean for error checking
			$status1 = true;

			// get username from login form
			// this was made hidden in the form so that the user doesn't see it.
			$username = $this->input->post('txtusername');

			// get password from login form
			$password = $this->input->post('txtpassword');
			
			// set validation rules
			$this->form_validation->set_rules('txtusername', 'Email', 'required|min_length[5]|valid_email|trim');
			$this->form_validation->set_rules('txtpassword', 'Password', 'required');

			// check validation
			// If there was an error during validation, this runs.
            if ($this->form_validation->run() == FALSE)
            {
                    $data = array(
							'displayData' => 'display:show'
							);
                   $this->load->view('lockscreen/lockscreen_company', $data);
            }
            // If validation was successful, this runs.
            else
            {
            	// login using the login model
            	$loginParse = $this->login->doLogin($username, $password);

            	// check if the status message from the login operation is false.
				if (!$loginParse['status']){
					$status1 = false;
				}

				// do something if the status is false(e.g, show an error message).
				if (!$status1){
					notify('danger', $loginParse['parseMsg'], 'company/Lockscreen');
				}
				// Login operation was successful($status1 is now true), so show the dashboard.
				else{
					echo "Logging you in...";
					//$this->session->sess_destroy();
					$userDetails = ['firstName',
									'lastName',
									'username'
								];
					//$this->session->unset_userdata($userDetails);
					redirect('company/Dashboard', 'refresh');
            }
				
		}
		// This happens if there is a normal navigation to the page 
		}else {

			//$this->menu_header();
			$currentUser = ParseUser::getCurrentUser();
			$firstName = '';
			$lastName = '';
			$username = '';

			$userDetails = ['firstName',
							'lastName',
							'username'
								];
			if (!$this->session->userdata('firstName')){
				echo 'session totally destroyed, sorry.';
				redirect('company/Login');
			}
			else{
			if ($currentUser) {
    		// do stuff with the user
    		$firstName = $currentUser->get("firstName");
    		$lastName = $currentUser->get("lastName");
    		$username = $currentUser->get("username");
    		$userDetails = array(
        	'firstName' => $firstName,
        	'lastName' => $lastName,
        	'username' => $username
        	);
        	$this->session->set_userdata($userDetails);

			//$currentUser = ParseUser::getCurrentUser();
			
			//if ($currentUser){
				// log the user out
				ParseUser::logOut();
				// load lockscreen view with the details needed for login
				// which has already been set in the $adminName array (which excludes the password for obvious reasons).
				
			}
			$adminDetails = ['firstName' => $this->session->userdata('firstName'),
						  	 'lastName' => $this->session->userdata('lastName'),
						  	 'username' => $this->session->userdata('username'),
						  	 'displayData' => 'display:none'
					];
			$this->load->view('lockscreen/lockscreen_company', $adminDetails);
			// else{
			// 	// go to the main login page if the user is not in session
			// 	redirect('admin/Login','refresh');
			// 	// destroy the codeIgniter session set with user details in the menu_header() function.
			// 	$this->session->sess_destroy();
			// }
			// $data = array(
			// 	'displayData' => 'display:none',
			// 	'firstName' => $this->session->userdata('firstName'),
			//     'lastName' => $this->session->userdata('lastName'),
			// 	'username' => $this->session->userdata('username')
			// );

			// $this->load->view('lockscreen/lockscreen', $data);
		  }

		}
		
	}

	public function menu_header(){
		//getting the currently logged in admin
		

		

		//} else {
    		// show the signup or login page
    		//$this->session->sess_destroy();
    		//redirect('admin/Lockscreen');
		//}
    }


}