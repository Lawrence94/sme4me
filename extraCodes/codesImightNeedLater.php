<?php

      //   $appId = 'BXzf9jtDNrJ4g3jcjgYMOy8tfdhnHw2DtCYikvbg';
      //   $restKey = 'MU3rcLDnD1jDrIgrmXs8lO58dmeSC3eZLxYIfDi9';
      //   //$roling = '{"role":{"__type": "Pointer","className": "_Role","objectId": '.'"'.$adminPerm.'"'.'}}';
      //   //$roling = 'where={"role":{"__type": "Pointer","className": "_Role","objectId": '.'"'.$adminPerm.'"'.'}}';
      //   $encode = urlencode('keys=outletName,email,address,city');
       
      //   //$data = json_encode($updatedDataArray);
       
      //   //$data = '{"firstName":"$adminfName","lastName":"$adminlName","email":"$adminMail","username":"$adminMail","password":"$adminPass","role":"415-369-6201"}';
         
      //   $ch = curl_init();

      //   // set a single option...
      //   // '{"phone":"415-369-6201"}'
      //   //curl_setopt($ch, OPTION, $value);
      //   // ... or an array of options
      //   curl_setopt_array($ch, array( 
      //       CURLOPT_URL => 'https://api.parse.com/1/classes/Outlets/'.$venueId.'/'.$encode,
      //       CURLOPT_RETURNTRANSFER => true,
      //       CURLOPT_HTTPGET => true,
      //       CURLOPT_SSL_VERIFYPEER => false,
      //       CURLOPT_HTTPHEADER => array(
      //           "X-Parse-Application-Id: " . $appId,
      //           "X-Parse-Master-Key: " . $restKey,
      //           "Content-Type: application/json")
      //   ));

      //   // free
      // $output = curl_exec($ch);
      // $output_array = json_decode($output);

      // $encode1 = urlencode('keys=Cities,state');
      // curl_setopt_array($ch, array( 
      //       CURLOPT_URL => 'https://api.parse.com/1/classes/City/'.$venueId.'/'.$encode1,
      //       CURLOPT_RETURNTRANSFER => true,
      //       CURLOPT_HTTPGET => true,
      //       CURLOPT_SSL_VERIFYPEER => false,
      //       CURLOPT_HTTPHEADER => array(
      //           "X-Parse-Application-Id: " . $appId,
      //           "X-Parse-Master-Key: " . $restKey,
      //           "Content-Type: application/json")
      //   ));

      //   // free
      // $output1 = curl_exec($ch);
      // $output1_array = json_decode($output1);

      // var_dump($output1_array);
      // exit;
      // curl_close($ch);

// $appId = 'BXzf9jtDNrJ4g3jcjgYMOy8tfdhnHw2DtCYikvbg';
//         $restKey = 'MU3rcLDnD1jDrIgrmXs8lO58dmeSC3eZLxYIfDi9';
//         $data = '{"users": {"__op": "AddRelation","objects": [{"__type": "Pointer","className": "_User","objectId": "apCFlgW5Kq"}]}}';
//         $ch = curl_init();
//         // set a single option...
//         //curl_setopt($ch, OPTION, $value);
//         // ... or an array of options
//         curl_setopt_array($ch, array( 
//             CURLOPT_URL => 'https://api.parse.com/1/roles/eJIvURfcAv',
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_CUSTOMREQUEST => "PUT",
//             CURLOPT_POSTFIELDS => $data,
//             CURLOPT_SSL_VERIFYPEER => false,
//             CURLOPT_HTTPHEADER => array(
//                 "X-Parse-Application-Id: " . $appId,
//                 "X-Parse-Master-Key: " . $restKey,
//                 "Content-Type: application/json")
//         ));

