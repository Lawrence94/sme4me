<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * undocumented function
 *
 * @return void
 * @author 
 **/
use Parse\ParseObject;
use Parse\ParseUser;
use Parse\ParseException;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParseRole;

class Venues extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('buildPage_helper'));
		$this->load->helper(['notification_helper']);
		$this->load->helper(['loginval_helper']);
	    $this->load->library(array('Parseinit'));
	    $this->load->model('signup_company/Signup_model', 'signup');
	    $this->load->model('companyquery/Companyquery_model', 'compquery');
	    $this->load->model('companyquery/Editcompquery_model', 'compeditquery');
	}

	public function index()
	{
		if ($this->input->post('venue')) {
			$venue = $this->input->post('venue');
			
			$venueName = $venue['venuename'];
			$venueMail = $venue['venuemail'];
			$venueState = $venue['venuestate'];
			$venueCity = $venue['venuecity'];
			$venueAddr = $venue['venueaddr'];
			$venueCityEx = $venue['venuecityex'];
			$companyId = $venue['companyId']; 


			//var_dump($companyName);
			//exit;

			$status1 = true;

			if($venueCity == 'others'){
				$this->form_validation->set_rules('venue[venuename]', 'Venue Name', 'required');
				$this->form_validation->set_rules('venue[venuestate]', 'State', 'required');
				$this->form_validation->set_rules('venue[venuecityex]', 'City', 'required');
				$this->form_validation->set_rules('venue[venueaddr]', 'Address', 'required');

				//declare variables
				//holding boolean for error checking
				if ($this->form_validation->run() == FALSE)
	            {
	            	$currentUser = ParseUser::getCurrentUser();

	            	if ($currentUser){
			   			$displayData = 'display:show';
	                    $data = $this->_menu_header($displayData);
						buildPage($this->load->view('venue/all_company', $data, true), 'Manage Venues');
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
	            		$addVenueOtherParse = $this->signup->doAddVenueOther($venueName, $venueMail, 
	            		$venueAddr, $venueCityEx, $venueState, $companyId);

						if (!$addVenueOtherParse['status']){
							$status1 = false;
						}

						if (!$status1){
							//echo "fuck";
							notify('danger', $addVenueOtherParse['parseMsg'], 'company/venues');
						}else{
							echo "Please wait, we'll take you back to the dashboard right away...";
							notify('success', 'Venue Added Succesfully', 'company/venues');
						}
	            	}else{
	            	redirect('company/login','refresh');
	            	}
	        	}
	        }else{
	        	$this->form_validation->set_rules('venue[venuename]', 'Venue Name', 'required');
				$this->form_validation->set_rules('venue[venuestate]', 'State', 'required');
				$this->form_validation->set_rules('venue[venuecity]', 'City', 'required');
				$this->form_validation->set_rules('venue[venueaddr]', 'Address', 'required');

				//declare variables
				//holding boolean for error checking
				if ($this->form_validation->run() == FALSE)
	            {
	            	$currentUser = ParseUser::getCurrentUser();

	            	if ($currentUser){
			   			$displayData = 'display:show';
	                    $data = $this->_menu_header($displayData);
						buildPage($this->load->view('venue/all_company', $data, true), 'Manage Venues');
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
	            		$addVenueParse = $this->signup->doAddVenue($venueName, $venueMail, 
	            		$venueAddr, $venueCity, $venueState, $companyId);

						if (!$addVenueParse['status']){
							$status1 = false;
						}

						if (!$status1){
							//echo "fuck";
							notify('danger', $addVenueParse['parseMsg'], 'company/venues');
						}else{
							echo "Please wait, we'll take you back to the dashboard right away...";
							notify('success', 'Venue Added Succesfully', 'company/venues');
						}
	            	}else{
	            	redirect('company/login','refresh');
	            	}
	        	}
	        }
					
		} else if($this->input->post('section')){
				$section = $this->input->post('section');
				
				$companyId = $section['companyId'];
				$sectionName = $section['sectionname'];
				$venueId = $section['venueId'];

				$status1 = true;

				$this->form_validation->set_rules('section[sectionname]', 'Section Name', 'required');

				if ($this->form_validation->run() == FALSE)
            {
            	$currentUser = ParseUser::getCurrentUser();

            	if ($currentUser){
		   			$displayData = 'display:show';
                    $data = $this->edit_header($displayData, $venueId);
					buildPage($this->load->view('venue/venueDetailsSec', $data, true), 'Manage Venues - Details');
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
					notify('danger', $addSectionParse['parseMsg'], 'company/venues/venueDetailsSec/'.$venueId);
				}else{
					echo "Please wait, we'll take you back right away...";
					notify('success', 'Section Added Succesfully', 'company/venues/venueDetailsSec/'.$venueId);
				}
            	}else{
            	redirect('company/login','refresh');
            	}
        	}


		}else if($this->input->post('beacassign')){
				$beacon = $this->input->post('beacassign');
				
				$venueId = $beacon['venueId'];
				$beaconid = $beacon['beacon'];

				$status1 = true;

				$this->form_validation->set_rules('beacassign[beacon]', 'Beacon', 'required');

				if ($this->form_validation->run() == FALSE)
            	{
	            	$currentUser = ParseUser::getCurrentUser();

	            	if ($currentUser){
			   			$displayData = 'display:show';
	                    $data = $this->edit_header($displayData, $venueId);
						buildPage($this->load->view('venue/venueDetailsBeac', $data, true), 'Manage Venues - Details');
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
	            	$assignBeaconParse = $this->compeditquery->doBeaconAssign($venueId, $beaconid);

					if (!$assignBeaconParse['status']){
						$status1 = false;
					}

					if (!$status1){
						notify('danger', $assignBeaconParse['parseMsg'], 'company/venues/venueDetailsBeac/'.$venueId);
					}else{
						echo "Please wait, we'll take you back right away...";
						notify('success', 'Beacon Assigned Succesfully', 'company/venues/venueDetailsBeac/'.$venueId);
					}
	            	}else{
	            	redirect('company/login','refresh');
	            	}
	        	}


		}else {

			 	// get the current user...
			$currentUser = ParseUser::getCurrentUser();
			// Check if the user is logged in. 
			// If tahe user is logged in, load the page.
			if ($currentUser){
				$displayData = 'display:none';
				$data = $this->_menu_header($displayData);
				buildPage($this->load->view('venue/all_company', $data, true), 'Manage Venues');
			}
			// If the user is not logged in, show the login page.
			else{
				redirect('company/login','refresh');
			}
		}
		
	}

	public function _menu_header($displayData){
		//getting the currently logged in admin
		$currentUser = ParseUser::getCurrentUser();
		$firstName = '';
		$lastName = '';
		$objectId = '';
		$objectName = '';
		$url = 'company/venues';
		$cssClass = 'active';
		$cssClass1 = '""';
		$cssClass2 = '""';
		$cssClass3 = '""';
		if ($currentUser) {
    		// do stuff with the user
    		$compQuery = new ParseQuery("Companies");
		    $compQuery->equalTo("owner", $currentUser);
		    $state_info = [];
		    $results = [];
		    $company_info = [];
		    try{
		    $results = $compQuery->find();

		    }
		    catch (ParseException $ex) {
		    if($ex->getMessage()){
		    	redirect('company/Error_page','refresh');
		    	}
			}
			for ($i = 0; $i < count($results); $i++) {
		    	$object = $results[$i];
				$company_info[] = ['companyId' => $object->getObjectId()];
				$countryCheck = $object->get("country");
				$countryCheck->fetch();
				$countryId = $countryCheck->getObjectId();
				$country = new ParseObject("Country", $countryId);
				$stateQuery = new ParseQuery("States");
				$stateQuery->equalTo("country", $country);
				$stateResults = $stateQuery->find();
				for ($i = 0; $i < count($stateResults); $i++) {
		    		$stateObject = $stateResults[$i];
		    		$state_info[$stateObject->getObjectId()] = $stateObject->get('stateName');
					}
				}
			$roleCheck = $currentUser->get("role");
    		$roleCheck->fetch();
    		$role = $roleCheck->get("name");
    		return array(
        	'redirect' => $url,
        	'active2' => $cssClass,
        	'role' => $role,
        	'active3' => $cssClass1,
        	'active4' => $cssClass1,
        	'active5' => $cssClass1,
        	'active' => $cssClass2,
        	'active1' => $cssClass3,
        	'company' => $company_info,
        	'state' => $state_info,
        	'displayData' => $displayData,
        	'modalcompQuery' => $this->compquery->doQuery(),
        		);
    		
    	

		} else {
    		// show the signup or login page
    		redirect('company/login','refresh');
		}
    }

    public function edit_headersum($displayData, $venueId){
		//getting the currently logged in admin
		$currentUser = ParseUser::getCurrentUser();
		$firstName = '';
		$lastName = '';
		$objectId = '';
		$objectName = '';
		$url = 'company/venues/venueDetailsSum/'.$venueId;
		$cssClass = 'active';
		$cssClass1 = '""';
		$cssClass2 = '""';
		$cssClass3 = '""';

		if ($currentUser) {
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
			$roleCheck = $currentUser->get("role");
    		$roleCheck->fetch();
    		$role = $roleCheck->get("name");

    		return array(
        	'redirect' => $url,
        	'active2' => $cssClass,
        	'active4' => $cssClass1,
        	'active3' => $cssClass1,
        	'active5' => $cssClass1,
        	'venueid' => $venueId,
        	'role' => $role,
        	'active' => $cssClass2,
        	'active1' => $cssClass3,
        	'displayData' => $displayData,
        	'company' => $company_info,
        	// 'beacComp' => $this->compeditquery->beaconQuery(),
        	// 'campQuery' => $this->compeditquery->campaignQuery1($venueId),
        	'modalcompEditQuery' => $this->compeditquery->doQuery($venueId),
        	// 'sectionQuery' => $this->compeditquery->sectionQuery($venueId, $results->getObjectId()),
        	// 'sectionQuery1' => $this->compquery->doSectionQuery1(),
        	// 'venueBeacons' => $this->compeditquery->venueBeaconQuery($venueId),
        	// 'assignQuery' => $this->compeditquery->secOwnerBeacAssQuery($venueId),
        	// 'unAssignQuery' => $this->compeditquery->secOwnerBeacUnAssQuery($venueId),
        	);

		} else {
    		// show the signup or login page
    		redirect('company/login','refresh');
		}
    }

    public function edit_headersec($displayData, $venueId){
		//getting the currently logged in admin
		$currentUser = ParseUser::getCurrentUser();
		$firstName = '';
		$lastName = '';
		$objectId = '';
		$objectName = '';
		$url = 'company/venues/venueDetailsSec/'.$venueId;
		$cssClass = 'active';
		$cssClass1 = '""';
		$cssClass2 = '""';
		$cssClass3 = '""';

		if ($currentUser) {
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
			$roleCheck = $currentUser->get("role");
    		$roleCheck->fetch();
    		$role = $roleCheck->get("name");

    		return array(
        	'redirect' => $url,
        	'active2' => $cssClass,
        	'active4' => $cssClass1,
        	'active3' => $cssClass1,
        	'active5' => $cssClass1,
        	'venueid' => $venueId,
        	'role' => $role,
        	'active' => $cssClass2,
        	'active1' => $cssClass3,
        	'displayData' => $displayData,
        	'company' => $company_info,
        	// 'beacComp' => $this->compeditquery->beaconQuery(),
        	// 'campQuery' => $this->compeditquery->campaignQuery1($venueId),
        	'modalcompEditQuery' => $this->compeditquery->doQuery($venueId),
        	'sectionQuery' => $this->compeditquery->sectionQuery($venueId, $results->getObjectId()),
        	// 'sectionQuery1' => $this->compquery->doSectionQuery1(),
        	// 'venueBeacons' => $this->compeditquery->venueBeaconQuery($venueId),
        	'assignQuery' => $this->compeditquery->secOwnerBeacAssQuery($venueId),
        	'unAssignQuery' => $this->compeditquery->secOwnerBeacUnAssQuery($venueId),
        	);

		} else {
    		// show the signup or login page
    		redirect('company/login','refresh');
		}
    }

    public function edit_headerbeac($displayData, $venueId){
		//getting the currently logged in admin
		$currentUser = ParseUser::getCurrentUser();
		$firstName = '';
		$lastName = '';
		$objectId = '';
		$objectName = '';
		$url = 'company/venues/venueDetailsBeac/'.$venueId;
		$cssClass = 'active';
		$cssClass1 = '""';
		$cssClass2 = '""';
		$cssClass3 = '""';

		if ($currentUser) {
			
			$roleCheck = $currentUser->get("role");
    		$roleCheck->fetch();
    		$role = $roleCheck->get("name");

    		return array(
        	'redirect' => $url,
        	'active2' => $cssClass,
        	'active4' => $cssClass1,
        	'active3' => $cssClass1,
        	'active5' => $cssClass1,
        	'venueid' => $venueId,
        	'role' => $role,
        	'active' => $cssClass2,
        	'active1' => $cssClass3,
        	'displayData' => $displayData,
        	'modalcompEditQuery' => $this->compeditquery->doQuery($venueId),
        	'beacComp' => $this->compeditquery->beaconQuery(),
        	'venueBeacons' => $this->compeditquery->venueBeaconQuery($venueId),
        	);

		} else {
    		// show the signup or login page
    		redirect('company/login','refresh');
		}
    }

    public function edit_headercamp($displayData, $venueId){
		//getting the currently logged in admin
		$currentUser = ParseUser::getCurrentUser();
		$firstName = '';
		$lastName = '';
		$objectId = '';
		$objectName = '';
		$url = 'company/venues/venueDetailsCamp/'.$venueId;
		$cssClass = 'active';
		$cssClass1 = '""';
		$cssClass2 = '""';
		$cssClass3 = '""';

		if ($currentUser) {
			$roleCheck = $currentUser->get("role");
    		$roleCheck->fetch();
    		$role = $roleCheck->get("name");

    		return array(
        	'redirect' => $url,
        	'active2' => $cssClass,
        	'active4' => $cssClass1,
        	'active3' => $cssClass1,
        	'active5' => $cssClass1,
        	'venueid' => $venueId,
        	'role' => $role,
        	'active' => $cssClass2,
        	'active1' => $cssClass3,
        	'displayData' => $displayData,
        	'modalcompEditQuery' => $this->compeditquery->doQuery($venueId),
        	'campQuery' => $this->compeditquery->campaignQuery1($venueId),
        	'sectionQuery1' => $this->compquery->doSectionQuery1(),
        	);

		} else {
    		// show the signup or login page
    		redirect('company/login','refresh');
		}
    }


    public function get_city()
    {
    	$stateId = $this->uri->segment(4);
    	$state = new ParseObject("States", $stateId);
    	$cityQuery = new ParseQuery("City");
    	$cityQuery->ascending("Cities");
    	$cityQuery->equalTo("states", $state);
    	$results = $cityQuery->find();

    	if(!empty($results)){
	    	$cityInfo = [];
	    	for ($i = 0; $i < count($results); $i++) {
			    	$object = $results[$i];
					$cityInfo[$object->getObjectId()] = $object->get('Cities');	   			  
			}

			echo json_encode($cityInfo);
		}
		else{
			echo 'none';
		}
    }

    public function get_beacons($venueId)
    {
    	$venue = new ParseObject("Outlets", $venueId);

    	$sectionId = $this->uri->segment(5);
    	$section = new ParseObject("Sections", $sectionId);
    	$beaconQuery = new ParseQuery("Beacons");
    	$beaconQuery->equalTo("section", $section);
    	$beaconQuery->equalTo("outlet", $venue);
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

    public function venueDetailsSum($venueId)
    {
    	if ($this->input->post('createcamp')) {
			$campaign = $this->input->post('createcamp');
			
			//$date = date('Y-m-d', strtotime($campaign['expirydate']));
			$date1 = date('Y-m-d H:i', strtotime($campaign['expirydate']));
			$date = date_create($date1);


			$title = $campaign['title'];
			$desc = $campaign['desc'];
			$type = $campaign['type'];
			$points = (int) $campaign['points'];
			$status = $campaign['status'];
			//$date = $campaign['expirydate'];
			$section = $campaign['section'];

			//var_dump($companyName);
			//exit;

			$status1 = true;

			$this->form_validation->set_rules('createcamp[title]', 'Campaign Title', 'required');
			$this->form_validation->set_rules('createcamp[desc]', 'Campaign Description', 'required');
			$this->form_validation->set_rules('createcamp[type]', 'Campaign Type', 'required');
			$this->form_validation->set_rules('createcamp[points]', 'Campaign Allocation', 'required');
			$this->form_validation->set_rules('createcamp[section]', 'Section', 'required');


			if ($this->form_validation->run() == FALSE)
            {
            	$currentUser = ParseUser::getCurrentUser();

            	if ($currentUser){
		   			$displayData = 'display:show';
                    $data = $this->edit_header($displayData, $venueId);
					buildPage($this->load->view('venue/venueDetails', $data, true), 'Manage Venues - Details');
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
            	$addBeaconParse = $this->signup->doAddCampaign1($title, $desc, 
            		$type, $points, $status, $date, $section, $venueId);

				if (!$addBeaconParse['status']){
					$status1 = false;
				}

				if (!$status1){
					notify('danger', $addBeaconParse['parseMsg'], 'company/venues/venueDetailsSum/'. $venueId);
				}else{
					echo "Please wait, we'll take you back to the dashboard right away...";
					notify('success', 'Campaign Created Succesfully', 'company/venues/venueDetailsSum/'. $venueId);
				}
            }else{
            	redirect('company/login','refresh');
            }
        }
				
		}else{
	    	$query = new ParseQuery("Outlets");
			$query->equalTo("objectId", $venueId);
			$venue = $query->first();
	    	// var_dump($venue);
	    	// exit;
	    	# code...
	    	$currentUser = ParseUser::getCurrentUser();
			// Check if the user is logged in. 
			// If tahe user is logged in, load the page.
			if ($currentUser){
			   if(!empty($venue)){
			   		$displayData = 'display:none';
			   		$data = $this->edit_headersum($displayData, $venueId);
					buildPage($this->load->view('venue/venueDetailsSum', $data, true), 'Manage Venues - Details');
				}
				else{
					$displayData = 'display:none';
					$data1 = $this->_menu_header($displayData);
					buildPage($this->load->view('venue/all_company', $data1, true), 'Manage Venues');				
				}
			}
			// If the user is not logged in, show the login page.
			else{
				redirect('company/login','refresh');
			}
		}

    }

    public function venueDetailsSec($venueId)
    {
    	if($this->input->post('assbeacon')){
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
                    $data = $this->edit_headersec($displayData, $venueId);
					buildPage($this->load->view('venue/venueDetailsSec', $data, true), 'Manage Venues - Details');
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
							notify('danger', $beacSecParse['parseMsg'], 'Company/Venues/venueDetailsSec/'. $venueId);
						}else{
							echo "Please wait, we'll take you back to the dashboard right away...";
							notify('success', 'Beacon Assigned Succesfully', 'Company/Venues/venueDetailsSec/'. $venueId);
						}
            	}else{
            	redirect('company/login','refresh');
            	}
            }
		}elseif($this->input->post('unassbeacon')){
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
                    $data = $this->edit_headersec($displayData, $venueId);
					buildPage($this->load->view('venue/venueDetailsSec', $data, true), 'Manage Venues - Details');
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
							notify('danger', $beacSecParse['parseMsg'], 'Company/Venues/venueDetailsSec/'. $venueId);
						}else{
							echo "Please wait, we'll take you back to the dashboard right away...";
							notify('success', 'Beacon Unassigned Succesfully', 'Company/Venues/venueDetailsSec/'. $venueId);
						}
            	}else{
            	redirect('company/login','refresh');
            	}
            }
		}else{
	    	$query = new ParseQuery("Outlets");
			$query->equalTo("objectId", $venueId);
			$venue = $query->first();
	    	// var_dump($venue);
	    	// exit;
	    	# code...
	    	$currentUser = ParseUser::getCurrentUser();
			// Check if the user is logged in. 
			// If tahe user is logged in, load the page.
			if ($currentUser){
			   if(!empty($venue)){
			   		$displayData = 'display:none';
			   		$data = $this->edit_headersec($displayData, $venueId);
					buildPage($this->load->view('venue/venueDetailsSec', $data, true), 'Manage Venues - Details');
				}
				else{
					$displayData = 'display:none';
					$data1 = $this->_menu_header($displayData);
					buildPage($this->load->view('venue/all_company', $data1, true), 'Manage Venues');				
				}
			}
			// If the user is not logged in, show the login page.
			else{
				redirect('company/login','refresh');
			}
		}

    }

    public function venueDetailsBeac($venueId)
    {
    	$query = new ParseQuery("Outlets");
		$query->equalTo("objectId", $venueId);
		$venue = $query->first();
    	// var_dump($venue);
    	// exit;
    	# code...
    	$currentUser = ParseUser::getCurrentUser();
		// Check if the user is logged in. 
		// If tahe user is logged in, load the page.
		if ($currentUser){
		   if(!empty($venue)){
		   		$displayData = 'display:none';
		   		$data = $this->edit_headerbeac($displayData, $venueId);
				buildPage($this->load->view('venue/venueDetailsBeac', $data, true), 'Manage Venues - Details');
			}
			else{
				$displayData = 'display:none';
				$data1 = $this->_menu_header($displayData);
				buildPage($this->load->view('venue/all_company', $data1, true), 'Manage Venues');				
			}
		}
		// If the user is not logged in, show the login page.
		else{
			redirect('company/login','refresh');
		}

    }

    public function venueDetailsCamp($venueId)
    {
    	$query = new ParseQuery("Outlets");
		$query->equalTo("objectId", $venueId);
		$venue = $query->first();
    	// var_dump($venue);
    	// exit;
    	# code...
    	$currentUser = ParseUser::getCurrentUser();
		// Check if the user is logged in. 
		// If tahe user is logged in, load the page.
		if ($currentUser){
		   if(!empty($venue)){
		   		$displayData = 'display:none';
		   		$data = $this->edit_headercamp($displayData, $venueId);
				buildPage($this->load->view('venue/venueDetailsCamp', $data, true), 'Manage Venues - Details');
			}
			else{
				$displayData = 'display:none';
				$data1 = $this->_menu_header($displayData);
				buildPage($this->load->view('venue/all_company', $data1, true), 'Manage Venues');				
			}
		}
		// If the user is not logged in, show the login page.
		else{
			redirect('company/login','refresh');
		}

    }

    public function companyDetails($compId)
    {
    	# code...
    	$currentUser = ParseUser::getCurrentUser();
		$displayData = 'display:none';
		$data = $this->_menu_header($displayData);
		// Check if the user is logged in. 
		// If tahe user is logged in, load the page.
		if ($currentUser){
		   
			buildPage($this->load->view('venue/companyDetails', $data, true), 'Manage Companies');
		}
		// If the user is not logged in, show the login page.
		else{
			redirect('company/login','refresh');
			}
	}

	public function editHeader($displayData, $campid, $venueId){
		//getting the currently logged in admin
		$currentUser = ParseUser::getCurrentUser();
		$firstName = '';
		$lastName = '';
		$objectId = '';
		$objectName = '';
		$url = 'company/Venues/editCamp/'.$campid.'/'.$venueId;
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
        	'active2' => $cssClass,
        	'active' => $cssClass2,
        	'active5' => $cssClass1,
        	'active1' => $cssClass3,
        	'displayData' => $displayData,
        	'venueId' => $venueId,
        	'campaign' => $this->compquery->doEditCampaignQuery($campid),
        	// 'sectionQuery' => $this->compquery->doCreateCampaignSectionQuery(),
        	);

		} else {
    		// show the signup or login page
    		redirect('company/login','refresh');
		}
    }

	public function editCamp($campaignId, $venueId)
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
							notify('danger', $editCampParse['parseMsg'], 'company/Venues/editCamp/'.$campaignId.'/'.$venueId);
						}else{
							echo "Please wait, we'll take you back to the dashboard right away...";
							notify('success', 'Campaign Edited Succesfully', 'company/Venues/venueDetailsCamp/'.$venueId);
						}
            	}else{
            	redirect('company/login','refresh');
            	}
				
		}else{
			$currentUser = ParseUser::getCurrentUser();
			$displayData = 'display:none';
			$adminName = $this->editHeader($displayData, $campaignId, $venueId);
			if ($currentUser){
				$dashView = $this->load->view('venue/editCampaignAdmin', $adminName, true);
				buildPage($dashView, 'Edit Campaign');
			}
			else{
				//echo 'hey';
				redirect('company/login','refresh');
				}
		}
    }

	public function deleteVenue($venueId)
	{
		$status1 = true;
		$currentUser = ParseUser::getCurrentUser();
            	if ($currentUser){
            	$deleteCompParse = $this->compeditquery->doDelete($compId, $ownerId);
				if (!$deleteCompParse['status']){
					$status1 = false;
				}

				if (!$status1){
					echo "There was an error, we're taking you back to sort it out...";
					notify('danger', $deleteCompParse['parseMsg'], 'company/venues/editCompany/'.$compId);
				}else{
					echo "Please wait, we'll take you back right away...";
					notify('success', 'Company Deleted Succesfully', 'company/venues/');
				}
            }else{
            	redirect('company/login','refresh');
            }
		
	}

	public function unAssignBeacon($beaconId, $venueId)
	{
		$beacon =  new ParseObject("Beacons", $beaconId);
		$beacon->delete("outlet");
		$beacon->delete("section");
		$beacon->set("isStoreAssign", false);
		$beacon->set("isSectionAssigned", false);
		try {
			$beacon->save();
			notify('success', "Beacon unassigned succesfully", 'company/venues/venueDetailsBeac/'.$venueId);
		} catch (ParseException $ex) {
			notify('danger', $ex->getMessage(), 'company/venues/venueDetailsBeac/'.$venueId);
		}
	}

	public function createCamp($venueId)
	{
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
                    $data = $this->createcampHeader($displayData, $venueId);
					buildPage($this->load->view('beacons/admincreatecampaign', $data, true), 'Manage Venues - Create Campaign');
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
            		$addBeaconParse = $this->signup->doAddCampaign1($title, $desc, 
            		$type, $points, $date, $section, $userpoints, $startdate, $age, $gender, $venueId);

					if (!$addBeaconParse['status']){
						$status1 = false;
					}

					if (!$status1){
						//echo "fuck";
						notify('danger', $addBeaconParse['parseMsg'], 'company/venues/createCamp/'.$venueId);
					}else{
						echo "Please wait, we'll take you back to the dashboard right away...";
						notify('success', 'Campaign Created Succesfully', 'company/venues/venueDetailsCamp/'.$venueId);
					}
	            }else{
	            	redirect('company/login','refresh');
	            }
        	}
				
		}else{
			$query = new ParseQuery("Outlets");
			$query->equalTo("objectId", $venueId);
			$venue = $query->first();
	    	// var_dump($venue);
	    	// exit;
	    	# code...
	    	$currentUser = ParseUser::getCurrentUser();
			// Check if the user is logged in. 
			// If tahe user is logged in, load the page.
			if ($currentUser){
			   if(!empty($venue)){
			   		$displayData = 'display:none';
			   		$data = $this->createcampHeader($displayData, $venueId);
					buildPage($this->load->view('beacons/admincreatecampaign', $data, true), 'Manage Venues - Create Campaign');
				}
				else{
					$displayData = 'display:none';
					$data1 = $this->edit_headercamp($displayData, $venueId);
					buildPage($this->load->view('beacons/venueDetailsCamp', $data1, true), 'Manage Venues - Details');				
				}
			}
			// If the user is not logged in, show the login page.
			else{
				redirect('company/login','refresh');
			}
		}
	}

	public function createcampHeader($displayData, $venueId){
		//getting the currently logged in admin
		$currentUser = ParseUser::getCurrentUser();
		$firstName = '';
		$lastName = '';
		$objectId = '';
		$objectName = '';
		$url = 'company/venues/createCamp/'.$venueId;
		$cssClass = 'active';
		$cssClass1 = '""';
		$cssClass2 = '""';
		$cssClass3 = '""';

		if ($currentUser) {
			$roleCheck = $currentUser->get("role");
    		$roleCheck->fetch();
    		$role = $roleCheck->get("name");

    		return array(
        	'redirect' => $url,
        	'active2' => $cssClass,
        	'active4' => $cssClass1,
        	'active3' => $cssClass1,
        	'active5' => $cssClass1,
        	'venueid' => $venueId,
        	'role' => $role,
        	'active' => $cssClass2,
        	'active1' => $cssClass3,
        	'displayData' => $displayData,
        	'modalcompEditQuery' => $this->compeditquery->doQuery($venueId),
        	'sectionQuery' => $this->compquery->doSectionQuery1(),
        	);

		} else {
    		// show the signup or login page
    		redirect('company/login','refresh');
		}
    }
    

}

/* End of file Venues.php */
/* Location: ./application/modules/dashboard/controllers/Company.php */