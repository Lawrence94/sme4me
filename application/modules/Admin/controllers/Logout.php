<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * undocumented function
 *
 * @return void
 * @author 
 **/
use Parse\ParseUser;
use Parse\ParseObject;

class Logout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		
		// Load Parse Initialization Library
		$this->load->library(array('Parseinit'));
	}

	public function index()
	{
		ParseUser::logOut();
		$userDetails = ['firstName',
						'lastName',
						'username'
					];
		$dbusername = $this->session->userdata('username');
		if (!$this->session->unset_userdata($userDetails)){
			$this->db
                    ->where('username', $dbusername)
                    ->delete('userDetails');
        }
		$this->session->unset_userdata($userDetails);
		redirect('company/login');
	}

}

/* End of file Logout.php */
/* Location: ./application/modules/dashboard/controllers/Logout.php */