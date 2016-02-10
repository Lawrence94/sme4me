/* Webarch Admin Dashboard 
-----------------------------------------------------------------*/ 
$(document).ready(function() {	

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

$(".lazy").lazyload({
      effect : "fadeIn"
   });

	$('#login-form').validate({

                focusInvalid: false, 
                ignore: "",
                rules: {
                    txtusername: {
                        minlength: 5,
                        required: true,
                        email: true
                    },
                    txtpassword: {
                        minlength: 8,
                        required: true
                    }
                },

                invalidHandler: function (event, validator) {
					//display error alert on form submit    
                },

                errorPlacement: function (label, element) { // render error placement for each input type   
					$('<span class="error"></span>').insertAfter(element).append(label)
                    var parent = $(element).parent('.input-with-icon');
                    parent.removeClass('success-control').addClass('error-control');  
                },

                highlight: function (element) { // hightlight error inputs
					
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    
                },

                success: function (label, element) {
					var parent = $(element).parent('.input-with-icon');
					parent.removeClass('error-control').addClass('success-control'); 
                },
			    submitHandler: function(form) {
						form.submit();
				}
            });	

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

});