<ul class="breadcrumb">
<li>
  <p>YOU ARE HERE</p>
</li>
<li><a href="#" class="active">Manage Venues</a> </li>
</ul>
<div class="page-title"> 
<h3>Manage <span class="semi-bold">Venues</span></h3>
</div>

<!-- BEGIN PLUGIN CSS -->
<link href="<?php echo site_url();?>assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo site_url();?>assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo site_url();?>assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url();?>assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
<!-- END PLUGIN CSS -->
<!-- BEGIN CORE CSS FRAMEWORK -->
<link href="<?php echo site_url();?>assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url();?>assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url();?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url();?>assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url();?>assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
<!-- END CORE CSS FRAMEWORK -->

<!-- BEGIN CSS TEMPLATE -->
<link href="<?php echo site_url();?>assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url();?>assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url();?>assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
<!-- END CSS TEMPLATE -->
<?php //$country['default'] = 'Country...'; ?>
<?php //echo form_dropdown('country', $country, 'default', 'id="remote" style="width:100%"'); ?>

			<?php echo show_notification(); ?>
              <span style="<?= $displayData ?>" >
              <?php echo show_valnotif(); ?>
              </span>

<div class="row-fluid">
        <div class="span12">
          <div class="grid simple ">
            <div class="grid-title">
              <h4>All <span class="semi-bold">Venues</span></h4>

              <?php if($role == OWNER){ ?><div class="tools"> <button type="button" class="btn btn-primary btn-small" data-toggle="modal" data-target="#myModal">Add A Venue <i class="fa fa-plus"></i></button> <!-- <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>  --></div>
                <?php }?>
            </div>
            <!-- Modal -->
                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <br>
                          <i class="fa fa-building-o fa-7x"></i>
                          <h4 id="myModalLabel" class="semi-bold">Add A New Venue</h4>
                          <p class="no-margin">Please fill in the Venue you wish to add </p>
                          <br>
                        </div>
                        <div class="modal-body">
                        <form id="venue_form" name="venueform" class="animated" action="<?= site_url('company/Venues') ?>" method="post">
                        Venue General Information :<br>
                        <?php 
                            foreach ($company as $value) {
                            ?>
                          <div class="row form-row">
                            <div class="col-md-8">
                              <input required type="text" class="form-control" name="venue[venuename]" id="venuename" placeholder="Venue Name">
                              <input type="hidden" value="<?= $value['companyId'] ?>" class="form-control" name="venue[companyId]" id="companyId" placeholder="Venue Name">
                            </div>
                            <div class="col-md-4">
                            <input type="text" name="venue[venuemail]" class="form-control" placeholder="Venue Mail (optional)">
                            </div>
                          </div>
                          <div class="row form-row">
                            <div class="col-md-4">
                            
                            <select required id="venueadd" name="venue[venuestate]" style="width:100%" data-url="<?php echo site_url('company/venues/get_city'); ?>">
                            <option value="">State...</option>
			                    <?php
			                    foreach ($state as $stateId => $stateName) {?>
			                    <option name="state" value="<?php echo $stateId ?>"><?php echo $stateName; ?></option>
			                    <?php }
			                     ?>
			                  </select>
                            </div>
                            <div class="col-md-3">
                              <select required id="venuecity" name="venue[venuecity]" style="width:100%">
			                    <option value="">City...</option>
			                  </select>
                            </div>
                            <div class="col-md-5">
                             <input id="cityadd" type="text" name="venue[venuecityex]" class="form-control" placeholder="City Name">
                            </div>
                          </div>
                           <div class="row form-row">
	                           <div class="col-md-6">
	                             <input required type="text" name="venue[venueaddr]" class="form-control" placeholder="Address">
	                            </div>
                           </div>
                           <?php
                            } ?>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <input name="" type="submit" class="btn btn-primary" value="Add">
                        </div>
                        </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
            <div class="grid-body ">
            <?php 
            	if (!empty($modalcompQuery)) {
              ?>
              <table class="table table-striped dataTable" id="example3" aria-describedby="example3_info" >
                <thead class="center">
                  <tr>
                    <th>Venues</th>
                    <th>Beacons</th>
                    <th>Active Campaigns</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  foreach ($modalcompQuery as $val) {
                ?>
                  <tr class="odd gradeX">
                    <td><?= $val['venueName'] ?></td>
                    <td><?= $val['beacons'] ?></td>
                    <td class="center"><?= $val['offers'] ?></td>
                    <td>
                    	<div class="btn-group"> <a class="btn btn-info dropdown-toggle btn-demo-space btn-small" data-toggle="dropdown" href="#">
                    	 Actions <span class="caret"></span> </a>
                    		<ul class="dropdown-menu">
		                      <li><a href="<?php echo site_url('company/venues/venueDetailsSum/'. $val['venueId']);?>">View Details</a></li>
                    		</ul>
                  		</div>
                    </td>
                  </tr>
                  <?php
                    }
                  ?>
                  </tbody>
                  </table>
                  <?php
                  	}else{
                  ?>
                <?php if($role == OWNER){ ?><table class="table table-striped" id="" aria-describedby="" >
                  <div class="text-center"><b>No Venues found. Please click the "Add A Venue" button above to begin.</b></div>
                </table><?php } ?>
                <?php if($role == ADMIN || $role == USER || $role ==  CAMPAIGN_MAN){ ?><table class="table table-striped" id="" aria-describedby="" >
                  <div class="text-center"><b>No Venues here. The Administrator probably hasn't added any.</b></div>
                </table><?php }?>
                  <?php 
                  	}
                  ?>
            </div>
          </div>
        </div>
      </div>
