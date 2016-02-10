/* Webarch Admin Dashboard 
-----------------------------------------------------------------*/ 
$(document).ready(function() {	

	 $('#companyedit_form').validate();
     $('#company_form').validate();
     $('#companyeditowner_form').validate();
     $('#admin_form').validate();
     $('#beaconass_form').validate();
     $('#cityadd').hide();
     $('#selectorwords').hide();

     $('#venue_form').validate();
     $('#venue_form1').validate();
     $('#venue_form2').validate();

             
        $('#remote').change(function(event) {
            var country_id = $(this).val();
            if (country_id == 0 ){
                $('#remote2').html('<option>States...</option>');
            }
            else{
            var url = $(this).data('url')+'/'+country_id;
            $('#remote2').html('<option>Loading...</option>');
            $.ajax({
                url: url,
                type: 'GET'
            })
            .done(function(data) {
                $('#remote2').html('');
                if(JSON.stringify(data).indexOf('none') > -1){  
                    $('#remote2').html('<option>Empty...</option>');
                }else{
                sdata = jQuery.parseJSON(data);
                if(typeof sdata =='object'){
                    var options;

                    $.each(sdata, function(index, val) {
                        //console.log(sdata);
                        options+="<option value='"+ index +"'>"+ val +"</option>";                     
                    });
                    $('#remote2').append(options);
                }
                else{
                    if(sdata ===false)
                      {
                         //the response was a string "false", parseJSON will convert it to boolean false
                         $('#remote2').html('<option>Empty...</option>');
                      }
                      else
                      {
                        //the response was something else
                        $('#remote2').html('<option>Empty...</option>');

                      }
                }
            }})
            .fail(function(sdata) {
                console.log(sdata);
            });
            }
        });

        $('#selector').change(function(event) {
            var section_id = $(this).val();
            if (section_id == 0 ){
                $('#selectorwords').hide();
            }
            else{
                var url = $(this).data('url')+'/'+section_id;
                $('#selectorwords').html('Checking section beacon status...');
                $.ajax({
                    url: url,
                    type: 'GET'
                })
                .done(function(data) {
                    $('#selectorwords').hide();
                    if(JSON.stringify(data).indexOf('none') > -1){ 
                        $('#selectorwords').show(); 
                        $('#selectorwords').html('<h5 style="color: #f51142">There are no beacons in this section.</h5>');
                    }else{
                    sdata = jQuery.parseJSON(data);
                    if(typeof sdata =='object'){
                        var options;

                        $.each(sdata, function(index, val) {
                            //console.log(sdata);
                            $('#selectorwords').show();
                            $('#selectorwords').html('<h5 style="color: #45ef51">There are/is '+val+' beacon(s) on this section</h5>');
                        });
                    }
                    else{
                        if(sdata ===false)
                          {
                             //the response was a string "false", parseJSON will convert it to boolean false
                             $('#selectorwords').show();
                             $('#selectorwords').html('There are no beacons on this section.');
                          }
                          else
                          {
                            //the response was something else
                            $('#selectorwords').show();
                            $('#selectorwords').html('There are no beacons on this section.');

                          }
                    }
                }})
                .fail(function(sdata) {
                    console.log(sdata);
                });
            }
        });

        
        $('#venueadd').change(function(event) {
            var state_id = $(this).val();
            if (state_id == 0 ){
                $('#venuecity').html('<option>City...</option>');
            }
            else{
            var url = $(this).data('url')+'/'+state_id;
            $('#venuecity').html('<option>Loading...</option>');
            $.ajax({
                url: url,
                type: 'GET'
            })
            .done(function(data) {
                $('#venuecity').html('');
                if(JSON.stringify(data).indexOf('none') > -1){  
                    //$('#venuecity').html('<option>Empty...</option>');
                    options += "<option value='others'>"+ 'Other...' +"</option>";
                    //$('#venuecity').html('<option value='others'>Others</option>');
                    $('#venuecity').append(options);
                }else{
                    sdata = jQuery.parseJSON(data);
                    if(typeof sdata =='object'){
                        var options;

                        $.each(sdata, function(index, val) {
                            //console.log(sdata);
                            options += "<option value='"+ index +"'>"+ val +"</option>";
                            options2 = "<option value='others'>"+ 'Other...' +"</option>";                     
                        });
                        $('#venuecity').append(options);
                        $('#venuecity').append(options2);
                    }
                    else{
                        if(sdata ===false)
                          {
                             //the response was a string "false", parseJSON will convert it to boolean false
                             $('#venuecity').html('<option>Empty...</option>');
                          }
                          else
                          {
                            //the response was something else
                            $('#venuecity').html('<option>Empty...</option>');

                          }
                        }
                }if($('#venuecity :selected').val() == 'others'){
                    //alert($('#venuecity :selected').text());
                    $('#cityadd').show();
                }
                else{
                    $('#cityadd').hide();
                }
            })
            .fail(function(sdata) {
                console.log(sdata);
            });
            }
            
        });

        $('#venuecity').change(function(event) {
            var value = $(this).val();
            if(value == "others"){
                $('#cityadd').show();
            }
            else{
                $('#cityadd').hide();
            }
        });

        $('#sandbox-advance').datepicker({
            format: "yyyy-mm-dd",
            startView: 0,
            autoclose: true,
            todayHighlight: true
         });

        $('#sandbox-advance1').datepicker({
            format: "yyyy-mm-dd",
            startView: 0,
            autoclose: true,
            todayHighlight: true
         });


        $("#assign_company").click(function(){
            var beaconId = $(this).data('beacid');
            var beaconName = $(this).data('beacname');
                 $("#beac_name").html("<b>"+beaconName+"</b>");
                 $("#beac_id").val(beaconId);
            });

        $("#unassign_company").click(function(){
            var beaconId = $(this).data('beacid');
            var beaconName = $(this).data('beacomp');
                 $("#unasscompname").html("<b>"+beaconName+"?"+"</b>");
                 $("#beacunass_id").val(beaconId);
            });

        $(".assign_outlet").click(function(){
            var userId = $(this).data('userid');
            var userName = $(this).data('username');
                 $("#user_name").html("<b>"+userName+"</b>");
                 $("#user_id").val(userId);
            });

        $(".unassign_outlet").click(function(){
            var userId = $(this).data('userid');
            var userOutlet = $(this).data('useroutlet');
                 $("#unassoutletname").html("<b>"+userOutlet+"?"+"</b>");
                 $("#userunass_id").val(userId);
            });

        // $('.campaign_details').click(function(){
        //     var offerId = $(this).data('id');
        //     var offerTitle = $(this).data('title');
        //     var offerType = $(this).data('type');
        //     var offerPoints = $(this).data('points');
        //     // var offerStatus = $(this).data('status');
        //     var options;
        //     var options2;
        //          $("#title_offer").html("<b>"+offerTitle+"</b>");
        //          $("#title_offers").val(offerTitle);
        //          $("#points_offers").val(offerPoints);
        //          $("#type_offers").val(offerType);
        //          $("#id_offers").val(offerId);
        //          $("#delCamp").attr('href', "Campaigns/deleteCampaign/"+offerId);
        //          $(".editcamp_form").attr("action", "Campaigns/editCampaign/"+offerId+"");
                 
        //          // if (offerStatus == "live") {
        //          //     $(".select0 select").val("live");
        //          // }else{
        //          //     $(".select0 select").val("draft");
        //          // }

        //     });

        $('.campaign1_details').click(function(){
            var offerId = $(this).data('id');
            var offerTitle = $(this).data('title');
            var offerType = $(this).data('type');
            var offerPoints = $(this).data('points');
            var offerStatus = $(this).data('status');
            var options;
            var options2;
                 $("#title_offer").html("<b>"+offerTitle+"</b>");
                 $("#title_offers").val(offerTitle);
                 $("#points_offers").val(offerPoints);
                 $("#type_offers").val(offerType);
                 $("#id_offers").val(offerId);
                 
                 if (offerStatus == "live") {
                     $(".select0 select").val("live");
                 }else{
                     $(".select0 select").val("draft");
                 }

            });

        $('.edit_section').click(function(){
            var sectionId = $(this).data('sectionid');
            var sectionName = $(this).data('sectionname');
            
                 $("#section_name").val(sectionName);
                 $("#section_id").val(sectionId);
               
            });

        $('.delete_section').click(function(){
            var sectionId = $(this).data('sectionid');
            
                 $("#delsec_id").val(sectionId);
               
            });

        $('.secass_beacon').click(function(){
            var sectionId = $(this).data('sectionid');
                 $('.secAssignBeac').val(sectionId);
               
            });

        $('.secunass_beacon').click(function(){
            var sectionId = $(this).data('secId');
            
                 $(".secUnassignBeac").val(sectionId);
               
            });
      
        
});