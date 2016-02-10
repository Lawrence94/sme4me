<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Parse\ParseObject;
use Parse\ParseUser;
use Parse\ParseQuery;
use Parse\ParseException;
use Parse\ParseACL;
use Parse\ParseRole;

class Campaigns extends CI_Controller {

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

		if ($this->input->post('beacassign')) {
			$beacon = $this->input->post('beacassign');
			
			$beaconName = $beacon['beacid'];
			$beacComp = $beacon['company'];
			//var_dump($companyName);
			//exit;

			$status1 = true;

			$this->form_validation->set_rules('beacassign[company]', 'Company', 'required');

			//declare variables
			//holding boolean for error checking
			if ($this->form_validation->run() == FALSE)
            {
            	$currentUser = ParseUser::getCurrentUser();

            	if ($currentUser){
		   			$displayData = 'display:show';
                    $data = $this->menu_header($displayData);
					buildPage($this->load->view('beacons/beacons', $data, true), 'Manage Beacons');
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
            	$assignBeacParse = $this->signup->doAssBeacon($beaconName, $beacComp);

				if (!$assignBeacParse['status']){
					$status1 = false;
				}

				if (!$status1){
					//echo "fuck";
					notify('danger', $assignBeacParse['parseMsg'], 'company/beacons');
				}else{
					echo "Please wait, we'll take you back to the dashboard right away...";
					notify('success', 'Beacon Assigned Succesfully', 'company/beacons');
				}
            }else{
            	redirect('company/login','refresh');
            }
        }
				
		}else if ($this->input->post('unassignbeac')) {
			$beacon = $this->input->post('unassignbeac');
			
			$beaconId = $beacon['beacid'];
			//var_dump($companyName);
			//exit;

			$status1 = true;

		
            	$currentUser = ParseUser::getCurrentUser();
            	if ($currentUser){
            	$unAssignBeacParse = $this->signup->doUnAssBeacon($beaconId);

				if (!$unAssignBeacParse['status']){
					$status1 = false;
				}

				if (!$status1){
					//echo "fuck";
					notify('danger', $unAssignBeacParse['parseMsg'], 'company/beacons');
				}else{
					echo "Please wait, we'll take you back to the dashboard right away...";
					notify('success', 'Beacon Unassigned Succesfully', 'admin/beacons');
				}
            }else{
            	redirect('company/login','refresh');
            }
        
				
		}else if ($this->input->post('editbeac')) {
			$beacon = $this->input->post('editbeac');
			
			$beaconName = $beacon['beaconname'];
			$beaconMajor = $beacon['beaconmajor'];
			$beaconMinor = $beacon['beaconminor'];
			$beaconUuid = $beacon['beaconuuid'];
			$beaconId = $beacon['beaconid'];
			
			//var_dump($companyName);
			//exit;

			$status1 = true;

			$this->form_validation->set_rules('editbeac[beaconname]', 'Beacon Name', 'required');
			$this->form_validation->set_rules('editbeac[beaconmajor]', 'Beacon Major', 'required');
			$this->form_validation->set_rules('editbeac[beaconminor]', 'Beacon Minor', 'required');
			$this->form_validation->set_rules('editbeac[beaconuuid]', 'Beacon UUID', 'required|min_length[20]');
			

			//declare variables
			//holding boolean for error checking
			if ($this->form_validation->run() == FALSE)
            {
            	$currentUser = ParseUser::getCurrentUser();

            	if ($currentUser){
		   			$displayData = 'display:show';
		   			$data = $this->edit_header($displayData, $beaconId);
                    //$data = $this->menu_header($displayData);
					buildPage($this->load->view('beacons/editBeacon', $data, true), 'Manage Beacons-Edit');
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
            	$editBeaconParse = $this->compeditquery->doEditBeacon($beaconName, $beaconMajor, 
            		$beaconMinor, $beaconUuid, $beaconId);

				if (!$editBeaconParse['status']){
					$status1 = false;
				}

				if (!$status1){
					//echo "fuck";
					notify('danger', $editBeaconParse['parseMsg'], 'company/campaigns');
				}else{
					echo "Please wait, we'll take you back to the dashboard right away...";
					notify('success', 'Beacon Details saved Succesfully', 'company/campaigns/editBeacon/' . $beaconId);
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
			$dashView = $this->load->view('beacons/campaigns', $adminName, true);
			buildPage($dashView, 'Campaigns');
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
		$url = 'company/campaigns';
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
    		$isOutletAssigned = $currentUser->get("isOutletAssigned");

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
        	'active4' => $cssClass,
        	'active3' => $cssClass1,
        	'active2' => $cssClass1,
        	'active5' => $cssClass1,
        	'active' => $cssClass2,
        	'role' => $role,
        	'active1' => $cssClass3,
        	'displayData' => $displayData,
        	'campQuery' => $this->compeditquery->campaignQuery(),
        	'isOutletAssigned' => $isOutletAssigned,
        	);

		} else {
    		// show the signup or login page
    		redirect('company/login','refresh');
		}
    }

    public function edit_header($displayData, $campaignId){
		//getting the currently logged in admin
		$currentUser = ParseUser::getCurrentUser();
		$firstName = '';
		$lastName = '';
		$objectId = '';
		$objectName = '';
		$url = 'company/campaigns/editBeacon/'.$campaignId;
		$cssClass = 'active';
		$cssClass1 = '""';
		$cssClass2 = '""';
		$cssClass3 = '""';
		if ($currentUser) {
    		// do stuff with the user  		

    		return array(
        	'redirect' => $url,
        	'active3' => $cssClass1,
        	'active4' => $cssClass,
        	'active2' => $cssClass1,
        	'active' => $cssClass2,
        	'active5' => $cssClass1,
        	'active1' => $cssClass3,
        	'displayData' => $displayData,
        	'campQuery' => $this->compeditquery->campaignQuery1($campaignId),
        	);

		} else {
    		// show the signup or login page
    		redirect('company/login','refresh');
		}
    }

    public function create(){
		if ($this->input->post('createcamp')) {
			$campaign = $this->input->post('createcamp');
			
			//$date = date('Y-m-d', strtotime($campaign['expirydate']));
			$date1 = date('Y-m-d H:i', strtotime($campaign['expirydate']));
			$date2 = date('Y-m-d H:i', strtotime($campaign['startdate']));
			$date = date_create($date1);
			$startdate = date_create($date2);


			$title = $campaign['title'];
			$desc = $campaign['desc'];
			$age = $campaign['age'];
			$gender = $campaign['gender'];
			$type = $campaign['type'];
			$points = (int) $campaign['points'];
			//$date = $campaign['expirydate'];
			$section = $campaign['section'];
			$userpoints = (int) $campaign['userpoints'];

			//var_dump($companyName);
			//exit;

			$status1 = true;

			$this->form_validation->set_rules('createcamp[title]', 'Campaign Title', 'required');
			$this->form_validation->set_rules('createcamp[desc]', 'Campaign Description', 'required');
			$this->form_validation->set_rules('createcamp[type]', 'Campaign Type', 'required');
			$this->form_validation->set_rules('createcamp[points]', 'Campaign Allocation', 'required');
			$this->form_validation->set_rules('createcamp[userpoints]', 'User Allocation', 'required');
			$this->form_validation->set_rules('createcamp[gender]', 'Gender', 'required');
			$this->form_validation->set_rules('createcamp[age]', 'Age Range', 'required');
			$this->form_validation->set_rules('createcamp[section]', 'Section', 'required');


			if ($this->form_validation->run() == FALSE)
            {
            	$currentUser = ParseUser::getCurrentUser();

            	if ($currentUser){
		   			$displayData = 'display:show';
                    $data = $this->createHeader($displayData);
					buildPage($this->load->view('beacons/campaigns', $data, true), 'Campaigns');
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
            		$addBeaconParse = $this->signup->doAddCampaign($title, $desc, 
            		$type, $points, $date, $section, $userpoints, $startdate, $age, $gender);

					if (!$addBeaconParse['status']){
						$status1 = false;
					}

					if (!$status1){
						//echo "fuck";
						notify('danger', $addBeaconParse['parseMsg'], 'company/campaigns');
					}else{
						echo "Please wait, we'll take you back to the dashboard right away...";
						notify('success', 'Campaign Created Succesfully', 'company/campaigns');
					}
	            }else{
	            	redirect('company/login','refresh');
	            }
        	}
				
		}else{
			// $date1 = date('Y-m-d H:i', strtotime((string)date('Y-m-d')));
			// $date2 = date('Y-m-d H:i', strtotime((string)date('Y-m-d')));
			// $date = date_create($date1);
			// $date3 = date_create($date2);
			// if($date > $date3){
			// 	var_dump('Awesome!');
			// 	exit;
			// }else{
			// 	var_dump('Nah Nah!');
			// 	exit;
			// }
			$currentUser = ParseUser::getCurrentUser();
			$displayData = 'display:none';
			$adminName = $this->createHeader($displayData);
			if ($currentUser){
				$dashView = $this->load->view('beacons/createcampaign', $adminName, true);
				buildPage($dashView, 'Create Campaign');
			}
			else{
				//echo 'hey';
				redirect('company/login','refresh');
				}
		}
    }

    public function createHeader($displayData){
		//getting the currently logged in admin
		$currentUser = ParseUser::getCurrentUser();
		$firstName = '';
		$lastName = '';
		$objectId = '';
		$objectName = '';
		$url = 'company/campaigns/create/';
		$cssClass = 'active';
		$cssClass1 = '""';
		$cssClass2 = '""';
		$cssClass3 = '""';
		if ($currentUser) {
    		// do stuff with the user  		

    		return array(
        	'redirect' => $url,
        	'active3' => $cssClass1,
        	'active4' => $cssClass,
        	'active2' => $cssClass1,
        	'active' => $cssClass2,
        	'active5' => $cssClass1,
        	'active1' => $cssClass3,
        	'displayData' => $displayData,
        	'sectionQuery' => $this->compquery->doCreateCampaignSectionQuery(),
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
		$url = 'company/campaigns/editCampaign/'.$id;
		$cssClass = 'active';
		$cssClass1 = '""';
		$cssClass2 = '""';
		$cssClass3 = '""';
		if ($currentUser) {
    		// do stuff with the user  		

    		return array(
        	'redirect' => $url,
        	'active3' => $cssClass1,
        	'active4' => $cssClass,
        	'active2' => $cssClass1,
        	'active' => $cssClass2,
        	'active5' => $cssClass1,
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

    public function editCampaign($campaignId)
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
				$dashView = $this->load->view('beacons/editcampaign', $adminName, true);
				buildPage($dashView, 'Edit Campaign');
			}
			else{
				//echo 'hey';
				redirect('company/login','refresh');
				}
		}
    }

    public function deleteCampaign($campaignId)
    {
    	$status1 = true;

            	$currentUser = ParseUser::getCurrentUser();
            	if ($currentUser){
	            	$editCampParse = $this->compeditquery->doDeleteCampaign($campaignId);

					if (!$editCampParse['status']){
						$status1 = false;
					}
						if (!$status1){
							//echo "fuck";
							notify('danger', $editCampParse['parseMsg'], 'company/campaigns');
						}else{
							echo "Please wait, we'll take you back to the dashboard right away...";
							notify('success', 'Campaign Deleted Succesfully', 'company/campaigns');
						}
            	}else{
            	redirect('company/login','refresh');
            	}
    }

    public function get_beacons()
    {
    	$user = ParseUser::getCurrentUser();
        $outletCheck = $user->get("outlet");
        $outletCheck->fetch();

    	$sectionId = $this->uri->segment(4);
    	$section = new ParseObject("Sections", $sectionId);
    	$beaconQuery = new ParseQuery("Beacons");
    	$beaconQuery->equalTo("section", $section);
    	$beaconQuery->equalTo("outlet", $outletCheck);
    	$result = $beaconQuery->count();

    	if(!empty($result)){
	    	$beaconInfo = [];
			$beaconInfo['234'] = $result;	   			  
			

			echo json_encode($beaconInfo);
		}
		else{
			echo 'none';
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
					notify('danger', $deleteBeaconParse['parseMsg'], 'company/beacons/editbeacons/'.$beaconId);
				}else{
					echo "Please wait, we'll take you back right away...";
					notify('success', 'Beacon Deleted Succesfully', 'company/beacons');
				}
            }else{
            	redirect('company/login','refresh');
            }
		
	}
}
