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

		$currentUser = ParseUser::getCurrentUser();
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
		$currentUser = ParseUser::getCurrentUser();
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

	public function makepost()
	{
		if ($this->input->post('adminpost')) {
			$post = $this->input->post('adminpost');
			$status1 = true;

			$postPath = $_FILES['adminpost']['name']['file'];
			$filePath = 'assets/uploads';
			$finalPath = $filePath . '/'.$postPath;

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
				$chunkFilter = new chunkReadFilter(); 
				/**  Tell the Reader that we want to use the Read Filter  **/ 
				$objReader->setReadFilter($chunkFilter);

				$someArray = [];
				$anArray = [];
				$finalArray = [];

				$operations = 0;

				$datecreated = date('Y-m-d h:i:s');

				/**  Loop to read our worksheet in "chunk size" blocks  **/ 
				for ($startRow = 2; $startRow <= 65536; $startRow += $chunkSize) { 
				    /**  Tell the Read Filter which rows we want this iteration  **/ 
				    $chunkFilter->setRows($startRow, $chunkSize); 
				    /**  Load only the rows that match our filter  **/ 
				    $objPHPExcel = $objReader->load($finalPath); 
				    //    Do some processing here 
				    $someArray = $objPHPExcel->getActiveSheet()->toArray(null, true,true,true);
				    unset($someArray[1]);
				} 
				foreach ($someArray as $key => $value) {
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
					//unset($anArray['L']);
					//var_dump($anArray);
					$this->doIteratedUpload($anArray);
				}			
				echo "Please wait, we'll take you back to the dashboard right away...";
				notify('success', 'Post added sucessfully', 'Admin/Dashboard/newpost');	
				//exit;

			}else{

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
		$currentUser = ParseUser::getCurrentUser();
		$firstName = '';
		$lastName = '';
		$url = 'Admin/Dashboard';
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
    		'displayData' => 'display:none',
        	'firstName' => $firstName,
        	'lastName' => $lastName,
        	'redirect' => $url,
        	'role' => $role,
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

}

/** Define a Read Filter class implementing PHPExcel_Reader_IReadFilter  
** This class reads through the excel file and uses our definition of
** rows to start with, and all that.
*/ 
class chunkReadFilter implements PHPExcel_Reader_IReadFilter 
{ 
    private $_startRow = 0; 
    private $_endRow   = 0; 

    /**  Set the list of rows that we want to read  */ 
    public function setRows($startRow, $chunkSize) { 
        $this->_startRow = $startRow; 
        $this->_endRow   = $startRow + $chunkSize; 
    } 
    public function readCell($column, $row, $worksheetName = '') { 
        //  Only read the heading row, and the configured rows 
        if (($row >= 2) ||
            ($row >= $this->_startRow && $row < $this->_endRow)) { 
            return true; 
        } 
        return false; 
    } 
} 