//         // free
//       $output = curl_exec($ch);
//       var_dump($output);     
//       curl_close($ch);
//        exit;


  // $userDetails = ['firstName',
      //        'lastName',
      //        'username'
      //          ];
      // $this->session->unset_userdata($userDetails);
          

      // This helps to create a user and relate that user to a role
      // $user = new ParseUser();
      // $user->set("username", "agbani92@gmail.com");
      // $user->set("password", "milimas5");
      // $user->set("email", "agbani92@gmail.com");

      // // other fields can be set just like with ParseObject
      // $user->set("firstName", "Lawrence");
      // $user->set("lastName", "Agbani");

      // try {
      //   $user->signUp();
      //   // Hooray! Let them use the app now.
      // } catch (ParseException $ex) {
      //   // Show the error message somewhere and let the user try again.
      //   echo "Error: " . $ex->getCode() . " " . $ex->getMessage();
      // }
      // $usersToAddToRole = [$user];
      // $roleACL = new ParseACL();
      // $roleACL->setPublicReadAccess(true);
      // $role = ParseRole::createRole("Super Administrator", $roleACL);
      // for ($i = 0; $i < count($usersToAddToRole); $i++) {
      //   $role->getUsers()->add($usersToAddToRole[$i]);
      // }

      // $user->set("role", $role);
      // $user->save();
      // 
      // 
      //$superRole = ''; 
      //
      // This helps to relate roles...
      // $role = new ParseObject("_Role");
      // $query = new ParseQuery("_Role");
      // $role = $query->get('JcrHSQPDu0');

      // $roleACL = new ParseACL();
     //    $roleACL->setPublicReadAccess(true);

     //    $adminRole = ParseRole::createRole("Administrator", $roleACL);
     //    $adminRole->getRoles()->add($role);
     //    $adminRole->save();

   

 // $role = new ParseObject("_Role");
             // $query = new ParseQuery("_Role");
             // $role = $query->get('JcrHSQPDu0');

             // $roleACL = new ParseACL();
          //    $roleACL->setPublicReadAccess(true);

          //    $adminRole = ParseRole::createRole("Owner", $roleACL);
          //    $adminRole->getRoles()->add($role);
          //    $adminRole->save();

          //    $rolesToAdd = [$adminRole];

          //    $adminRole1 = ParseRole::createRole("Admin", $roleACL);
          //    for ($i = 0; $i < count($rolesToAdd); $i++) {
             //   $adminRole1->getROles()->add($rolesToAdd[$i]);
             // }
          //    $adminRole1->save();

          //    $rolesToAdd1 = [$adminRole, $adminRole1];

          //    $adminRole2 = ParseRole::createRole("Campaign Manager", $roleACL);
          //    for ($i = 0; $i < count($rolesToAdd1); $i++) {
             //   $adminRole2->getROles()->add($rolesToAdd1[$i]);
             // }
          //    $adminRole2->save();

          //    $rolesToAdd2 = [$adminRole, $adminRole1, $adminRole2];

          //    $adminRole3 = ParseRole::createRole("User", $roleACL);
          //    for ($i = 0; $i < count($rolesToAdd2); $i++) {
             //   $adminRole3->getROles()->add($rolesToAdd2[$i]);
             // }
          //    $adminRole3->save();


//This is for saving states with respect to countries.
            // $states = new ParseObject("States");

            // //$states->set("name", 1337);
            // // $states->set("stateName", "Lagos");
            // // $states->set("stateName", "Nasarawa");
            // // $states->set("stateName", "Niger");
            // // $states->set("stateName", "Ogun");
            // // $states->set("stateName", "Ondo");
            // // $states->set("stateName", "Osun");
            // // $states->set("stateName", "Oyo");
            // // $states->set("stateName", "Plateau");
            // // $states->set("stateName", "Rivers");
            // // $states->set("stateName", "Sokoto");
            // // $states->set("stateName", "Taraba");
            // // $states->set("stateName", "Yobe");
            // // $states->set("stateName", "Zamfara");
            // //$states->set("cheatMode", false);

            // $country = new ParseObject("Country");
            // $query = new ParseQuery("Country");
            // //$country->set("score", 1337);
            // $country = $query->get('vTAjwOO7cQ');
            // //$country->set("cheatMode", false);
            // $states->set("country", $country);

            // try {
            //   $states->save();
            //   //echo 'New object created with objectId: ' . $gameScore->getObjectId();
            // } catch (ParseException $ex) {  
            //   // Execute any logic that should take place if the save fails.
            //   // error is a ParseException object with an error code and message.
            //   //echo 'Failed to create new object, with error message: ' . $ex->getMessage();
            // }
            // 



    // $('#login_toggle').click(function(){
    //     $('#login-form').show();
    //     $('#frm_register').hide();
    //     $('#register_toggle').show();
    //     $('#login_toggle').hide();
    // })
    // $('#register_toggle').click(function(){
    //     $('#login-form').hide();
    //     $('#frm_register').show();
    //     $('#register_toggle').hide();
    //     $('#login_toggle').show();
    // })

     // $('#frm_register').validate({

            //     focusInvalid: false, 
            //     ignore: "",
            //     rules: {
            //         reg_username: {
            //             minlength: 2,
            //             required: true,
            //         },
            //         reg_pass: {
            //             minlength: 8,
            //             required: true,
            //         },
            //         reg_mail: {
            //             minlength: 5,
            //             required: true
            //         },
            //         reg_first_Name: {
            //             minlength: 2,
            //             required: true,
            //         },
            //         reg_last_Name: {
            //             minlength: 2,
            //             required: true
            //         },
            //         reg_email: {
            //             minlength: 5,
            //             required: true,
            //         }
            //     },

            //     invalidHandler: function (event, validator) {
            //         //display error alert on form submit    
            //     },

            //     errorPlacement: function (label, element) { // render error placement for each input type   
            //         $('<span class="error"></span>').insertAfter(element).append(label)
            //         var parent = $(element).parent('.input-with-icon');
            //         parent.removeClass('success-control').addClass('error-control');  
            //     },

            //     highlight: function (element) { // hightlight error inputs
                    
            //     },

            //     unhighlight: function (element) { // revert the change done by hightlight
                    
            //     },

            //     success: function (label, element) {
            //         var parent = $(element).parent('.input-with-icon');
            //         parent.removeClass('error-control').addClass('success-control'); 
            //     },
            //     submitHandler: function(form) {
            //             form.submit();
            //     }
            // }); 


