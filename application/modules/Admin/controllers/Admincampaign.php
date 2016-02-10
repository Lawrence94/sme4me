<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Parse\ParseObject;
use Parse\ParseUser;
use Parse\ParseQuery;
use Parse\ParseRole;

class Admincampaign extends CI_Controller {

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
	    $this->load->library(array('Parseinit'));
	    $this->load->helper(['notification_helper']);
	    $this->load->helper(['loginval_helper']);
	    $this->load->model('signup_company/Signup_model', 'signup');
	    $this->load->model('companyquery/Companyquery_model', 'compquery');
	    $this->load->model('companyquery/Editcompquery_model', 'compeditquery');
	}


	public function index()
	{
	
		$currentUser = ParseUser::getCurrentUser();
		$displayData = 'display:none';
		$adminName = $this->menu_header($displayData);
		if ($currentUser){		
		
			$dashView = $this->load->view('beacons/admincampaign', $adminName, true);
			buildPage($dashView, 'Campaigns');
		}
		else{
			echo 'hey';
			redirect('company/login','refresh');
		}
		
	}

	public function menu_header($displayData){

		//getting the currently logged in admin
		$currentUser = ParseUser::getCurrentUser();
		$firstName = '';
		$lastName = '';
		$url = '/company/Admincampaign';
		$cssClass = 'active';
		$cssClass1 = '""';
		$cssClass2 = '""';
		$cssClass3 = '""';
		if ($currentUser) {
    		// do stuff with the user
    		$firstName = $currentUser->get("firstName");
    		$lastName = $currentUser->get("lastName");
    		$username = $currentUser->get("username");
    		$roleCheck = $currentUser->get("role");
    		$roleCheck->fetch();
    		$role = $roleCheck->get("name");
    		$userDetails = array(
        	'firstName' => $firstName,
        	'lastName' => $lastName,
        	'username' => $username
        	);
        	$this->session->set_userdata($userDetails);

    		return array(
        	'firstName' => $firstName,
        	'lastName' => $lastName,
        	'redirect' => $url,
        	'role' => $role,
        	'active5' => $cssClass,
        	'active' => $cssClass1,
        	'active2' => $cssClass1,
        	'active1' => $cssClass2,
        	'active4' => $cssClass1,
        	'displayData' => $displayData,
        	'active3' => $cssClass3,
        	'campQuery' => $this->compeditquery->adminCampaignQuery(),
        	);

		} else {
    		// show the signup or login page
    		redirect('company/login','refresh');
		}
    }

    public function editHeader($displayData, $id){
		//getting the currently logged in admin
		$currentUser = ParseUser::getCurrentUser();
		$firstName = '';
		$lastName = '';
		$objectId = '';
		$objectName = '';
		$url = 'company/Admincampaign/editCamp/'.$id;
		$cssClass = 'active';
		$cssClass1 = '""';
		$cssClass2 = '""';
		$cssClass3 = '""';
		if ($currentUser) {
    		// do stuff with the user  		

    		return array(
        	'redirect' => $url,
        	'active3' => $cssClass1,
        	'active4' => $cssClass1,
        	'active2' => $cssClass1,
        	'active' => $cssClass2,
        	'active5' => $cssClass,
        	'active1' => $cssClass3,
        	'displayData' => $displayData,
        	'campaign' => $this->compquery->doEditCampaignQuery($id),
        	// 'sectionQuery' => $this->compquery->doCreateCampaignSectionQuery(),
        	);

		} else {
    		// show the signup or login page
    		redirect('company/login','refresh');
		}
    }

    public function editCamp($campaignId)
    {
    	# code...
    	if ($this->input->post('editcamp')) {
			$campaign = $this->input->post('editcamp');

			$date1 = date('Y-m-d H:i', strtotime($campaign['expirydate']));
			$date = date_create($date1);
			
			$title = $campaign['title'];
			$type = $campaign['type'];
			$points = (int) $campaign['points'];
			$userpoints = (int) $campaign['userpoints'];
			$description = $campaign['desc'];
			$gender = $campaign['gender'];
			$age = $campaign['age'];
			//var_dump($companyName);
			//exit;

			$status1 = true;

            	$currentUser = ParseUser::getCurrentUser();
            	if ($currentUser){
	            	$editCampParse = $this->signup->doEditCampaign($title, 
	            		$type, $points, $userpoints, $description, $gender, $age, $date, $campaignId);

					if (!$editCampParse['status']){
						$status1 = false;
					}
						if (!$status1){
							//echo "fuck";
							notify('danger', $editCampParse['parseMsg'], 'company/campaigns');
						}else{
							echo "Please wait, we'll take you back to the dashboard right away...";
							notify('success', 'Campaign Edited Succesfully', 'company/campaigns');
						}
            	}else{
            	redirect('company/login','refresh');
            	}
				
		}else{
			$currentUser = ParseUser::getCurrentUser();
			$displayData = 'display:none';
			$adminName = $this->editHeader($displayData, $campaignId);
			if ($currentUser){
				$dashView = $this->load->view('beacons/editadmincampaign', $adminName, true);
				buildPage($dashView, 'Edit Campaign');
			}
			else{
				//echo 'hey';
				redirect('company/login','refresh');
				}
		}
    }
}
