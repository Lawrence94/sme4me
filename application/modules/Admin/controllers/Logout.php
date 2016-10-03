<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * undocumented function
 *
 * @return void
 * @author 
 **/

class Logout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		$this->session->unset_userdata('user_vars');
		redirect('Admin/Login', 'refresh');
	}

}

/* End of file Logout.php */
/* Location: ./application/modules/dashboard/controllers/Logout.php */