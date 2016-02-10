<?php

/*Signup_model
This model gets emails, password and other info. from the Company controller
and registers a company and company admin through the doSignup() function.
Database used all through this project is Parse.com's backend as a service.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

use Parse\ParseUser;
use Parse\ParseException;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParseRole;

class Signup_model extends CI_Model {

	public function __construct()
        {
                parent::__construct();
        }

    public function doSignup($compname, $compmail, $compaddr, $compcount, $compstate, $compphone, $ownermail, $ownerpass, $ownerfname, $ownerlname, $ownergender){

      $dbusername = $this->session->userdata('username');

      $userDetails = $this->db->get_where('userdetails', ['username' => $dbusername])->row();
      $dbgetusername = $userDetails->username;
      $dbgetpassword = $userDetails->password;

      // var_dump($dbgetpassword);
      // exit;

      // Get the object of the country using the country Id passed from the view
      // Query for country and get the country name for use in the commpany address
      $country = new ParseObject("Country", $compcount);
      $countryQuery = new ParseQuery("Country");
      $countryQuery->equalTo("objectId", $compcount);
      $countryResult = $countryQuery->find();
      for ($i = 0; $i < count($countryResult); $i++) {
          $countryR = $countryResult[$i];
        }
      $countryName = $countryR->get("countryName");

      // Get the object of the state using the state Id passed from the view
      // Query for State and get the state name for use in the company address
      $state = new ParseObject("States", $compstate);
      $stateQuery = new ParseQuery("States");
      $stateQuery->equalTo("objectId", $compstate);
      $stateResult = $stateQuery->find();
      for ($i = 0; $i < count($stateResult); $i++) {
          $stateR = $stateResult[$i];
        }
      $stateName = $stateR->get("stateName");
  
      // create a new Company table passing in all the fields gotten from the view 
      $company = new ParseObject("Companies");
      $company->set("name", $compname);
      $company->set("email", $compmail);
      $company->set("address", $compaddr);
      $company->set("country", $country);
      $company->set("state", $state);
      $company->set("phone", $compphone);
      $company->save();

      // Create a database table to hold the former user in order to log that user back in. 
      

      // create the new company owner
      $user = new ParseUser();
      $user->set("username", $ownermail);
      $user->set("password", $ownerpass);
      $user->set("email", $ownermail);

      // other fields can be set just like with ParseObject
      $user->set("firstName", $ownerfname);
      $user->set("lastName", $ownerlname);
      $user->set("gender", $ownergender);

      try {

      // Query for the role to be assigned to the owner of the company
        $role = new ParseObject("_Role");
        $query = new ParseQuery("_Role");
        $role = $query->get('rFzjIyDwKq');
        $user->signUp();
        $role->getUsers()->add($user);
        $user->set("role", $role);
        $company->set("owner", $user);
        $company->save();
        $role->save();
        ParseUser::logOut();
        $prevUser = ParseUser::logIn($dbgetusername, $dbgetpassword);
        // Hooray! Let them use the app now.
        return ['status' => true,];
      } catch (ParseException $ex) {
        // Show the error message somewhere and let the user try again.
        // echo "Error: " . $ex->getCode() . " " . $ex->getMessage();
        return ['status' => false, 'parseMsg' => $ex->getMessage()];
      }

    }

    public function doAddManager($adminfName, $adminlName, $adminMail, $adminPass, $adminPerm)
    {
      # code...
      $currentUser = ParseUser::getCurrentUser();
      $dbusername = $this->session->userdata('username');

      $userDetails = $this->db->get_where('userdetails', ['username' => $dbusername])->row();
      $dbgetusername = $userDetails->username;
      $dbgetpassword = $userDetails->password;

      $user = new ParseUser();
      $user->set("username", $adminMail);
      $user->set("password", $adminPass);
      $user->set("email", $adminMail);
      $user->set("creator", $currentUser);

      // other fields can be set just like with ParseObject
      $user->set("firstName", $adminfName);
      $user->set("lastName", $adminlName);

      try {

      // Query for the role to be assigned to the owner of the company
        $role = new ParseObject("_Role");
        $query = new ParseQuery("_Role");
        $role = $query->get($adminPerm);
        $user->signUp();
        $role->getUsers()->add($user);
        $user->set("role", $role);
        $role->save();
        $user->save();
        ParseUser::logOut();
        $prevUser = ParseUser::logIn($dbgetusername, $dbgetpassword);
        // Hooray! Let them use the app now.
        return ['status' => true,];
      } catch (ParseException $ex) {
        // Show the error message somewhere and let the user try again.
        // echo "Error: " . $ex->getCode() . " " . $ex->getMessage();
        return ['status' => false, 'parseMsg' => $ex->getMessage()];
      }
      
    }

    public function doEditSection($name, $id)
    {
      $section = new ParseObject("Sections", $id);
      $section->set("name", $name);
      try{
      $section->save();
      return ['status' => true,];
      }
      catch (ParseException $ex){
       return ['status' => false, 'parseMsg' => $ex->getMessage()]; 
      }
    }

    public function doDeleteSection($id)
    {
       $appId = 'BXzf9jtDNrJ4g3jcjgYMOy8tfdhnHw2DtCYikvbg';
        $restKey = 'MU3rcLDnD1jDrIgrmXs8lO58dmeSC3eZLxYIfDi9';
        
        $ch = curl_init();
        curl_setopt_array($ch, array( 
            CURLOPT_URL => 'https://api.parse.com/1/classes/Sections/'. $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                "X-Parse-Application-Id: " . $appId,
                "X-Parse-Master-Key: " . $restKey
                )
        ));

        // free
      $output = curl_exec($ch);
      if($output){
        return ['status' => true,];
      }
      else{
        return ['status' => false, 'parseMsg' => 'An error ocurred while we tried to delete, Please try again'];
      }
     
      curl_close($ch);
    }

    public function doAddBeacon($beaconName, $beaconMajor, $beaconMinor, $beaconUuid)
    {
      # code...
      $beacon = new ParseObject("Beacons");
      $beacon->set("name", $beaconName);
      $beacon->set("uuid", $beaconUuid);
      $beacon->set("major", $beaconMajor);
      $beacon->set("minor", $beaconMinor);
      $beacon->set("isAssigned", false);
      try{
      $beacon->save();
      return ['status' => true,];
      }
      catch (ParseException $ex){
       return ['status' => false, 'parseMsg' => $ex->getMessage()]; 
      }
    }

    public function doAssBeacon($beaconName, $beacComp)
    {
      # code...
      $query = new ParseQuery("Companies");
      $beacQuery = new ParseQuery("Beacons");
      $company = $query->get($beacComp);
      $beacon = $beacQuery->get($beaconName);
      $beacon->set("company", $company);
      $beacon->set("isAssigned", true);
      try{
      $beacon->save();
      return ['status' => true,];
      }
      catch (ParseException $ex){
       return ['status' => false, 'parseMsg' => $ex->getMessage()]; 
      }
    }

    public function doUnAssBeacon($beaconId)
    {
      # code...
      $beacQuery = new ParseQuery("Beacons");
      $beacon = $beacQuery->get($beaconId);
      $beacon->set("isAssigned", false);
      $beacon->delete("company");
      try{
      $beacon->save();
      return ['status' => true,];
      }
      catch (ParseException $ex){
       return ['status' => false, 'parseMsg' => $ex->getMessage()]; 
      }
    }

    public function doAddVenueOther($venueName, $venueMail, $venueAddr, $venueCityEx, $venueState, $companyId)
    {
      # code...
      $state = new ParseObject("States", $venueState);
      $outlet = new ParseObject("Outlets");
      $company = new ParseObject("Companies", $companyId);
      $city = new ParseObject("City");
      $city->set("Cities", $venueCityEx);
      $city->set("states", $state);
      $outlet->set("outletName", $venueName);
      $outlet->set("email", $venueMail);
      $outlet->set("address", $venueAddr);
      $outlet->set("city", $city);
      $outlet->set("company", $company);
      try{
      $outlet->save();
      return ['status' => true,];
      }
      catch (ParseException $ex){
       return ['status' => false, 'parseMsg' => $ex->getMessage()]; 
      }
    }

    public function doAddVenue($venueName, $venueMail, $venueAddr, $venueCity, $venueState, $companyId)
    {
      # code...
      //$state = new ParseObject("States", $venueState);
      $outlet = new ParseObject("Outlets");
      $city = new ParseObject("City", $venueCity);
      $company = new ParseObject("Companies", $companyId);
      $outlet->set("outletName", $venueName);
      $outlet->set("email", $venueMail);
      $outlet->set("address", $venueAddr);
      $outlet->set("city", $city);
      $outlet->set("company", $company);
      try{
      $outlet->save();
      return ['status' => true,];
      }
      catch (ParseException $ex){
       return ['status' => false, 'parseMsg' => $ex->getMessage()]; 
      }
    }

    public function doAssUser($user, $venue)
    {
      # code...
      # 
        $appId = 'BXzf9jtDNrJ4g3jcjgYMOy8tfdhnHw2DtCYikvbg';
        $restKey = 'MU3rcLDnD1jDrIgrmXs8lO58dmeSC3eZLxYIfDi9';
        $data = '{"outlet": {"__type": "Pointer","className": "Outlets","objectId": "'.$venue.'"},"isOutletAssigned": true}';
        $ch = curl_init();
        // set a single option...
        //curl_setopt($ch, OPTION, $value);
        // ... or an array of options
        curl_setopt_array($ch, array( 
            CURLOPT_URL => 'https://api.parse.com/1/users/'.$user,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                "X-Parse-Application-Id: " . $appId,
                "X-Parse-Master-Key: " . $restKey,
                "Content-Type: application/json")
        ));

        // free
       
      $output = curl_exec($ch);
      if($output){
      return ['status' => true,];
    }else{
       return ['status' => false, 'parseMsg' => 'There was an Error, Please try again'];

    }
      
         
      curl_close($ch);

    }

    public function doUnAssUser($user)
    {
      # code...
        $appId = 'BXzf9jtDNrJ4g3jcjgYMOy8tfdhnHw2DtCYikvbg';
        $restKey = 'MU3rcLDnD1jDrIgrmXs8lO58dmeSC3eZLxYIfDi9';
        $data = '{"outlet": {"__op": "Delete"}, "isOutletAssigned": false}';
        $ch = curl_init();
        // set a single option...
        //curl_setopt($ch, OPTION, $value);
        // ... or an array of options
        curl_setopt_array($ch, array( 
            CURLOPT_URL => 'https://api.parse.com/1/users/'.$user,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                "X-Parse-Application-Id: " . $appId,
                "X-Parse-Master-Key: " . $restKey,
                "Content-Type: application/json")
        ));

        // free
        $output = curl_exec($ch);
        if($output){
      return ['status' => true,];
    }else{
       return ['status' => false, 'parseMsg' => 'There was an Error, Please try again'];

    }
      
         
      curl_close($ch);
    }

    public function doAddCampaign($title, $desc, $type, $points, $date, $section, $userpoints, $startdate, $age, $gender)
    {
      $date1 = date('Y-m-d H:i', strtotime((string)date('Y-m-d')));
      $date2 = date_create($date1);
      $user = ParseUser::getCurrentUser();
      $outletCheck = $user->get("outlet");
      $outletCheck->fetch();
      $sectionObject = new ParseObject("Sections", $section);

      $starto = date_format($startdate, 'Y-M-d');
      // var_dump($starto);
      // exit;

      $city = $outletCheck->get("city");
      $city->fetch();

      $activity = new ParseObject("ActivityLog");
      $activity->set("city", $city);
      $activity->set("activity", "Campaign Added");
      $activity->set("startDate", $starto);

      $offers = new ParseObject("OutletOffers");
      $offers->set("offerTitle", $title);
      $offers->set("offerDescription", $desc);
      $offers->set("offerType", $type);
      $offers->set("pointBalance", $points);
      if($startdate >= $date2){
        $offers->set("offerStatus", "sent");
      }else{
        $offers->set("offerStatus", "expired");
      }
      $offers->set("age", $age);
      $offers->set("gender", $gender);
      $offers->set("offerPoints", $points);
      $offers->set("userAllocation", $userpoints);
      $offers->set("expiryDate", $date);
      $offers->set("startDate", $startdate);
      $offers->set("startStrDate", $starto);
      $offers->set("outlet", $outletCheck);
      $offers->set("section", $sectionObject);
      try{
        $offers->save();
        $activity->set("campaign", $offers);
        $activity->save();
      return ['status' => true,];
      }
      catch (ParseException $ex){
       return ['status' => false, 'parseMsg' => $ex->getMessage()]; 
      }
    }

    public function doAddCampaign1($title, $desc, $type, $points, $date, $section, $userpoints, $startdate, $age, $gender, $venueId)
    {
      $date1 = date('Y-m-d H:i', strtotime((string)date('Y-m-d')));
      $date2 = date_create($date1);

      $outletCheck = new ParseObject("Outlets", $venueId);
      $sectionObject = new ParseObject("Sections", $section);

      $starto = date_format($startdate, 'Y-M-d');

      $query = new ParseQuery("Outlets");
      $query->equalTo("objectId", $venueId);
      $outlet = $query->first();
      $city = $outlet->get("city");
      $city->fetch();

      $activity = new ParseObject("ActivityLog");
      $activity->set("city", $city);
      $activity->set("activity", "Campaign Added");
      $activity->set("startDate", $starto);

      $offers = new ParseObject("OutletOffers");
      $offers->set("offerTitle", $title);
      $offers->set("offerDescription", $desc);
      $offers->set("offerType", $type);
      $offers->set("pointBalance", $points);
      if($startdate >= $date2){
        $offers->set("offerStatus", "sent");
      }else{
        $offers->set("offerStatus", "expired");
      }
      $offers->set("age", $age);
      $offers->set("gender", $gender);
      $offers->set("offerPoints", $points);
      $offers->set("userAllocation", $userpoints);
      $offers->set("expiryDate", $date);
      $offers->set("startDate", $startdate);
      $offers->set("startStrDate", $starto);
      $offers->set("outlet", $outletCheck);
      $offers->set("section", $sectionObject);
      try{
        $offers->save();
        $activity->set("campaign", $offers);
        $activity->save();
        return ['status' => true,];
      }
      catch (ParseException $ex){
        return ['status' => false, 'parseMsg' => $ex->getMessage()]; 
      }
    }

    public function doEditCampaign($title, $type, $points, $userpoints, $description, $gender, $age, $date, $campaignId)
    {
     
      $offers = new ParseObject("OutletOffers", $campaignId);
      $offers->set("offerTitle", $title);;
      $offers->set("offerType", $type);
      $offers->set("offerPoints", $points);
      $offers->set("userAllocation", $userpoints);
      $offers->set("offerDescription", $description);
      $offers->set("gender", $gender);
      $offers->set("age", $age);
      $offers->set("expiryDate", $date);
      try{
      $offers->save();
      return ['status' => true,];
      }
      catch (ParseException $ex){
       return ['status' => false, 'parseMsg' => $ex->getMessage()]; 
      }
    }

    public function doSecBeacAssign($id, $secId)
    {
      $section = new ParseObject("Sections", $secId);
      $beacon = new ParseObject("Beacons", $id);
      $beacon->set("section", $section);
      $beacon->set("isSectionAssigned", true);
      try{
      $beacon->save();
      return ['status' => true,];
      }
      catch (ParseException $ex){
       return ['status' => false, 'parseMsg' => $ex->getMessage()]; 
      }
    }

    public function doSecBeacUnassign($id, $secId)
    {
      $section = new ParseObject("Sections", $secId);
      $beacon = new ParseObject("Beacons", $id);
      $beacon->delete("section");
      $beacon->set("isSectionAssigned", false);
      try{
      $beacon->save();
      return ['status' => true,];
      }
      catch (ParseException $ex){
       return ['status' => false, 'parseMsg' => $ex->getMessage()]; 
      }
    }
	
}
/*
End of Signup_model
 */
