<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Parse\ParseObject;
use Parse\ParseUser;
use Parse\ParseQuery;
use Parse\ParseRole;
//require trim(dirname(BASEPATH).'/vendor/phpoffice/phpexcel/Classes/PHPExcel.php', '');
//include trim(dirname(BASEPATH).'/vendor/phpoffice/phpexcel/Classes/PHPExcel.php', '');

class Dashboard extends CI_Controller {

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
	    $this->load->helper(['buildpage_helper']);
	    $this->load->library(array('Parseinit'));
	    $this->load->library('excelreader');
	    $this->load->helper(['notification_helper']);
	    $this->load->model('login/Login_model', 'login');
	}


	public function index()
	{
		// $appId = 'BXzf9jtDNrJ4g3jcjgYMOy8tfdhnHw2DtCYikvbg';
  //       $restKey = 'xpTVAiyecFOm3irHq2NRFG0bwbfmTekq2Vgbns0O';
  //       $ch = curl_init();
        

  //       curl_setopt_array($ch, array( 
  //           CURLOPT_URL => 'https://api.parse.com/1/functions/hello',
  //           CURLOPT_RETURNTRANSFER => true,
  //           CURLOPT_CUSTOMREQUEST => "POST",
  //           CURLOPT_POSTFIELDS => '{}',
  //           CURLOPT_SSL_VERIFYPEER => false,
  //           CURLOPT_HTTPHEADER => array(
  //               "X-Parse-Application-Id: " . $appId,
  //               "X-Parse-REST-API-Key: " . $restKey,
  //               "Content-Type: application/json")
  //       ));

  //       // free
  //     $output = curl_exec($ch);
  //     var_dump($output);     
  //     curl_close($ch);
  //     exit;

		$currentUser = $this->session->userdata('user_vars');
		$adminName = $this->menu_header();
		if ($currentUser){		
		
			$dashView = $this->load->view('dashboard/dashboard', $adminName, true);
			buildPage($dashView, 'Dashboard');
		}
		else{
			echo 'hey';
			redirect('Admin/Login', 'refresh');
		}
		
	}

	public function newpost()
	{
		$currentUser = $this->session->userdata('user_vars');
		$adminName = $this->menu_header();
		if ($currentUser){		
		
			$dashView = $this->load->view('dashboard/newpost', $adminName, true);
			buildPage($dashView, 'Dashboard - New Post');
		}
		else{
			echo 'hey';
			redirect('Admin/Login', 'refresh');
		}
	}

	public function allpost()
	{
		$currentUser = $this->session->userdata('user_vars');
		$adminName = $this->allpost_header();
		if ($currentUser){		
		
			$dashView = $this->load->view('dashboard/allpost', $adminName, true);
			buildPage($dashView, 'Dashboard - All Post');
		}
		else{
			echo 'hey';
			redirect('Admin/Login', 'refresh');
		}
	}

	public function deleteall()
	{
		$currentUser = $this->session->userdata('user_vars');
		//$adminName = $this->allpost_header();
		if ($currentUser){		
			if($this->db->empty_table('posts')){
				notify('success', 'All Posts Deleted sucessfully', 'Admin/Dashboard/allpost');
			}else{
				notify('danger', 'There was an error, please try again', 'Admin/Dashboard/allpost');
			}
			
		}
		else{
			echo 'hey';
			redirect('Admin/Login', 'refresh');
		}
		
	}

	public function editpost($postid)
	{
		if ($this->input->post('adminpost')) {
			$post = $this->input->post('adminpost');
			$status1 = true;

			$posttitle = $post['title'];
				$purpose = $post['purpose'];
				$eligibility = $post['eligibility'];
				$level = $post['level'];
				$value = $post['value'];
				$valuedoll = $post['valuedoll'];
				$frequency = $post['freq'];
				//$est = $post['est'];
				$country = $post['country'];
				//$awards = $post['awards'];
				$deadline = $post['deadline'];
				$weblink = $post['weblink'];
				$singlecat = $post['catsingle'];
				//$multicat = $post['catmulti'];
				//$datecreated = date('Y-m-d h:i:s');

				// var_dump($multicat);
				// exit;

				//$multijson = json_encode($multicat);

				if ($posttitle == '' && $purpose == '' && $eligibility == '' && $level == '' && $valuedoll == '' && $frequency == '' && $country == ''
					&& $deadline == '' && $weblink == '') {
					notify('danger', 'Fields cannot be empty', 'Admin/Dashboard/editpost/'. $postid);
				}else{
					$postArray = ['title' => $posttitle,
								  'purpose' => $purpose,
								  'eligibility' => $eligibility,
								  'level' => $level,
								  'value' => $value,
								  'valuedoll' => $valuedoll,
								  'frequency' => $frequency,
								  //'establishment' => $est,
								  'country' => $country,
								  //'awards' => $awards,
								  'deadline' => $deadline,
								  'weblink' => $weblink,
								  'category' => $singlecat,
								  //'categories' => '',
								  //'datecreated' => $datecreated,
								 ];

					 // var_dump($postArray);
					 // exit;

					$postdb = $this->login->editPost($postArray, $postid);

					if (!$postdb['status']){
						$status1 = false;
					}

					if (!$status1){
						//echo "fuck";
						notify('danger', 'There was an unkown error, please try again', 'Admin/Dashboard/editpost/'. $postid);
					}else{
						echo "Please wait, we'll take you back to the dashboard right away...";
						notify('success', 'Post added sucessfully', 'Admin/Dashboard/editpost/'. $postid);
					}
				}	

		}else{
			$currentUser = $this->session->userdata('user_vars');
			$adminName = $this->editpost_header($postid);
			if ($currentUser){		
			
				$dashView = $this->load->view('dashboard/editpost', $adminName, true);
				buildPage($dashView, 'Dashboard - Edit Post');
			}
			else{
				echo 'hey';
				redirect('Admin/Login', 'refresh');
			}
		}
	}

	public function makepost()
	{
		if ($this->input->post('adminpost')) {
			$post = $this->input->post('adminpost');
			$status1 = true;

			$postPath1 = $_FILES['adminpost']['name']['voucherfile'];

			$postPath = $_FILES['adminpost']['name']['file'];
			$filePath = 'assets/uploads';

			$finalPath = $filePath . '/'.$postPath;
			$finalPath1 = $filePath . '/'.$postPath1;

			if ($postPath !== '') {
				// check if file exists
				if(file_exists($finalPath)){
					// if it exists, overwrite it!
					unlink($finalPath);
					move_uploaded_file($_FILES["adminpost"]["tmp_name"]['file'], $finalPath);
				}else{
					// else just move it to the appropriate folder for upload
					move_uploaded_file($_FILES["adminpost"]["tmp_name"]['file'], $finalPath);
				}
				
				// select an input fileType for the excel reader
				$inputFileType = 'Excel2007';
				// Create a new instance of the excel reader using the inputFileType
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objReader->setReadDataOnly(true);
				/**  Define how many rows we want to read for each "chunk"  **/ 
				$chunkSize = 2048; 
				/**  Create a new Instance of our Read Filter  **/ 
				$chunkFilter = $this->excelreader; 
				/**  Tell the Reader that we want to use the Read Filter  **/ 
				$objReader->setReadFilter($chunkFilter);

				$someArray = [];
				$anArray = [];
				$finalArray = [];

				$operations = 0;

				$datecreated = date('Y-m-d h:i:s');

				/**  Loop to read our worksheet in "chunk size" blocks  **/ 
				for ($startRow = 2; $startRow <= 65536; $startRow += $chunkSize) { 
					set_time_limit(0);
				    /**  Tell the Read Filter which rows we want this iteration  **/ 
				    $chunkFilter->setRows($startRow, $chunkSize); 
				    /**  Load only the rows that match our filter  **/ 
				    $objPHPExcel = $objReader->load($finalPath); 
				    //    Do some processing here 
				    $someArray = $objPHPExcel->getActiveSheet()->toArray(null, true,true,true);
				    unset($someArray[1]);
				} 
				foreach ($someArray as $key => $value) {

					set_time_limit(0);

					$operations++;
					$anArray = $value;
					$newArray = $value;
					// change the array key from column alphabet(A,B...) to database column names
					// of each array from the excel file.
					$newArray['title'] = $anArray['A'];
					$newArray['purpose'] = $anArray['B'];
					$newArray['eligibility'] = $anArray['C'];
					$newArray['level'] = $anArray['D'];
					$newArray['value'] = $anArray['E'];
					$newArray['valuedoll'] = $anArray['F'];
					$newArray['frequency'] = $anArray['G']; //Frequency on database is actually Course on sme4me
					$newArray['country'] = $anArray['H'];
					$newArray['deadline'] = $anArray['I'];
					$newArray['weblink'] = $anArray['J'];
					$newArray['category'] = $anArray['K'];
					$newArray['datecreated'] = $datecreated;
					$anArray = $newArray;
					unset($newArray);
					unset($anArray['A']);
					unset($anArray['B']);
					unset($anArray['C']);
					unset($anArray['D']);
					unset($anArray['E']);
					unset($anArray['F']);
					unset($anArray['G']);
					unset($anArray['H']);
					unset($anArray['I']);
					unset($anArray['J']);
					unset($anArray['K']);
					unset($anArray['L']);
					//var_dump($anArray);
					$this->doIteratedUpload($anArray);
				}			
				echo "Please wait, we'll take you back to the dashboard right away...";
				notify('success', 'Post added sucessfully', 'Admin/Dashboard/newpost');	
				//exit;

			}
			elseif ($postPath1 !== '') {
				// check if file exists
				if(file_exists($finalPath1)){
					// if it exists, overwrite it!
					unlink($finalPath1);
					move_uploaded_file($_FILES["adminpost"]["tmp_name"]['voucherfile'], $finalPath1);
				}else{
					// else just move it to the appropriate folder for upload
					move_uploaded_file($_FILES["adminpost"]["tmp_name"]['voucherfile'], $finalPath1);
				}
				
				// select an input fileType for the excel reader
				$inputFileType = 'Excel2007';
				// Create a new instance of the excel reader using the inputFileType
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objReader->setReadDataOnly(true);
				/**  Define how many rows we want to read for each "chunk"  **/ 
				$chunkSize = 2048; 
				/**  Create a new Instance of our Read Filter  **/ 
				$chunkFilter = $this->excelreader; 
				/**  Tell the Reader that we want to use the Read Filter  **/ 
				$objReader->setReadFilter($chunkFilter);

				$someArray = [];
				$anArray = [];
				$finalArray = [];

				$operations = 0;

				$datecreated = date('Y-m-d h:i:s');

				/**  Loop to read our worksheet in "chunk size" blocks  **/ 
				for ($startRow = 2; $startRow <= 65536; $startRow += $chunkSize) { 
					set_time_limit(0);
				    /**  Tell the Read Filter which rows we want this iteration  **/ 
				    $chunkFilter->setRows($startRow, $chunkSize); 
				    /**  Load only the rows that match our filter  **/ 
				    $objPHPExcel = $objReader->load($finalPath1); 
				    //    Do some processing here 
				    $someArray = $objPHPExcel->getActiveSheet()->toArray(null, true,true,true);
				    unset($someArray[1]);
				} 
				
				foreach ($someArray as $key => $value) {

					set_time_limit(0);

					$operations++;
					$anArray = $value;
					$newArray = $value;
					// change the array key from column alphabet(A,B...) to database column names
					// of each array from the excel file.
					$newArray['vouchercode'] = $anArray['A'];
					$newArray['serial'] = $anArray['B'];
					$anArray = $newArray;
					unset($newArray);
					unset($anArray['A']);
					unset($anArray['B']);
					unset($anArray['C']);
					unset($anArray['D']);
					unset($anArray['E']);
					unset($anArray['F']);
					unset($anArray['G']);
					unset($anArray['H']);
					unset($anArray['I']);
					unset($anArray['J']);
										
					$this->doVoucherUpload($anArray);
				}	
				//exit;		
				echo "Please wait, we'll take you back to the dashboard right away...";
				notify('success', 'Post added sucessfully', 'Admin/Dashboard/newpost');	
				//exit;

			}
			else{

				$posttitle = $post['title'];
				$purpose = $post['purpose'];
				$eligibility = $post['eligibility'];
				$level = $post['level'];
				$value = $post['value'];
				$valuedoll = $post['valuedoll'];
				$frequency = $post['freq'];
				//$est = $post['est'];
				$country = $post['country'];
				//$awards = $post['awards'];
				$deadline = $post['deadline'];
				$weblink = $post['weblink'];
				$singlecat = $post['catsingle'];
				//$multicat = $post['catmulti'];
				//$datecreated = date('Y-m-d h:i:s');

				// var_dump($multicat);
				// exit;

				//$multijson = json_encode($multicat);

				if ($posttitle == '' && $purpose == '' && $eligibility == '' && $level == '' && $valuedoll == '' && $frequency == '' && $country == ''
					&& $deadline == '' && $weblink == '') {
					notify('danger', 'Fields cannot be empty', 'Admin/Dashboard/newpost');
				}else{
					$postArray = ['title' => $posttitle,
							  'purpose' => $purpose,
							  'eligibility' => $eligibility,
							  'level' => $level,
							  'value' => $value,
							  'valuedoll' => $valuedoll,
							  'frequency' => $frequency,
							  //'establishment' => $est,
							  'country' => $country,
							  //'awards' => $awards,
							  'deadline' => $deadline,
							  'weblink' => $weblink,
							  'category' => $singlecat,
							  //'categories' => '',
							  'datecreated' => $datecreated,
							 ];

					 // var_dump($postArray);
					 // exit;

					$postdb = $this->login->doPost($postArray);

					if (!$postdb['status']){
						$status1 = false;
					}

					if (!$status1){
						//echo "fuck";
						notify('danger', $loginParse['parseMsg'], 'Admin/Dashboard/newpost');
					}else{
						echo "Please wait, we'll take you back to the dashboard right away...";
						notify('success', 'Post added sucessfully', 'Admin/Dashboard/newpost');
					}
				}	
			}
		}
	}

	public function menu_header(){

		//getting the currently logged in admin
		$currentUser = $this->session->userdata('user_vars');;
		$firstName = '';
		$lastName = '';
		$url = 'Admin/Dashboard';
		$cssClass = 'active';
		$cssClass1 = '""';
		$cssClass2 = '""';
		$cssClass3 = '""';
		if ($currentUser) {
    		// do stuff with the user
    		$firstName = $currentUser['firstname'];
    		$lastName = $currentUser["lastname"];
    		$username = $currentUser["username"];
    		$accessid = $currentUser['accesslevel'];
			$roleCheck = $this->db->get_where('accesslevel', ['id' => $accessid])->row();
			$totalUsers = $this->db->get_where('userdetails', ['aid' => 5])->result();
			$activeUsers = $this->db->get_where('userdetails', ['status' => 1])->result();
			$expiredUsers = $this->db->get_where('userdetails', ['status' => 0])->result();
			$totalVouchers = $this->db->get('vouchers')->result();
			$this->db->select('voucherid');
			$usedVouchers = $this->db->get('subusers')->result();
			$unUsedVouchers = count($totalVouchers) - count($usedVouchers);
    		$role = $roleCheck->name;

    		return array(
    		'displayData' => 'display:none',
        	'firstName' => $firstName,
        	'lastName' => $lastName,
        	'redirect' => $url,
        	'role' => $role,
        	'totalUsers' => count($totalUsers),
        	'totalVouchers' => count($totalVouchers),
        	'usedVouchers' => count($usedVouchers),
        	'unUsedVouchers' => $unUsedVouchers,
        	'activeusers' => count($activeUsers),
        	'expiredUsers' => count($expiredUsers),
        	'active' => $cssClass,
        	'active2' => $cssClass1,
        	'active1' => $cssClass2,
        	'active4' => $cssClass1,
        	'active3' => $cssClass3,
        	'active5' => $cssClass1,
        	);

		} else {
    		// show the signup or login page
    		redirect('Admin/Login','refresh');
		}
    }

    public function analytics_header($state){

		//getting the currently logged in admin
		$currentUser = $this->session->userdata('user_vars');;
		$firstName = '';
		$lastName = '';
		$url = 'Admin/Dashboard';
		$cssClass = 'active';
		$cssClass1 = '""';
		$cssClass2 = '""';
		$cssClass3 = '""';
		if ($currentUser) {
    		// do stuff with the user
    		$firstName = $currentUser['firstname'];
    		$lastName = $currentUser["lastname"];
    		$username = $currentUser["username"];
    		$accessid = $currentUser['accesslevel'];
			$roleCheck = $this->db->get_where('accesslevel', ['id' => $accessid])->row();
			$totalUsers = $this->db->get_where('userdetails', ['aid' => 5])->result();
			$activeUsers = $this->db->get_where('userdetails', ['status' => 1, 'aid' => 5])->result();
			$expiredUsers = $this->db->get_where('userdetails', ['status' => 0])->result();
			$totalVouchers = $this->db->get('vouchers')->result();
			$this->db->select('voucherid');
			$usedVouchers = $this->db->get('subusers')->result();
			$usedVoucher = [];
			foreach ($usedVouchers as $val) {
				$usedVoucher = $this->db->get_where('vouchers', ['id' => $val->voucherid])->result();
				var_dump($usedVoucher);
			}
			$unUsedVouchers = count($totalVouchers) - count($usedVouchers);
    		$role = $roleCheck->name;

    		
    		exit;

    		return array(
    		'displayData' => 'display:none',
        	'firstName' => $firstName,
        	'lastName' => $lastName,
        	'redirect' => $url,
        	'role' => $role,
        	'state' => $state,
        	'totalUsers' => $totalUsers,
        	'totalVouchers' => $totalVouchers,
        	'usedVouchers' => $usedVouchers,
        	'unUsedVouchers' => $unUsedVouchers,
        	'activeusers' => $activeUsers,
        	'expiredUsers' => $expiredUsers,
        	'active' => $cssClass,
        	'active2' => $cssClass1,
        	'active1' => $cssClass2,
        	'active4' => $cssClass1,
        	'active3' => $cssClass3,
        	'active5' => $cssClass1,
        	);

		} else {
    		// show the signup or login page
    		redirect('Admin/Login','refresh');
		}
    }

    public function allpost_header(){

		//getting the currently logged in admin
		$currentUser = $this->session->userdata('user_vars');;
		$firstName = '';
		$lastName = '';
		$url = 'Admin/Dashboard';
		$cssClass = 'active';
		$cssClass1 = '""';
		$cssClass2 = '""';
		$cssClass3 = '""';
		if ($currentUser) {
    		// do stuff with the user
    		$firstName = $currentUser['firstname'];
    		$lastName = $currentUser["lastname"];
    		$username = $currentUser["username"];
    		$accessid = $currentUser['accesslevel'];
			$roleCheck = $this->db->get_where('accesslevel', ['id' => $accessid])->row();
			$posts = $this->db->get('posts')->result();
			// var_dump($posts);
			// exit;
    		$role = $roleCheck->name;

    		return array(
    		'displayData' => 'display:none',
        	'firstName' => $firstName,
        	'lastName' => $lastName,
        	'redirect' => $url,
        	'role' => $role,
        	'posts' => $posts,
        	'active' => $cssClass,
        	'active2' => $cssClass1,
        	'active1' => $cssClass2,
        	'active4' => $cssClass1,
        	'active3' => $cssClass3,
        	'active5' => $cssClass1,
        	);

		} else {
    		// show the signup or login page
    		redirect('Admin/Login','refresh');
		}
    }

    public function editpost_header($postid){

		//getting the currently logged in admin
		$currentUser = $this->session->userdata('user_vars');;
		$firstName = '';
		$lastName = '';
		$url = 'Admin/Dashboard';
		$cssClass = 'active';
		$cssClass1 = '""';
		$cssClass2 = '""';
		$cssClass3 = '""';
		if ($currentUser) {
    		// do stuff with the user
    		$firstName = $currentUser['firstname'];
    		$lastName = $currentUser["lastname"];
    		$username = $currentUser["username"];
    		$accessid = $currentUser['accesslevel'];
			$roleCheck = $this->db->get_where('accesslevel', ['id' => $accessid])->row();
			$post = $this->db->get_where('posts', ['id' => $postid])->row();
			// var_dump($post);
			// exit;
    		$role = $roleCheck->name;

    		return array(
    		'displayData' => 'display:none',
        	'firstName' => $firstName,
        	'lastName' => $lastName,
        	'redirect' => $url,
        	'role' => $role,
        	'post' => $post,
        	'active' => $cssClass,
        	'active2' => $cssClass1,
        	'active1' => $cssClass2,
        	'active4' => $cssClass1,
        	'active3' => $cssClass3,
        	'active5' => $cssClass1,
        	);

		} else {
    		// show the signup or login page
    		redirect('Admin/Login','refresh');
		}
    }

    public function doIteratedUpload($array)
    {
    	//echo "Uploaded ".$operations." record(s)". "of ". count($secondArray). " records, Please Wait...";
    	$postdb = $this->login->doPost($array);
    }

    public function doVoucherUpload($array)
    {
    	$postdb = $this->login->doVoucherUpload($array);
    }

    public function expire($postid)
    {
    	try{
    		$datadb = ['status' => 0];
	    	$this->db->where('id', $postid);
			$this->db->update('posts', $datadb); 
	    	$result = ['result' => 'true'
	    			  ];
			echo json_encode($result);
    	}
    	catch(Exception $ex){
    		$result[] = ['result' => 'false',
    				     'baseUrl' => site_url(),
	    			  	];
		    echo json_encode($result);
    	}
    	
    }

    public function activate($postid)
    {
    	try{
    		$datadb = ['status' => 1];
	    	$this->db->where('id', $postid);
			$this->db->update('posts', $datadb); 
	    	$result = ['result' => 'true'
	    			  ];
			echo json_encode($result);
    	}
    	catch(Exception $ex){
    		$result[] = ['result' => 'false',
    				     'baseUrl' => site_url(),
	    			  	];
		    echo json_encode($result);
    	}
    	
    }

    public function totalusers()
    {
    	$currentUser = $this->session->userdata('user_vars');
		$adminName = $this->analytics_header('totalusers');
		if ($currentUser){		
		
			$dashView = $this->load->view('dashboard/analytics', $adminName, true);
			buildPage($dashView, 'Dashboard');
		}
		else{
			redirect('Admin/Login', 'refresh');
		}
    }

    public function activeusers()
    {
    	$currentUser = $this->session->userdata('user_vars');
		$adminName = $this->analytics_header('activeusers');
		if ($currentUser){		
		
			$dashView = $this->load->view('dashboard/analytics', $adminName, true);
			buildPage($dashView, 'Dashboard');
		}
		else{
			redirect('Admin/Login', 'refresh');
		}
    }

    public function expiredusers()
    {
    	$currentUser = $this->session->userdata('user_vars');
		$adminName = $this->analytics_header('expiredusers');
		if ($currentUser){		
		
			$dashView = $this->load->view('dashboard/analytics', $adminName, true);
			buildPage($dashView, 'Dashboard');
		}
		else{
			redirect('Admin/Login', 'refresh');
		}
    }

    public function totalvouchers()
    {
    	$currentUser = $this->session->userdata('user_vars');
		$adminName = $this->analytics_header('totalvouchers');
		if ($currentUser){		
		
			$dashView = $this->load->view('dashboard/analytics', $adminName, true);
			buildPage($dashView, 'Dashboard');
		}
		else{
			redirect('Admin/Login', 'refresh');
		}
    }

    public function usedvouchers()
    {
    	$currentUser = $this->session->userdata('user_vars');
		$adminName = $this->analytics_header('usedvouchers');
		if ($currentUser){		
		
			$dashView = $this->load->view('dashboard/analytics', $adminName, true);
			buildPage($dashView, 'Dashboard');
		}
		else{
			redirect('Admin/Login', 'refresh');
		}
    }

    public function unusedvouchers()
    {
    	# code...
    }

}
