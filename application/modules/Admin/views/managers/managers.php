<ul class="breadcrumb">
<li>
  <p>YOU ARE HERE</p>
</li>
<li><a href="#" class="active">User Management</a> </li>
</ul>
<div class="page-title">
<h3>User <span class="semi-bold">Management</span></h3>
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
              <h4>User <span class="semi-bold">Management</span></h4>

              <div class="tools"> <button type="button" class="btn btn-primary btn-small" data-toggle="modal" data-target="#myModal">Add A User <i class="fa fa-plus"></i></button> <!-- <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>  --></div>

            </div>
            <!-- Modal -->
                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <br>
                          <i class="fa fa-user fa-7x"></i>
                          <h4 id="myModalLabel" class="semi-bold">Add A New User</h4>
                          <p class="no-margin">Please fill in the details of the User you wish to add </p>
                          <br>
                        </div>
                        <div class="modal-body">
                        <form id="admin_form" name="adminform" class="animated" action="<?= site_url('company/Managers') ?>" method="post">
                        User Information :<br>
                          <div class="row form-row">
                            <div class="col-md-6">
                              <input required type="text" class="form-control" name="comp[adminfname]" id="adminfname" placeholder="First Name">
                            </div>
                            <div class="col-md-6">
                            <input required type="text" name="comp[adminlname]" class="form-control" placeholder="Last Name">
                            </div>
                          </div>
                          <div class="row form-row">
	                           <div class="col-md-12">
	                             <input required email="true" type="text" name="comp[adminmail]" class="form-control" placeholder="Email">
	                            </div>  
                           </div>
                          <div class="row form-row">
                          	<div class="col-md-7">
	                             <input required type="password" name="comp[adminpass]" class="form-control" placeholder="Password">
	                        </div>
                            <div class="col-md-5">
                            
                            <select required id="getperm" name="comp[adminperm]" style="width:100%" >
                            <option value="">Permission...</option>
			                    <?php
			                    foreach ($permission  as $permId => $permName) {?>
			                    	# code...
			                    <option name="country" value="<?php echo $permId ?>"><?php echo $permName; ?></option>
			                    <?php }
			                     ?>
			                  </select>
                            </div>
                          </div>
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
            	if (!empty($modaluserQuery)) {
            		
                ?>
              <table class="table table-striped dataTable" id="example3" aria-describedby="example3_info" >
                <thead class="center">
                  <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Permission</th>
                    <th>Venue</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                 <?php foreach ($modaluserQuery as $val) { ?>
                  <tr class="odd gradeX">
                    <td><?= $val['adminfName'] ?></td>
                    <td><?= $val['adminlName'] ?></td>
                    <td><?= $val['adminMail'] ?></td>
                    <td class="center"><?= $val['adminPerm'] ?></td>
                    <td class="center"><?= (empty($val['outletName'])) ? '---------------' : $val['outletName'] ;  ?></td>
                    <td>
                    	<div class="btn-group"> <a class="btn btn-info dropdown-toggle btn-demo-space btn-small" data-toggle="dropdown" href="#">
                    	 Actions <span class="caret"></span> </a>
                    		<ul class="dropdown-menu">
		                      <li><a href="<?php echo site_url('company/managers/editManager/'. $val['adminId']);?>">Edit</a></li>
                          <?php if(empty($val['outletName'])){ ?>
                            <li class="assign_outlet" id="assign_outlet" data-userid="<?= $val['adminId'] ?>" data-username="<?= $val['adminfName'] ?>" data-toggle="modal" data-target="#myModal1"><a href="#">Assign to venue</a></li>
                          <?php }else{ ?>
                          <li class="unassign_outlet" id="unassign_outlet" data-userid="<?= $val['adminId'] ?>" data-useroutlet="<?= $val['outletName'] ?>" data-toggle="modal" data-target="#myModal2"><a href="#">Unassign Venue</a></li>
                          <?php } ?>
                    		</ul>
                  		</div>
                    </td>
                  </tr>
                  <?php } ?>
                  </tbody>
                  </table>
                  <?php
                  		}
                  	else{
                  ?>
                <table class="table table-striped" id="" aria-describedby="" >
                  <div class="text-center"><b>No Users found. Please click the "Add A User" button above to begin.</b></div>
                </table>
                  <?php 
                  	}
                  ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
                  <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <br>
                          <i class="fa fa-users fa-7x"></i>
                          <h4 id="myModalLabel" class="semi-bold">Assign User</h4>
                          <p class="no-margin">Select the venue you wish to assign the user to </p>
                          <br>
                        </div>
                        <div class="modal-body">
                        <form id="userass_form" name="beaconassform" class="animated" action="<?= site_url('company/managers') ?>" method="post">
                        <br>
                          <div class="row form-row">
                            <div class="col-md-3"><b>User: </b>
                            </div>
                            <div class="col-md-3">
                            <div id="user_name"><b>User Name</b></div>
                            <input id="user_id" value="" name="userassign[userid]" type="hidden">
                            </div>
                            
                          </div>
                          <div class="row form-row">
                             <div class="col-md-12">
                              </div>  
                           </div>
                           <br>
                          <div class="row form-row">
                            <div class="col-md-3"><b>Venue: </b></div>
                            <div class="col-md-8">
                              <select required id="venueforuser" name="userassign[venue]" style="width:100%">
                          <?php
                          if(!empty($userVenue)){
                          foreach ($userVenue as $venueId => $venueName) {?>
                            # code...
                          <option name="company" value="<?php echo $venueId ?>"><?php echo $venueName; ?></option>
                          <?php }
                      }else{
                           ?>
                           <option value="">You do not have any venues added...</option>
                           <?php
                        }
                           ?>
                        </select>
                            </div>

                          </div>
                         
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <input name="" type="submit" class="btn btn-primary" value="Assign">
                        </div>
                        </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
        <!-- Modal -->
                  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <br>
                          <i class="fa fa-users fa-7x"></i>
                          <h4 id="myModalLabel" class="semi-bold">Unassign User</h4>
                          <p class="no-margin">You are about to unassign a User</p>
                          <br>
                        </div>
                        <div class="modal-body">
                        <form id="userunass_form" name="beacunassform" class="animated" action="<?= site_url('company/managers') ?>" method="post">
                        <br>
                        <div><b>Are you sure you want to unassign this user from the venue<h5 class="unassoutletname" id="unassoutletname"><b>Outlet</b></h5></b></div>
                        <input class="userunass_id" id="userunass_id" value="" name="unassignuser[userid]" type="hidden">
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <input type="submit" class="btn btn-primary" value="Unassign">
                        </div>
                        </form>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
