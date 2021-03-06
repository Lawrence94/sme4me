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

	public function adduser()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
		
			$status1 = true;

			$firstName = $post['fname'];
			$lastName = $post['lname'];
			$email = $post['email'];
			$password = $post['password'];
			$aid = $post['aid'];

			if ($firstName == '' || $lastName == '' || $email == '' || $password == '') {
				notify('danger', 'Fields cannot be empty', 'Admin/Dashboard/adduser');
			}else{
				  $postArray = ['username' => $email,
								'firstname' => $firstName,
								'lastname' => $lastName,
								'password' => $password,
								'aid' => $aid,
								'email' => $email,
								'status' => 1,
								];

				$postdb = $this->login->adduser($postArray);

				if (!$postdb['status']){
					$status1 = false;
				}

				if (!$status1){
					notify('danger', $postdb['parseMsg'], 'Admin/Dashboard/adduser');
				}else{
					echo "Please wait, we'll take you back to the dashboard right away...";
					notify('success', 'Post added sucessfully', 'Admin/Dashboard/adduser');
				}
			}	

		}else{
			$currentUser = $this->session->userdata('user_vars');
			$adminName = $this->editpost_header();
			if ($currentUser){		
			
				$dashView = $this->load->view('dashboard/editpost', $adminName, true);
				buildPage($dashView, 'Dashboard - Add User');
			}
			else{
				echo 'hey';
				redirect('Admin/Login', 'refresh');
			}
		}
	}

	public function edituser($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
		
			$status1 = true;

			$firstName = $post['fname'];
			$lastName = $post['lname'];
			$password = $post['password'];

			if ($firstName == '' || $lastName == '' || $password == '') {
				notify('danger', 'Fields cannot be empty', 'Admin/Dashboard/edituser/' . $id);
			}else{				
				  $postArray = [
								'firstname' => $firstName,
								'lastname' => $lastName,
								'password' => $password
								];

				$postdb = $this->login->edituser($id, $postArray);

				if (!$postdb['status']){
					$status1 = false;
				}
				$currentUser = $this->session->userdata('user_vars');
				if (!$status1){
					notify('danger', $postdb['parseMsg'], 'Admin/Dashboard/edituser/' . $currentUser['userid']);
				}else{
					echo "Please wait, we'll take you back to the dashboard right away...";
					notify('success', 'Edited sucessfully', 'Admin/Dashboard/edituser/' . $currentUser['userid']);
				}
			}	

		}else{
			$currentUser = $this->session->userdata('user_vars');
			$adminName = $this->edituser_header();
			if ($currentUser){		
			
				$dashView = $this->load->view('dashboard/profileedit', $adminName, true);
				buildPage($dashView, 'Dashboard - Edit User');
			}
			else{
				echo 'hey';
				redirect('Admin/Login', 'refresh');
			}
		}
	}

	public function makepost()
	{
		$postArray = ['email' => $_POST['email'],
						'password1' => $_POST['password1'],
						'fname' => $_POST['fname'],
						'address' => $_POST['address'],
						'mobile' => $_POST['mobile'],
						'sex' => $_POST['sex'],
						'dob' => $_POST['dob'],
						'town' => $_POST['town'],
						'country' => $_POST['country'],
						'lga' => $_POST['lga'],
						'key_skills' => $_POST['key_skills'],
						'exp_year' => $_POST['exp_year'],
						'func_area' => $_POST['func_area'],
						'pri_name' => $_POST['pri_name'],
						'pri_grad' => $_POST['pri_grad'],
						'pri_qual' => $_POST['pri_qual'],
						'sec_name' => $_POST['sec_name'],
						'sec_grad' => $_POST['sec_grad'],
						'sec_qual' => $_POST['sec_qual'],
						'uni_name' => $_POST['uni_name'],
						'uni_degree' => $_POST['uni_degree'],
						'uni_grad' => $_POST['uni_grad'],
						'uni_qual' => $_POST['uni_qual'],
						'ms_univ' => $_POST['ms_univ'],
						'ms_degree' => $_POST['ms_degree'],
						'ms_completion' => $_POST['ms_completion'],
						'pg_univ' => $_POST['pg_univ'],
						'pg_degree' => $_POST['pg_degree'],
						'pg_completion' => $_POST['pg_completion'],
						'type' => $_POST['type'],
					];
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
    		$userid = $currentUser['userid'];
			$roleCheck = $this->db->get_where('accesslevel', ['id' => $accessid])->row();
			// $totalUsers = $this->db->get_where('userdetails', ['aid' => 5])->result();
			// $activeUsers = $this->db->get_where('userdetails', ['status' => 1])->result();
			// $expiredUsers = $this->db->get_where('userdetails', ['status' => 0])->result();
			// $totalVouchers = $this->db->get('vouchers')->result();
			// $this->db->select('voucherid');
			$data = $this->db->get('worker_details')->result();
			// $unUsedVouchers = count($totalVouchers) - count($usedVouchers);
    		$role = $roleCheck->name;

    		return array(
    		'displayData' => 'display:none',
        	'firstName' => $firstName,
        	'lastName' => $lastName,
        	'redirect' => $url,
        	'role' => $role,
        	'id' => $userid,
        	'totalData' => count($data),
        	// 'totalVouchers' => count($totalVouchers),
        	// 'usedVouchers' => count($usedVouchers),
        	// 'unUsedVouchers' => $unUsedVouchers,
        	// 'activeusers' => count($activeUsers),
        	// 'expiredUsers' => count($expiredUsers),
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
				$usedVoucher[] = $this->db->get_where('vouchers', ['id' => $val->voucherid])->result();
				
			}
			$unUsedVouchers = count($totalVouchers) - count($usedVouchers);
    		$role = $roleCheck->name;

    		return array(
    		'displayData' => 'display:none',
        	'firstName' => $firstName,
        	'lastName' => $lastName,
        	'redirect' => $url,
        	'role' => $role,
        	'state' => $state,
        	'totalUsers' => $totalUsers,
        	'totalVouchers' => $totalVouchers,
        	'usedVouchers' => $usedVoucher,
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
    		$userid = $currentUser['userid'];
    		$accessid = $currentUser['accesslevel'];
			$roleCheck = $this->db->get_where('accesslevel', ['id' => $accessid])->row();
			$posts = $this->db->get('worker_details')->result();
			// var_dump($posts);
			// exit;
    		$role = $roleCheck->name;

    		return array(
    		'displayData' => 'display:none',
        	'firstName' => $firstName,
        	'lastName' => $lastName,
        	'redirect' => $url,
        	'role' => $role,
        	'id' => $userid,
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

    public function editpost_header(){

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
    		$userid = $currentUser['userid'];
			$roleCheck = $this->db->get_where('accesslevel', ['id' => $accessid])->row();
			$aid = $this->db->get('accesslevel')->result();
			// var_dump($aid);
			// exit;
    		$role = $roleCheck->name;

    		return array(
    		'displayData' => 'display:none',
        	'firstName' => $firstName,
        	'lastName' => $lastName,
        	'redirect' => $url,
        	'role' => $role,
        	'aids' => $aid,
        	'id' => $userid,
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

    public function edituser_header(){

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
    		$userid = $currentUser['userid'];
    		$accessid = $currentUser['accesslevel'];
    		$userid = $currentUser['userid'];
			$roleCheck = $this->db->get_where('accesslevel', ['id' => $accessid])->row();
			$details = $this->db->get_where('userdetails', ['id' => $userid])->row();
			$aid = $this->db->get('accesslevel')->result();
			// var_dump($details);
			// exit;
    		$role = $roleCheck->name;

    		return array(
    		'displayData' => 'display:none',
        	'firstName' => $firstName,
        	'lastName' => $lastName,
        	'redirect' => $url,
        	'role' => $role,
        	'id' => $userid,
        	'details' => $details,
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

    public function getTable()
    {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('fname', 'email', 'mobile', 'sex', 'uni_degree', 'town', 'country', 'lga');
        
        // DB table to use
        $sTable = 'worker_details';
        //
    
        $iDisplayStart = $this->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->input->get_post('iDisplayLength', true);
        $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('sSearch', true);
        $sEcho = $this->input->get_post('sEcho', true);
    
        // Paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }
        
        // Ordering
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
                if($bSortable == 'true')
                {
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
                }
            }
        }
        
        /* 
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        if(isset($sSearch) && !empty($sSearch))
        {
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                
                // Individual column filtering
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
                }
            }
        }
        
        // Select Data
        $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        $rResult = $this->db->get($sTable);
    
        // Data set length after filtering
        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;
    
        // Total data set length
        $iTotal = $this->db->count_all($sTable);
    
        // Output
        $output = array(
            'sEcho' => intval($sEcho),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => array()
        );
        
        foreach($rResult->result_array() as $aRow)
        {
            $row = array();
            
            foreach($aColumns as $col)
            {
                $row[] = $aRow[$col];
            }
    
            $output['aaData'][] = $row;
        }
    
        echo json_encode($output);
    }

    public function mailout($message, $subject, $email)
    {
    	$to      = $email;
		//$message = '';
    	// To send HTML mail, the Content-type header must be set
    	$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		//$headers .= 'To: Lawrence <l.agbani@hotmail.co.uk>' . "\r\n";
		$headers .= 'From: SolomonMax <lawrence@lawrencetalks.com>' . "\r\n";
		//$headers .= 'Cc: agbani92@gmail.com' . "\r\n";
		//$headers .= 'Bcc: agbani92@gmail.com' . "\r\n";
	    $headers .= 'Reply-To: info@solomonmax.com' . "\r\n";
	    $headers .= 'X-Mailer: PHP/' . phpversion();
	   try {
	   	mail($to, $subject, $message, $headers, '-flawrence@lawrencetalks.com -rlawrence@lawrencetalks.com');
	   	notify('info', "Your Mail has been sent successfully", site_url('Admin/Dashboard/email'));
	   } catch (Exception $e) {
	   	notify('info', "There was an error " . $e->getMessage(), site_url('Admin/Dashboard/email'));
	   }
	   
    }

    public function mailoutmulti($message, $subject, $email)
    {
    	$to      = $email;
		//$message = '';
    	// To send HTML mail, the Content-type header must be set
    	$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		//$headers .= 'To: Lawrence <l.agbani@hotmail.co.uk>' . "\r\n";
		$headers .= 'From: SolomonMax <lawrence@lawrencetalks.com>' . "\r\n";
		//$headers .= 'Cc: agbani92@gmail.com' . "\r\n";
		//$headers .= 'Bcc: agbani92@gmail.com' . "\r\n";
	    $headers .= 'Reply-To: info@solomonmax.com' . "\r\n";
	    $headers .= 'X-Mailer: PHP/' . phpversion();
	   try {
	   	mail($to, $subject, $message, $headers, '-flawrence@lawrencetalks.com -rlawrence@lawrencetalks.com');
	   	//notify('info', "Your Mail has been sent successfully", site_url('Admin/Dashboard/email'));
	   } catch (Exception $e) {
	   	//notify('info', "There was an error " . $e->getMessage(), site_url('Admin/Dashboard/email'));
	   }
	   
    }

    public function email()
    {
    	if ($this->input->post('testmail')) {
			$post = $this->input->post('testmail');

			$message = $post['testmessage'];
			$subject = $post['subject'];
			$to = $post['testemail'];

			$this->mailout($message, $subject, $to);
			
		}elseif($this->input->post('fullmail')){
			$post = $this->input->post('fullmail');

			$message = $post['message'];
			$subject = $post['subject'];

			$result = $this->db->get_where('worker_details', ['email'])->result();
			foreach ($result as $val) {
				$this->mailoutmulti($message, $subject, $val->email);
			}
			notify('info', "Your Mails have been sent successfully", site_url('Admin/Dashboard/email'));
		}else{
			$currentUser = $this->session->userdata('user_vars');
			$adminName = $this->menu_header();
			if ($currentUser){		
			
				$dashView = $this->load->view('dashboard/email', $adminName, true);
				buildPage($dashView, 'Dashboard - Send Email');
			}
			else{
				echo 'hey';
				redirect('Admin/Login', 'refresh');
			}
		}
    }

}
