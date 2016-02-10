<?php

/*CompanyQuery_model
This model gets company details necessary for the all_company view
using the doQuery() function.
Database used all through this project is Parse.com's backend as a service.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

use Parse\ParseUser;
use Parse\ParseException;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParseRole;
use Parse\ParseObject;


class Companyquery_model extends CI_Model {

	public function __construct()
        {
                parent::__construct();
        }

    public function doQuery(){
      $currentUser = ParseUser::getCurrentUser();
      $companyQuery = new ParseQuery("Companies");
      $companyQuery->equalTo("owner", $currentUser);
      $companyQuery->ascending("name");
      $compResults = $companyQuery->first();
      $objectId = $compResults->getObjectId();
      $company = new ParseObject("Companies", $objectId);
      $outletQuery = new ParseQuery("Outlets");
      $outletQuery->equalTo("company", $company);
      $results = $outletQuery->find();
      $outletInfo = [];
      for ($i = 0; $i < count($results); $i++) {
          $object = $results[$i];
          $outlet = new ParseObject("Outlets", $object->getObjectId());
          $offerQuery = new ParseQuery("OutletOffers");
          $offerQuery->equalTo("outlet", $outlet);
          $offerQuery->equalTo("offerStatus", "live");
          $beacQuery = new ParseQuery("Beacons");
          $beacQuery->equalTo("outlet", $outlet);
          $beacresults = $beacQuery->count();
          $offerResults = $offerQuery->count();
          $outletInfo[] = ['venueName' => $object->get('outletName'),
                            'beacons' => $beacresults,
                            'offers' => $offerResults,
                            'venueId' => $object->getObjectId(),
                        ];
        }                
      return $outletInfo;
    }

    public function doUserQuery(){
      $currentUser = ParseUser::getCurrentUser();
      $userQuery = ParseUser::query();
      $userQuery->equalTo("creator", $currentUser);
      $userResults = $userQuery->find();
      $userInfo = [];

      for ($i = 0; $i < count($userResults); $i++) {
          $object = $userResults[$i];
          $isOutletAssigned = $object->get('isOutletAssigned');
          $outletCheck = $object->get('outlet');
          $outletName = "";
          if($isOutletAssigned){
          $outletCheck->fetch();
          $outletName = $outletCheck->get("outletName");
          }
          
          $roleCheck = $object->get('role');
          $roleCheck->fetch();
          $roleName = $roleCheck->get("name");
          $userInfo[] = [   'adminfName' => $object->get('firstName'),
                            'adminlName' => $object->get('lastName'),
                            'adminMail' => $object->get('email'),
                            'adminId' => $object->getObjectId(),
                            'adminPerm' => $roleName,
                            'outletName' => $outletName,
                        ];
                
      }
      return $userInfo;
    }

    public function doBeaconQuery(){
      $query = new ParseQuery("Beacons");
      $results = $query->find();
      $beaconInfo = [];

      for ($i = 0; $i < count($results); $i++) {
          $object = $results[$i];
          $beacCheck = $object->get('company');
          $isAssigned = $object->get('isAssigned');
          $compName = "";
          if($isAssigned){
          $beacCheck->fetch();
          $compName = $beacCheck->get("name");
          }
          $beaconInfo[] = ['beaconName' => $object->get('name'),
                            'beaconUuid' => $object->get('uuid'),
                            'beaconMajor' => $object->get('major'),
                            'beaconMinor' => $object->get('minor'),
                            'beaconId' => $object->getObjectId(),
                            'company' => $compName,
                        ];
                
      }
      return $beaconInfo;
    }

    public function doBeacCompQuery(){

      $companyQuery = new ParseQuery("Companies");
      $companyQuery->ascending("name");
      $compResults = $companyQuery->find();
      $companyInfo = [];

      for ($i = 0; $i < count($compResults); $i++) {
          $object = $compResults[$i];
          $companyInfo[$object->getObjectId()] = $object->get('name');
                
      }
      return $companyInfo;
    }

    public function doVenueQuery()
    {
      # code...
      $user = ParseUser::getCurrentUser();
      $query = new ParseQuery("Companies");
      $query->equalTo("owner", $user);
      $company = $query->first();

      $outletQuery = new ParseQuery("Outlets");
      $outletQuery->equalTo("company", $company);
      $results = $outletQuery->find();
      $venueInfo = [];
      for ($i = 0; $i < count($results); $i++) {
        $object = $results[$i];
        $venueInfo[$object->getObjectId()] = $object->get('outletName');
      }
      return $venueInfo;
    }

    public function doSectionQuery()
    {
      # code...
      $user = ParseUser::getCurrentUser();
      $ownerCheck = $user->get("creator");
      $ownerCheck->fetch();
      $query = new ParseQuery("Companies");
      $query->equalTo("owner", $ownerCheck);
      $company = $query->first();

      $outletQuery = new ParseQuery("Sections");
      $outletQuery->equalTo("company", $company);
      $results = $outletQuery->find();
      $venueInfo = [];
      for ($i = 0; $i < count($results); $i++) {
        $object = $results[$i];
        $venueInfo[$object->getObjectId()] = $object->get('name');
      }
      return $venueInfo;
    }

    public function doCreateCampaignSectionQuery()
    {
      # code...
      $user = ParseUser::getCurrentUser();

      $ownerCheck = $user->get("creator");
      $ownerCheck->fetch();

      $outletCheck = $user->get("outlet");
      $outletCheck->fetch();
      $city = $outletCheck->get("city");
      $city->fetch();

      $query = new ParseQuery("Companies");
      $query->equalTo("owner", $ownerCheck);
      $company = $query->first();

      $outletQuery = new ParseQuery("Sections");
      $outletQuery->equalTo("company", $company);
      $results = $outletQuery->find();
      $venueInfo = [];
      for ($i = 0; $i < count($results); $i++) {
        $object = $results[$i];
        $venueInfo[$object->getObjectId()] = $object->get('name');
      }
      return $venueInfo;
    }

    public function doSectionQuery1()
    {
      # code...
      $user = ParseUser::getCurrentUser();
      $query = new ParseQuery("Companies");
      $query->equalTo("owner", $user);
      $company = $query->first();

      $outletQuery = new ParseQuery("Sections");
      $outletQuery->equalTo("company", $company);
      $results = $outletQuery->find();
      $venueInfo = [];
      for ($i = 0; $i < count($results); $i++) {
        $object = $results[$i];
        $venueInfo[$object->getObjectId()] = $object->get('name');
      }
      return $venueInfo;
    }

    public function doEditCampaignQuery($id)
    {
      $query = new ParseQuery("OutletOffers");
      $query->equalTo("objectId", $id);
      $results = $query->first();

      $campaignInfo = [];
      //$object = $results[$i];
      $campaignInfo[] = ['title' => $results->get('offerTitle'),
                         'type' => $results->get('offerType'),
                         'startDate' => $results->get('startDate'),
                         'endDate' => $results->get('expiryDate'),
                         'desc' => $results->get('offerDescription'),
                         'points' => $results->get('offerPoints'),
                         'userAlloc' => $results->get('userAllocation'),
                         'allocated' => $results->get('pointAllocated'),
                         'balance' => $results->get('pointBalance'),
                         'age' => $results->get('age'),
                         'gender' => $results->get('gender'),
                         'id' => $results->getObjectId(),
                        ];
      return $campaignInfo;
    }
	
}