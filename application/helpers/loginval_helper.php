<?php  
/**
 * Login validation helper
 * display error, form validation errors
 */

if(!function_exists('show_valnotif')){

	function show_valnotif(){
		//this is in charge of showing form validation errors
		//it is being called on the login view in a <span> tag
		
    	 ?>

			<div class="alert alert-danger fade in">
			    <button type="button" class="close" data-dismiss="alert"></button>
			    <?php echo validation_errors(); ?>
			</div>
		<?php	
		
	}
}

