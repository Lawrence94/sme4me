<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Parse\ParseObject;
use Parse\ParseUser;
use Parse\ParseQuery;
use Parse\ParseException;
use Parse\ParseACL;
use Parse\ParseRole;
class Managers extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	    $this->load->helper(array('buildPage_helper'));
	    $this->load->helper(['notification_helper']);
	    $this->load->library(array('Parseinit'));
	    $this->load->helper(['loginval_helper']);
	    $this->load->model('signup_company/Signup_model', 'signup');
	    $this->load->model('companyquery/Companyquery_model', 'compquery');
	    $this->load->model('companyquery/Editcompquery_model', 'compeditquery');
	}


	public function index()
	{

		if ($this->input->post('comp')) {
			$admin = $this->input->post('comp');
			
			$adminfName = $admin['adminfname'];
			$adminlName = $admin['adminlname'];
			$adminMail = $admin['adminmail'];
			$adminPass = $admin['adminpass'];
			$adminPerm = $admin['adminperm'];


			//var_dump($companyName);
			//exit;

			$status1 = true;

			$this->form_validation->set_rules('comp[adminfname]', 'First Name', 'required');
			$this->form_validation->set_rules('comp[adminlname]', 'Last Name', 'required');
			$this->form_validation->set_rules('comp[adminmail]', 'Email', 'required|valid_email|trim');
			$this->form_validation->set_rules('comp[adminpass]', 'Password', 'required|min_length[8]');
			$this->form_validation->set_rules('comp[adminperm]', 'Permission', 'required');

			//declare variables
			//holding boolean for error checking
			if ($this->form_validation->run() == FALSE)
            {
            	$currentUser = ParseUser::getCurrentUser();

            	if ($currentUser){
		   			$displayData = 'display:show';
                    $data = $this->menu_header($displayData);
					buildPage($this->load->view('managers/managers', $data, true), 'Manage Users');
				}
				// If the user is not logged in, show the login page.
				else{
					redirect('company/login','refresh');
					}
            }
            else
            {
            	$currentUser = ParseUser::getCurrentUser();
            	if ($currentUser){
            	$addManagerParse = $this->signup->doAddManager($adminfName, $adminlName, 
            		$adminMail, $adminPass, $adminPerm);

				if (!$addManagerParse['status']){
					$status1 = false;
				}

				if (!$status1){
					//echo "fuck";
					notify('danger', $addManagerParse['parseMsg'], 'company/managers');
				}else{
					echo "Please wait, we'll take you back to the dashboard right away...";
					notify('success', 'User Added Succesfully', 'company/managers');
				}
            }else{
            	redirect('company/login','refresh');
            }
        }
				
		}else if ($this->input->post('useredit')) {
			$admin = $this->input->post('useredit');
			
			$editfName = $admin['adminfname'];
			$editlName = $admin['adminlname'];
			$editMail = $admin['adminmail'];
			$editPass = $admin['adminpass'];
			$editPerm = $admin['adminperm'];
			$editId = $admin['adminid'];


			//var_dump($companyName);
			//exit;

			$status1 = true;

			$this->form_validation->set_rules('useredit[adminfname]', 'First Name', 'required');
			$this->form_validation->set_rules('useredit[adminlname]', 'Last Name', 'required');
			$this->form_validation->set_rules('useredit[adminmail]', 'Email', 'required|valid_email|trim');
			$this->form_validation->set_rules('useredit[adminpass]', 'Password', 'required|min_length[8]');
			$this->form_validation->set_rules('useredit[adminperm]', 'Permission', 'required');

			//declare variables
			//holding boolean for error checking
			if ($this->form_validation->run() == FALSE)
            {
            	$currentUser = ParseUser::getCurrentUser();

            	if ($currentUser){
		   			$displayData = 'display:show';
		   			$data = $this->edit_header($displayData, $adminId);
                    //$data = $this->menu_header($displayData);
					buildPage($this->load->view('managers/editManager', $data, true), 'Manage Users - Edit');
				}
				// If the user is not logged in, show the login page.
				else{
					redirect('company/login','refresh');
					}
            }
            else
            {
            	$currentUser = ParseUser::getCurrentUser();
            	if ($currentUser){
            	$editManagerParse = $this->compeditquery->doEditManager($editfName, $editlName, 
            		$editMail, $editPass, $editPerm, $editId);

				if (!$editManagerParse['status']){
					$status1 = false;
				}

				if (!$status1){
					//echo "fuck";
					notify('danger', $editManagerParse['parseMsg'], 'admin/managers');
				}else{
					echo "Please wait, we'll take you back to the dashboard right away...";
					notify('success', 'User Details saved Succesfully', 'admin/managers/editManager/' . $editId);
				}
            }else{
            	redirect('company/login','refresh');
            }
        }
				
		}else if ($this->input->post('userassign')) {
			$beacon = $this->input->post('userassign');
			
			$user = $beacon['userid'];
			$venue = $beacon['venue'];
			//var_dump($companyName);
			//exit;

			$status1 = true;

			$this->form_validation->set_rules('userassign[venue]', 'Venue', 'required');

			//declare variables
			//holding boolean for error checking
			if ($this->form_validation->run() == FALSE)
            {
            	$currentUser = ParseUser::getCurrentUser();

            	if ($currentUser){
		   			$displayData = 'display:show';
                    $data = $this->menu_header($displayData);
					buildPage($this->load->view('managers/managers', $data, true), 'Manage Users');
				}
				// If the user is not logged in, show the login page.
				else{
					redirect('company/login','refresh');
					}
            }
            else
            {
            	$currentUser = ParseUser::getCurrentUser();
            	if ($currentUser){
            	$assignUserParse = $this->signup->doAssUser($user, $venue);

				if (!$assignUserParse['status']){
					$status1 = false;
				}

				if (!$status1){
					//echo "fuck";
					notify('danger', $assignUserParse['parseMsg'], 'company/managers');
				}else{
					echo "Please wait, we'll take you back to the dashboard right away...";
					notify('success', 'User Assigned To Venue Succesfully', 'company/managers');
				}
            }else{
            	redirect('company/login','refresh');
            }
        }
				
		}else if ($this->input->post('unassignuser')) {
			$beacon = $this->input->post('unassignuser');
			
			$user = $beacon['userid'];
			//var_dump($companyName);
			//exit;

			$status1 = true;

		
            	$currentUser = ParseUser::getCurrentUser();
            	if ($currentUser){
            	$unAssignUserParse = $this->signup->doUnAssUser($user);

				if (!$unAssignUserParse['status']){
					$status1 = false;
				}

				if (!$status1){
					//echo "fuck";
					notify('danger', $unAssignUserParse['parseMsg'], 'company/managers');
				}else{
					echo "Please wait, we'll take you back to the dashboard right away...";
					notify('success', 'User Unassigned Succesfully', 'company/managers');
				}
            }else{
            	redirect('company/login','refresh');
            }
        
				
		}
		else{

		$currentUser = ParseUser::getCurrentUser();
		$displayData = 'display:none';
		$adminName = $this->menu_header($displayData);
		if ($currentUser){
			$dashView = $this->load->view('managers/managers', $adminName, true);
			buildPage($dashView, 'Manage Users');
		}
		else{
			//echo 'hey';
			redirect('company/login','refresh');
			}

		}
		
	}

	public function menu_header($displayData){

		//getting the currently logged in admin
		$currentUser = ParseUser::getCurrentUser();
		$firstName = '';
		$lastName = '';
		$url = '/company/managers';
		$cssClass = 'active';
		$cssClass1 = '""';
		$cssClass2 = '""';
		$cssClass3 = '""';
		if ($currentUser) {
    		// do stuff with the user
    		$roleCheck = $currentUser->get("role");
    		$roleCheck->fetch();
    		$role = $roleCheck->get("name");
    		//$roleId = $roleCheck->get("objectId");
 
    		$query = new ParseQuery("_Role");
			$query->notEqualTo("name", $role);
			$query->equalTo("users", $currentUser);
			$role_info = [];
			try{
			$result = $query->find();
			}
			catch (ParseException $ex) {
		    if($ex->getMessage()){
		    	redirect('company/Error_page','refresh');
		    	}
			}
			
			for ($i = 0; $i < count($result); $i++) {
			    	$object = $result[$i];
					$role_info[$object->getObjectId()] = $object->get('name');
				   			  
					}
			
    		return array(
        	'redirect' => $url,
        	'active1' => $cssClass,
        	'active4' => $cssClass1,
        	'active2' => $cssClass1,
        	'active' => $cssClass2,
        	'active5' => $cssClass1,
        	'role' => $role,
        	'displayData' => $displayData,
        	'permission' => $role_info,
        	'active3' => $cssClass3,
        	'modaluserQuery'=> $this->compquery->doUserQuery(),
        	'userVenue' => $this->compquery->doVenueQuery(),
        	);

		} else {
    		// show the signup or login page
    		redirect('company/login','refresh');
		}
    }

    public function edit_header($displayData, $userId){
		//getting the currently logged in admin
		$currentUser = ParseUser::getCurrentUser();
		$firstName = '';
		$lastName = '';
		$objectId = '';
		$objectName = '';
		$url = 'company/managers/editManager/'.$userId;
		$cssClass = 'active';
		$cssClass1 = '""';
		$cssClass2 = '""';
		$cssClass3 = '""';
		if ($currentUser) {
    		// do stuff with the user
    		$roleCheck = $currentUser->get("role");
    		$roleCheck->fetch();
    		$role = $roleCheck->get("name");
    		// 
    		$query = new ParseQuery("_Role");
    		$query->notEqualTo("name", $role);
			$query->equalTo("users", $currentUser);
			$result = $query->find();
			$role_info = [];
			for ($i = 0; $i < count($result); $i++) {
			    	$object = $result[$i];
					$role_info[$object->getObjectId()] = $object->get('name');
				   			  
					}
			

    		return array(
        	'redirect' => $url,
        	'active1' => $cssClass,
        	'active2' => $cssClass1,
        	'active4' => $cssClass1,
        	'active5' => $cssClass1,
        	'active' => $cssClass2,
        	'role' => $role,
        	'displayData' => $displayData,
        	'permission' => $role_info,
        	'active3' => $cssClass3,
        	'modaluserEditQuery' => $this->compeditquery->doAdminEditQuery($userId),
        	);

		} else {
    		// show the signup or login page
    		redirect('company/login','refresh');
		}
    }

    public function editManager($userId)
    {
    	# code...
    	$query = new ParseQuery("_User");
    	$query->equalTo("objectId", $userId);
    	$user = $query->find();
    	# code...
    	$currentUser = ParseUser::getCurrentUser();
		$displayData = 'display:none';		
		// Check if the user is logged in. 
		// If tahe user is logged in, load the page.
		if ($currentUser){
		   if(empty($user)){
		   	$data1 = $this->menu_header($displayData);
			buildPage($this->load->view('managers/managers', $data1, true), 'Manage Users');
			}
			else{
				$data = $this->edit_header($displayData, $userId);
				buildPage($this->load->view('managers/editManager', $data, true), 'Manage Users - Edit');
			}
		}
		// If the user is not logged in, show the login page.
		else{
			redirect('company/login','refresh');
			}
    }

    public function deleteUser($userId)
	{
		$status1 = true;
		$currentUser = ParseUser::getCurrentUser();
            	if ($currentUser){
            	$deleteUserParse = $this->compeditquery->doUserDelete($userId);
				if (!$deleteUserParse['status']){
					$status1 = false;
				}

				if (!$status1){
					echo "There was an error, we're taking you back to sort it out...";
					notify('danger', $deleteUserParse['parseMsg'], 'company/managers/editManager/'.$userId);
				}else{
					echo "Please wait, we'll take you back right away...";
					notify('success', 'User Deleted Succesfully', 'company/managers/');
				}
            }else{
            	redirect('company/login','refresh');
            }
		
	}

}
