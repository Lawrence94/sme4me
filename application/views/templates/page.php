<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo $header;
?>
<div class="wrapper">
	<?php echo $menu_header;?>
    <?php echo $sidebar;?>
    <!-- BEGIN PAGE CONTAINER-->
    <div class="content-wrapper">
    	<div class="content">
    		<?php echo $content;?>
    	</div>
        
    </div>
</div>
<?php
echo $footer;