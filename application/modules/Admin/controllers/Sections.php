<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Parse\ParseObject;
use Parse\ParseUser;
use Parse\ParseQuery;
use Parse\ParseException;
use Parse\ParseACL;
use Parse\ParseRole;
class Sections extends CI_Controller {

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
		if($this->input->post('section')){
				$section = $this->input->post('section');
				
				$companyId = $section['companyId'];
				$sectionName = $section['sectionname'];

				$status1 = true;

				$this->form_validation->set_rules('section[sectionname]', 'Section Name', 'required');

				if ($this->form_validation->run() == FALSE)
            	{
	            	$currentUser = ParseUser::getCurrentUser();

	            	if ($currentUser){
			   			$displayData = 'display:show';
	                    $data = $this->menu_header($displayData);
						buildPage($this->load->view('beacons/sections/', $data, true), 'Sections');
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
            	$addSectionParse = $this->compeditquery->doSectionAdd($sectionName, $companyId);

				if (!$addSectionParse['status']){
					$status1 = false;
				}

				if (!$status1){
					notify('danger', $addSectionParse['parseMsg'], 'company/sections');
				}else{
					echo "Please wait, we'll take you back right away...";
					notify('success', 'Section Added Succesfully', 'company/sections');
				}
            	}else{
            	redirect('company/login','refresh');
            	}
        	}


		}else{
		$currentUser = ParseUser::getCurrentUser();
		$displayData = 'display:none';
		$adminName = $this->menu_header($displayData);
			if ($currentUser){
				$dashView = $this->load->view('beacons/sections', $adminName, true);
				buildPage($dashView, 'Sections');
			}
			else{
				echo 'hey';
				redirect('company/login','refresh');
			}
		}
		
	}

	public function menu_header($displayData){

		//getting the currently logged in admin
		$currentUser = ParseUser::getCurrentUser();
		$firstName = '';
		$lastName = '';
		$url = '/company/sections';
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

        	if($role == OWNER){
	        	$compQuery = new ParseQuery("Companies");
			    $compQuery->equalTo("owner", $currentUser);
			    $state_info = [];
			    $results = [];
			    $company_info = [];
			    try{
			    $results = $compQuery->first();

			    }
			    catch (ParseException $ex) {
			    if($ex->getMessage()){
			    	redirect('company/Error_page','refresh');
			    	}
				}
			
		    	
				$company_info[] = ['companyId' => $results->getObjectId()];
			}else{
				$compQuery = new ParseQuery("Companies");
				$ownerCheck = $currentUser->get("creator");
				$ownerCheck->fetch();
				
			    $compQuery->equalTo("owner", $ownerCheck);
			    $state_info = [];
			    $results = [];
			    $company_info = [];
			    try{
			    $results = $compQuery->first();

			    }
			    catch (ParseException $ex) {
			    if($ex->getMessage()){
			    	redirect('company/Error_page','refresh');
			    	}
				}
			
		    	
				$company_info[] = ['companyId' => $results->getObjectId()];
			}

    		return array(
        	'redirect' => $url,
        	'active3' => $cssClass,
        	'active4' => $cssClass1,
        	'active2' => $cssClass1,
        	'active' => $cssClass2,
        	'active5' => $cssClass1,
        	'role' => $role,
        	'active1' => $cssClass3,
        	'displayData' => $displayData,
        	'company' => $company_info,
        	'sectionQuery' => $this->compeditquery->sectionQuery1($results->getObjectId()),
        	'assignQuery' => $this->compeditquery->secBeacAssQuery(),
        	'unAssignQuery' => $this->compeditquery->secBeacUnAssQuery(),
        	);

		} else {
    		// show the signup or login page
    		redirect('company/login','refresh');
		}
    }

    public function edit_header($displayData, $beaconId){
		//getting the currently logged in admin
		$currentUser = ParseUser::getCurrentUser();
		$firstName = '';
		$lastName = '';
		$objectId = '';
		$objectName = '';
		$url = 'admin/Beacons/editBeacon/'.$beaconId;
		$cssClass = 'active';
		$cssClass1 = '""';
		$cssClass2 = '""';
		$cssClass3 = '""';
		if ($currentUser) {
    		// do stuff with the user
    		$firstName = $currentUser->get("firstName");
    		$lastName = $currentUser->get("lastName");
    		$roleCheck = $currentUser->get("role");
    		$roleCheck->fetch();
    		$role = $roleCheck->get("name");

    		return array(
        	'firstName' => $firstName,
        	'lastName' => $lastName,
        	'redirect' => $url,
        	'active3' => $cssClass,
        	'active4' => $cssClass1,
        	'active2' => $cssClass1,
        	'active5' => $cssClass1,
        	'active' => $cssClass2,
        	'role' => $role,
        	'active1' => $cssClass3,
        	'displayData' => $displayData,
        	'modalBeaconEditQuery' => $this->compeditquery->doBeaconEditQuery($beaconId),
        	);

		} else {
    		// show the signup or login page
    		redirect('admin/login','refresh');
		}
    }


     public function editBeacon($beaconId)
    {
    	# code...
    	$query = new ParseQuery("Beacons");
    	$query->equalTo("objectId", $beaconId);
    	$beacon = $query->find();
    	# code...
    	$currentUser = ParseUser::getCurrentUser();
		$displayData = 'display:none';
		$data = $this->edit_header($displayData, $beaconId);
		$data1 = $this->menu_header($displayData);
		// Check if the user is logged in. 
		// If tahe user is logged in, load the page.
		if ($currentUser){
		   if(empty($beacon)){
			buildPage($this->load->view('beacons/beacons', $data1, true), 'Manage Beacons');
			}
			else{
				buildPage($this->load->view('beacons/editBeacon', $data, true), 'Manage Beacons-Edit');
			}
		}
		// If the user is not logged in, show the login page.
		else{
			redirect('admin/login','refresh');
			}
    }

    public function editSection()
    {
    	if ($this->input->post('sectionedit')) {
			$section = $this->input->post('sectionedit');
			
			$name = $section['name'];
			$id = $section['id'];
			

			//var_dump($companyName);
			//exit;

			$status1 = true;

            	$currentUser = ParseUser::getCurrentUser();
            	if ($currentUser){
	            	$editSecParse = $this->signup->doEditSection($name, 
	            		$id);

					if (!$editSecParse['status']){
						$status1 = false;
					}
						if (!$status1){
							//echo "fuck";
							notify('danger', $editSecParse['parseMsg'], 'company/sections');
						}else{
							echo "Please wait, we'll take you back to the dashboard right away...";
							notify('success', 'Section Edited Succesfully', 'company/sections');
						}
            	}else{
            	redirect('company/login','refresh');
            	}
				
		}elseif($this->input->post('deletesection')){
			$section = $this->input->post('deletesection');
			
			$id = $section['id'];
			
			//var_dump($companyName);
			//exit;

			$status1 = true;

            	$currentUser = ParseUser::getCurrentUser();
            	if ($currentUser){
	            	$deleteSecParse = $this->signup->doDeleteSection($id);

					if (!$deleteSecParse['status']){
						$status1 = false;
					}
						if (!$status1){
							//echo "fuck";
							notify('danger', $deleteSecParse['parseMsg'], 'company/sections');
						}else{
							echo "Please wait, we'll take you back to the dashboard right away...";
							notify('success', 'Section Deleted Succesfully', 'company/sections');
						}
            	}else{
            	redirect('company/login','refresh');
            	}
		}elseif($this->input->post('assbeacon')){
			$beacon = $this->input->post('assbeacon');
			
			$id = $beacon['assign'];
			$secId = $beacon['secid'];
			
			//var_dump($companyName);
			//exit;

			$status1 = true;

			$this->form_validation->set_rules('assbeacon[assign]', 'Beacon', 'required');

			if ($this->form_validation->run() == FALSE)
        	{
            	$currentUser = ParseUser::getCurrentUser();

            	if ($currentUser){
		   			$displayData = 'display:show';
                    $data = $this->menu_header($displayData);
					buildPage($this->load->view('beacons/sections/', $data, true), 'Sections');
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
	            	$beacSecParse = $this->signup->doSecBeacAssign($id, $secId);

					if (!$beacSecParse['status']){
						$status1 = false;
					}
						if (!$status1){
							//echo "fuck";
							notify('danger', $beacSecParse['parseMsg'], 'company/sections');
						}else{
							echo "Please wait, we'll take you back to the dashboard right away...";
							notify('success', 'Beacon Assigned Succesfully', 'company/sections');
						}
            	}else{
            	redirect('company/login','refresh');
            	}
            }
		}

    }

    public function unassignBeacon()
    {
    	if($this->input->post('unassbeacon')){
			$beacon = $this->input->post('unassbeacon');
			
			$id = $beacon['unassign'];
			$secId = $beacon['secid'];

			// var_dump($id);
			// exit;
				
			//var_dump($companyName);
			//exit;

			$status1 = true;

			$this->form_validation->set_rules('unassbeacon[unassign]', 'Beacon', 'required');

			if ($this->form_validation->run() == FALSE)
        	{
            	$currentUser = ParseUser::getCurrentUser();

            	if ($currentUser){
		   			$displayData = 'display:show';
                    $data = $this->menu_header($displayData);
					buildPage($this->load->view('beacons/sections', $data, true), 'Sections');
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
	            	$beacSecParse = $this->signup->doSecBeacUnassign($id, $secId);

					if (!$beacSecParse['status']){
						$status1 = false;
					}
						if (!$status1){
							//echo "fuck";
							notify('danger', $beacSecParse['parseMsg'], 'company/sections');
						}else{
							echo "Please wait, we'll take you back to the dashboard right away...";
							notify('success', 'Beacon UnAssigned Succesfully', 'company/sections');
						}
            	}else{
            	redirect('company/login','refresh');
            	}
            }
		}
    }

    public function deleteBeacon($beaconId)
	{
		$status1 = true;
		$currentUser = ParseUser::getCurrentUser();
            	if ($currentUser){
            	$deleteBeaconParse = $this->compeditquery->doBeaconDelete($beaconId);
				if (!$deleteBeaconParse['status']){
					$status1 = false;
				}

				if (!$status1){
					echo "There was an error, we're taking you back to sort it out...";
					notify('danger', $deleteBeaconParse['parseMsg'], 'admin/beacons/editbeacons/'.$beaconId);
				}else{
					echo "Please wait, we'll take you back right away...";
					notify('success', 'Beacon Deleted Succesfully', 'admin/beacons');
				}
            }else{
            	redirect('admin/login','refresh');
            }
		
	}
}
