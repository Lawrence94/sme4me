<?php

/*Editcompquery_model
This model helps to query for company details for the editCompany view using
the doQuery() function.
Database used all through this project is Parse.com's backend as a service.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

use Parse\ParseUser;
use Parse\ParseException;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParseRole;
use Parse\ParseObject;

class Editcompquery_model extends CI_Model {

  public function __construct()
        {
                parent::__construct();
        }

    public function doQuery($venueId){

      
      $outlet = new ParseObject("Outlets", $venueId);
      $beacQuery = new ParseQuery("Beacons");
      $beacresults = $beacQuery->equalTo("outlet", $outlet)
      ->count();



      $outletQuery = new ParseQuery("Outlets");
      $compResults = $outletQuery->equalTo("objectId", $venueId)
      ->includeKey("city.states")
      ->includeKey("city.states.country")
      ->first();


      $outletInfo = [];

    
          $object = $compResults;
          $cityCheck = $object->get("city");
          $statesCheck = $cityCheck->get("states");
          $countryCheck = $statesCheck->get("country");
          $city = $cityCheck->get("Cities");
          $state = $statesCheck->get("stateName");
          $country = $countryCheck->get("countryName");
          $outletInfo[] =   ['venueName' => $object->get('outletName'),
                             'venueAddr' => $object->get('address').', '.$city.', '.$state.', '.$country,
                             'venueEmail' => $object->get('email'),
                             'venueId' => $object->getObjectId(),
                             'totalBeac' => $beacresults,
                            ];
      

      
      return $outletInfo;
    }

    public function doSectionAdd($sectionName, $companyId)
    {
      $company = new ParseObject("Companies", $companyId);
      $section = new ParseObject("Sections");
      $section->set("name", $sectionName);
      $section->set("company", $company);
      try{
      $section->save();
      return ['status' => true,];
      }
      catch (ParseException $ex) {
        return ['status' => false, 'parseMsg' => $ex->getMessage()];
      }
    }

    public function sectionQuery($venueId, $compId)
    {
      $company = new ParseObject("Companies", $compId);
      $outlet = new ParseObject("Outlets", $venueId);
      $query = new ParseQuery("Sections");
      $secResult = $query->equalTo("company", $company)
      ->find();
      $section_info = [];

      for ($i = 0; $i < count($secResult); $i++) {
          $object = $secResult[$i];
          $section = new ParseObject("Sections", $object->getObjectId());
          $offerQuery = new ParseQuery("OutletOffers");
          $offerResult = $offerQuery->equalTo("section", $section)
          ->equalTo("outlet", $outlet)
          ->equalTo("offerStatus", "live")
          ->count();

          $beacQuery = new ParseQuery("Beacons");
          $beacResult = $beacQuery->equalTo("section", $section)
          ->equalTo("outlet", $outlet)
          ->count();

          $section_info[] = ['sectionName' => $object->get("name"),
                             'campaigns' => $offerResult,
                             'beacons' => $beacResult,
                             'sectionId' => $object->getObjectId(),
                            ];
      }
      return $section_info;

    }

    public function sectionQuery1($compId)
    {
      $company = new ParseObject("Companies", $compId);
      $query = new ParseQuery("Sections");
      $secResult = $query->equalTo("company", $company)
      ->find();
      $section_info = [];

      for ($i = 0; $i < count($secResult); $i++) {
          $object = $secResult[$i];
          $section_info[] = ['sectionName' => $object->get("name"),
                             'dateCreated' => $object->getCreatedAt(),
                             'sectionId' => $object->getObjectId(),
                            ];
      }
      return $section_info;
    }

    public function campaignQuery()
    {
      $user = ParseUser::getCurrentUser();
      $outletCheck = $user->get("outlet");
      $section_info = [];

      if($user->get("isOutletAssigned")){
      $outletCheck->fetch();
      $query = new ParseQuery("OutletOffers");
      $secResult = $query->equalTo("outlet", $outletCheck)
      ->find();
      $section_info = [];

      for ($i = 0; $i < count($secResult); $i++) {
          $object = $secResult[$i];
          $section_info[] = ['offerTitle' => $object->get("offerTitle"),
                             'dateCreated' => $object->getCreatedAt(),
                             'offerType' => $object->get("offerType"),
                             'offerPoints' => $object->get("offerPoints"),
                             'offerId' => $object->getObjectId(),
                             'startDate' => $object->get("startDate"),
                             'expiryDate' => $object->get("expiryDate"),
                            ];
      }
      return $section_info;
      }
      else{
        return $section_info;
      }

     
    }

    public function adminCampaignQuery()
    {
      $user = ParseUser::getCurrentUser();
      $outletCheck = $user->get("company");
      $companyQuery = new ParseQuery("Companies");
      $companyQuery->equalTo("owner", $user);

      $outletQuery = new ParseQuery("Outlets");
      $outletQuery->matchesQuery("company", $companyQuery);

      $campaign_info = [];

      $query = new ParseQuery("OutletOffers");
      $secResult = $query->matchesQuery("outlet", $outletQuery)
      ->includeKey("outlet")
      ->find();

      for ($i = 0; $i < count($secResult); $i++) {
          $object = $secResult[$i];
          $venueCheck = $object->get("outlet");
          $venue = $venueCheck->get("outletName");
          $campaign_info[] = ['offerTitle' => $object->get("offerTitle"),
                             'dateCreated' => $object->getCreatedAt(),
                             'offerId' => $object->getObjectId(),
                             'offerStatus' => $object->get("offerStatus"),
                             'startDate' => $object->get("startDate"),
                             'expiryDate' => $object->get("expiryDate"),
                             'venue' => $venue
                            ];
      }
      return $campaign_info;
          
    }

    public function campaignQuery1($venueId)
    {
      $venue = new ParseObject("Outlets", $venueId);
      $campaign_info = [];

      $query = new ParseQuery("OutletOffers");
      $secResult = $query->equalTo("outlet", $venue)
      ->find();

      for ($i = 0; $i < count($secResult); $i++) {
          $object = $secResult[$i];
          $campaign_info[] = ['offerTitle' => $object->get("offerTitle"),
                              'offerType' => $object->get("offerType"),
                              'offerPoints' => $object->get("offerPoints"),
                              'dateCreated' => $object->getCreatedAt(),
                              'offerId' => $object->getObjectId(),
                              'offerStatus' => $object->get("offerStatus"),
                              'startDate' => $object->get("startDate"),
                              'expiryDate' => $object->get("expiryDate"),
                            ];
      }
      return $campaign_info;
      
    }

    public function venueBeaconQuery($venueId)
    {
      $outlet = new ParseObject("Outlets", $venueId);
      $query = new ParseQuery("Beacons");
      $queryResult = $query->equalTo("outlet", $outlet)
      ->includeKey("section")
      ->includeKey("placement")
      ->find();
      $beacon_info = [];
      $status = '';
      $placement = '';
      $section = '';

      for ($i = 0; $i < count($queryResult); $i++) {
          $object = $queryResult[$i];
          $isActive = $object->get("isActive");
          $isSectionAssigned = $object->get("isSectionAssigned");
          $isPlaced = $object->get("isPlaced");
          if($isActive){
            $status = 'Active';
          }else{
            $status = 'Inactive';
          }
          if($isSectionAssigned){
          $sectionCheck = $object->get("section");
          $section = $sectionCheck->get("name");
          }
          if($isPlaced){
          $placeCheck = $object->get("placement");
          $placement = $placeCheck->get("name");
          }
          $beacon_info[] = ['beaconUuid' => $object->get("name"),
                            'placement' => $placement,
                            'section' => $section,
                            'status' => $status,
                            'beaconId' => $object->getObjectId(),
                            'venueId' => $venueId,
                          ];
      }
      return $beacon_info;

    }

    public function beaconQuery()
    {
     $user = ParseUser::getCurrentUser();
     $compQuery = new ParseQuery("Companies");
     $result = $compQuery->equalTo("owner", $user)
     ->first();
     $compId = $result->getObjectId();
     $company =  new ParseObject("Companies", $compId);
     $query = new ParseQuery("Beacons");
     $queryResult = $query->equalTo("company", $company)
     ->notEqualTo("isStoreAssign", true)
     ->find();
     $beacon = [];
     for ($i = 0; $i < count($queryResult); $i++) {
          $object = $queryResult[$i];
          $beacon[$object->getObjectId()] = $object->get("name");
      } 
      return $beacon;
    }

    public function doBeaconAssign($venueId, $beaconid)
    {
      $venue = new ParseObject("Outlets", $venueId);
      $beacon = new ParseObject("Beacons", $beaconid);
      $beacon->set("outlet", $venue);
      $beacon->set("isStoreAssign", true);
      try{
      $beacon->save();
      return ['status' => true,];
      }
      catch (ParseException $ex) {
        return ['status' => false, 'parseMsg' => $ex->getMessage()];
      }
    }

    public function doCompOwnerEdit($ownerfName, $ownerMail, $ownerlName, $ownerPass, $ownerGender, $ownerId)
    {
        $appId = 'BXzf9jtDNrJ4g3jcjgYMOy8tfdhnHw2DtCYikvbg';
        $restKey = 'MU3rcLDnD1jDrIgrmXs8lO58dmeSC3eZLxYIfDi9';
        $updatedDataArray = ['firstName' => $ownerfName,
                        'lastName' => $ownerlName,
                        'email' => $ownerMail,
                        'username' => $ownerMail,
                        'gender' => $ownerGender,
                        'password' => $ownerPass
                      ];
        $updatedData = json_encode($updatedDataArray);
        $ch = curl_init();

        // set a single option...
        //curl_setopt($ch, OPTION, $value);
        // ... or an array of options
        curl_setopt_array($ch, array( 
            CURLOPT_URL => 'https://api.parse.com/1/users/'. $ownerId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => $updatedData,
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
      }
      else{
        return ['status' => false, 'parseMsg' => 'There was an error during save, Please try again'];
      }
     
      curl_close($ch);
    }

    public function doDeleteCampaign($campaignId)
    {
      $campaign = new ParseObject("OutletOffers", $campaignId);
      $query = new ParseQuery("ActivityLog");
      $query->equalTo("campaign", $campaign);
      $activity = $query->first();
      try {
        $campaign->destroy();
        $activity->destroy();
        return ['status' => true,];
      } catch (ParseException $e) {
        return ['status' => false, 'parseMsg' => 'An error ocurred while we tried to delete, Please try again shortly'];
      }
      //  $appId = 'BXzf9jtDNrJ4g3jcjgYMOy8tfdhnHw2DtCYikvbg';
      //   $restKey = 'MU3rcLDnD1jDrIgrmXs8lO58dmeSC3eZLxYIfDi9';
      //   $ch = curl_init();

      //   // set a single option...
      //   //curl_setopt($ch, OPTION, $value);
      //   // ... or an array of options
      //   curl_setopt_array($ch, array( 
      //       CURLOPT_URL => 'https://api.parse.com/1/classes/OutletOffers/'.$campaignId,
      //       CURLOPT_RETURNTRANSFER => true,
      //       CURLOPT_CUSTOMREQUEST => "DELETE",
      //       CURLOPT_SSL_VERIFYPEER => false,
      //       CURLOPT_HTTPHEADER => array(
      //           "X-Parse-Application-Id: " . $appId,
      //           "X-Parse-Master-Key: " . $restKey
      //           )
      //   ));

      // $output = curl_exec($ch);
      // if($output){
      //   return ['status' => true,];
      // }
      // else{
      //   return ['status' => false, 'parseMsg' => 'An error ocurred while we tried to delete, Please try again shortly'];
      // }
     
      // curl_close($ch);
      
    }

    public function doAdminEditQuery($userId)
    {
      # code...
      $query = ParseUser::query();
      $query->equalTo("objectId", $userId); 
      $results = $query->find();
      $perm_info = [];
      $admin_info = [];
      for ($i = 0; $i < count($results); $i++) {
          $object = $results[$i];
          $permCheck = $object->get("role");
          $permCheck->fetch();
          $perm_info[$permCheck->getObjectId()] = $permCheck->get('name');
          $admin_info[] = ['userfName' => $object->get('firstName'),
                           'userId' => $object->getObjectId(),
                           'userlName' => $object->get('lastName'),
                           'userMail' => $object->get('email'),
                           'userPass' => $object->get('password'),
                      ];
        }
        return $admin_info;
    }

    public function doUserDelete($userId)
    {
      # code...
        $appId = 'BXzf9jtDNrJ4g3jcjgYMOy8tfdhnHw2DtCYikvbg';
        $restKey = 'MU3rcLDnD1jDrIgrmXs8lO58dmeSC3eZLxYIfDi9';
        $ch = curl_init();

        // set a single option...
        //curl_setopt($ch, OPTION, $value);
        // ... or an array of options
        curl_setopt_array($ch, array( 
            CURLOPT_URL => 'https://api.parse.com/1/users/'. $userId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                "X-Parse-Application-Id: " . $appId,
                "X-Parse-Master-Key: " . $restKey
                )
        ));
        $output = curl_exec($ch);
        if($output){
        return ['status' => true,];
        }
        else{
          return ['status' => false, 'parseMsg' => 'An error ocurred while we tried to delete, Please try again'];
        }
        curl_close($ch);
    }

    public function doEditManager($adminfName, $adminlName, $adminMail, $adminPass, $adminPerm, $adminId)
    {
      # code...
        $query = new ParseQuery("_Role");
        $role = new ParseObject("_Role");
        $role = $query->get($adminPerm);
        $appId = 'BXzf9jtDNrJ4g3jcjgYMOy8tfdhnHw2DtCYikvbg';
        $restKey = 'MU3rcLDnD1jDrIgrmXs8lO58dmeSC3eZLxYIfDi9';
        //$roling = '{"firstName": '. '"'.$adminfName.'"'.',"lastName": '.'"'.$adminlName.'"'.',"email": '.'"'.$adminMail.'","username": '.'"'.$adminMail.'","password": '.'"'.$adminPass.'","role":{"__type": "Pointer","className": "_Role","objectId": '.'"'.$adminPerm.'"'.'}}';
       
        $roleArray = ['__type' => 'Pointer',
                      'className' => '_Role',
                      'objectId' => $adminPerm,
                    ];
        //$check = json_encode($role);
        
        $updatedDataArray = ['firstName' => $adminfName,
                             'lastName' => $adminlName,
                             'email' => $adminMail,
                             'username' => $adminMail,
                             'password' => $adminPass,
                             'role' => $roleArray,
                          ];
        $data = json_encode($updatedDataArray);
       
        //$data = '{"firstName":"$adminfName","lastName":"$adminlName","email":"$adminMail","username":"$adminMail","password":"$adminPass","role":"415-369-6201"}';
         
        $ch = curl_init();

        // set a single option...
        // '{"phone":"415-369-6201"}'
        //curl_setopt($ch, OPTION, $value);
        // ... or an array of options
        curl_setopt_array($ch, array( 
            CURLOPT_URL => 'https://api.parse.com/1/users/'. $adminId,
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
      }
      else{
        return ['status' => false, 'parseMsg' => 'There was an error during save, Please try again'];
      }
     
      curl_close($ch);
    }

    public function doEditBeacon($beaconName, $beaconMajor, $beaconMinor, $beaconUuid, $beaconId)
    {
      # code...
      $query = new ParseQuery("Beacons");
      $beacon = $query->get($beaconId);
      $beacon->set("name", $beaconName);
      $beacon->set("major", $beaconMajor);
      $beacon->set("minor", $beaconMinor);
      $beacon->set("uuid", $beaconUuid);
      try{
      $beacon->save();
      return ['status' => true,];
      }
      catch (ParseException $ex){
       return ['status' => false, 'parseMsg' => $ex->getMessage()]; 
      }
    }

    public function doBeaconEditQuery($beaconId)
    {
      # code...
      $query = new ParseQuery("Beacons");
      $query->equalTo("objectId", $beaconId);
      $result = $query->find();
      $beacon_info = [];
      for ($i = 0; $i < count($result); $i++) {
          $object = $result[$i];
          $beacon_info[] = ['beaconName' => $object->get('name'),
                           'beaconId' => $object->getObjectId(),
                           'beaconMajor' => $object->get('major'),
                           'beaconMinor' => $object->get('minor'),
                           'beaconUuid' => $object->get('uuid'),
                      ];
        }
        return $beacon_info;
    }

    public function doBeaconDelete($beaconId)
    {
      # code...
      $appId = 'BXzf9jtDNrJ4g3jcjgYMOy8tfdhnHw2DtCYikvbg';
        $restKey = 'MU3rcLDnD1jDrIgrmXs8lO58dmeSC3eZLxYIfDi9';
        $ch = curl_init();

        // set a single option...
        //curl_setopt($ch, OPTION, $value);
        // ... or an array of options
        curl_setopt_array($ch, array( 
            CURLOPT_URL => 'https://api.parse.com/1/classes/Beacons/'. $beaconId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                "X-Parse-Application-Id: " . $appId,
                "X-Parse-Master-Key: " . $restKey
                )
        ));
        $output = curl_exec($ch);
        if($output){
        return ['status' => true,];
        }
        else{
          return ['status' => false, 'parseMsg' => 'An error ocurred while we tried to delete, Please try again'];
        }
        curl_close($ch);
    }

    public function secBeacAssQuery()
    {
      $user = ParseUser::getCurrentUser();
      $roleCheck = $user->get("role");
      $roleCheck->fetch();
      $role = $roleCheck->get("name");
      $beacon_info = [];
      if($role == 'Owner'){
        return $string = '';
      }else{
        $outletCheck = $user->get("outlet");
        $outletCheck->fetch();
        $query = new ParseQuery("Beacons");
        $result = $query->equalTo("outlet", $outletCheck)
        ->notEqualTo("isSectionAssigned", true)
        ->find();

        for ($i = 0; $i < count($result); $i++) {
          $object = $result[$i];
          $beacon_info[$object->getObjectId()] = $object->get('name');
        }
        return $beacon_info;
      }
    }

    public function secOwnerBeacAssQuery($venueId)
    {
      $user = ParseUser::getCurrentUser();
      $roleCheck = $user->get("role");
      $roleCheck->fetch();
      $role = $roleCheck->get("name");
      $beacon_info = [];

      $outletCheck = new ParseObject("Outlets", $venueId);

      $query = new ParseQuery("Beacons");
      $result = $query->equalTo("outlet", $outletCheck)
      ->notEqualTo("isSectionAssigned", true)
      ->find();

      for ($i = 0; $i < count($result); $i++) {
        $object = $result[$i];
        $beacon_info[$object->getObjectId()] = $object->get('name');
      }
      return $beacon_info;
      
    }

    public function secBeacUnAssQuery()
    {
      $user = ParseUser::getCurrentUser();
      $roleCheck = $user->get("role");
      $roleCheck->fetch();
      $role = $roleCheck->get("name");
      $beacon_info = [];
      if($role == 'Owner'){
        return $string = '';
      }else{
        $outletCheck = $user->get("outlet");
        $outletCheck->fetch();
        $query = new ParseQuery("Beacons");
        $result = $query->equalTo("outlet", $outletCheck)
        ->equalTo("isSectionAssigned", true)
        ->find();

        for ($i = 0; $i < count($result); $i++) {
          $object = $result[$i];
          $beacon_info[$object->getObjectId()] = $object->get('name');
        }
        return $beacon_info;
      }
    }

    public function secOwnerBeacUnAssQuery($venueId)
    {
      $user = ParseUser::getCurrentUser();
      $roleCheck = $user->get("role");
      $roleCheck->fetch();
      $role = $roleCheck->get("name");
      $beacon_info = [];

      $outletCheck = new ParseObject("Outlets", $venueId);

      $query = new ParseQuery("Beacons");
      $query->equalTo("outlet", $outletCheck);
      $query->equalTo("isSectionAssigned", true);
      $result = $query->find();

      for ($i = 0; $i < count($result); $i++) {
        $object = $result[$i];
        $beacon_info[$object->getObjectId()] = $object->get('name');
      }
      return $beacon_info;
    }
  
}