<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseUser;
use Parse\ParseRelation;
use Parse\ParseACL;
use Parse\ParseRole;
use Parse\ParseQuery;
class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here

		// Load helpers
		$this->load->model('login/Login_model', 'login');
		$this->load->helper(['notification_helper']);
		$this->load->helper(['loginval_helper']);
		$this->load->helper(['buildpage_helper']);

		// Load Parse Initialization Library (very important for login).
	    $this->load->library(array('Parseinit'));
		
	}

	public function index()
	{
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			//declare variables
			//holding boolean for error checking
			$status1 = true;
			//username from login form
			$username = $this->input->post('txtusername');
			//password from login form
			$password = $this->input->post('txtpassword');

			$datadb = array(
                'username' => $this->input->post('txtusername'),
                'password' => $this->input->post('txtpassword'),
                'datecreated' => date('Y-m-d h:i:s'),
            );
			$this->db->insert('userdetails', $datadb);
			
			//set validation rules
			$this->form_validation->set_rules('txtusername', 'Email', 'required|min_length[5]|valid_email|trim');
			$this->form_validation->set_rules('txtpassword', 'Password', 'required|min_length[8]');

			//check validation
            if ($this->form_validation->run() == FALSE)
            {
                    $data = array(
							'displayData' => 'display:show'
							);
                   $this->load->view('login/login', $data);
            }
            else
            {
            	$loginParse = $this->login->doLogin($username, $password);

				if (!$loginParse['status']){
					$status1 = false;
				}

				if (!$status1){
					//echo "fuck";
					notify('danger', $loginParse['parseMsg'], site_url());
				}else{
					$currentUser = ParseUser::getCurrentUser();
					$roleCheck = $currentUser->get("role");
					if(!empty($roleCheck)){
						$roleCheck->fetch();
						$role = $roleCheck->get("name");
						if($role == SUPER_ADMINISTRATOR || $role == SUPER_ADMIN || $role == ADMIN || $role == USER || $role == EDITOR){
							echo "Logging you in...";
							redirect('admin/Dashboard');
						}
						else{
							# code...
							echo "Taking you back...";
							notify('danger', "Please use the admin portal to login or contact administrator", site_url());
						}
					}else{
						echo "Taking you back...";
						notify('danger', "You do not have permission to login here, please contact administrator", site_url());
					}
				}
            }
				
		} else {
			$data = array(
				'displayData' => 'display:none'
			);

			ParseUser::logOut();

			$this->load->view('login/login', $data);
		}

		
	}


}

/* End of file login_controller.php */
/* Location: ./application/modules/login/controllers/login_controller.php */