<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * undocumented function
 *
 * @return void
 * @author 
 **/

class Error_page extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$this->load->view('venue/error_page', '', FALSE);
	}
}