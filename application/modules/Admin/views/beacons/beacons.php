<ul class="breadcrumb">
<li>
  <p>YOU ARE HERE</p>
</li>
<li><a href="#" class="active">Manage Beacons</a> </li>
</ul>
<div class="page-title">
<h3>Manage <span class="semi-bold">Beacons</span></h3>
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
              <h4>Beacon <span class="semi-bold">Management</span></h4>

              <div class="tools"><button type="button" class="btn btn-primary btn-small" data-toggle="modal" data-target="#myModal">Create Campaign <i class="fa fa-plus"></i></button> <!-- <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>  --></div>

            </div>
            <!-- Modal -->
                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <br>
                          <i class="fa fa-th fa-7x"></i>
                          <h4 id="myModalLabel" class="semi-bold">Add A New Beacon</h4>
                          <p class="no-margin">Please fill in the details of the Beacon you wish to add </p>
                          <br>
                        </div>
                        <div class="modal-body">
                        <form id="admin_form" name="adminform" class="animated" action="<?= site_url('admin/Beacons') ?>" method="post">
                        Beacon Information :<br>
                          <div class="row form-row">
                            <div class="col-md-6">
                              <input required type="text" class="form-control" name="createbeac[beacname]" id="beacname" placeholder="Beacon Name">
                            </div>
                            <div class="col-md-6">
                            <input required type="text" name="createbeac[beacmajor]" class="form-control" placeholder="Beacon Major">
                            </div>
                          </div>
                          <div class="row form-row">
	                           <div class="col-md-12">
	                             <input required type="text" name="createbeac[beacuuid]" class="form-control" placeholder="Beacon UUID">
	                            </div>  
                           </div>
                          <div class="row form-row">
                          	<div class="col-md-7">
	                             <input required type="text" name="createbeac[beacminor]" class="form-control" placeholder="Beacon Minor">
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
            	if (!empty($modalBeaconQuery)) {
            		foreach ($modalBeaconQuery as $val) {
                ?>
              <table class="table table-striped dataTable" id="example3" aria-describedby="example3_info" >
                <thead class="center">
                  <tr>
                    <th>Beacon UUID</th>
                    <th>Beacon Name</th>
                    <th>Beacon Major</th>
                    <th>Beacon Minor</th>
                    <th>Assigned Company</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="odd gradeX">
                    <td><?= $val['beaconUuid'] ?></td>
                    <td><?= $val['beaconName'] ?></td>
                    <td><?= $val['beaconMajor'] ?></td>
                    <td class="center"><?= $val['beaconMinor'] ?></td>
                    <td class="center"><?= (empty($val['company'])) ? '---------------' : $val['company'] ;  ?></td>
                    <td>
                    	<div class="btn-group"> <a class="btn btn-info dropdown-toggle btn-demo-space btn-small" data-toggle="dropdown" href="#">
                    	 Actions <span class="caret"></span> </a>
                    		<ul class="dropdown-menu">
		                      <li><a href="<?php echo site_url('admin/beacons/editBeacon/'. $val['beaconId']);?>">Edit</a></li>
		                      <li class="divider"></li>
		                      <?php if(empty($val['company'])){ ?>
		                      	<li id="assign_company" data-beacid="<?= $val['beaconId'] ?>" data-beacname="<?= $val['beaconName'] ?>" data-toggle="modal" data-target="#myModal1"><a href="#">Assign to Company</a></li>
		                      <?php }else{ ?>
		                      <li id="unassign_company" data-beacid="<?= $val['beaconId'] ?>" data-beacomp="<?= $val['company'] ?>" data-toggle="modal" data-target="#myModal2"><a href="#">Unassign Company</a></li>
		                      <?php } ?>
                    		</ul>
                  		</div>
                    </td>
                  </tr>
                  </tbody>
                  </table>
                  <?php
                  		}
                  	}else{
                  ?>
                <?php if($role == SUPER_ADMIN){ ?><table class="table table-striped" id="" aria-describedby="" >
                  <div class="text-center"><b>You have not added any beacons. Please click the "Add A Beacon" button above to begin.</b></div>
                </table><?php }?>
                <?php if($role == ADMIN){ ?><table class="table table-striped" id="" aria-describedby="" >
                  <div class="text-center"><b>There seem to be no beacons here, The administrator probably hasn't added any.</b></div>
                </table><?php } ?>
                  <?php 
                  	}
                  ?>
            </div>
            <!-- Modal -->
                  <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <br>
                          <i class="fa fa-th fa-7x"></i>
                          <h4 id="myModalLabel" class="semi-bold">Assign Beacons</h4>
                          <p class="no-margin">Select the company you wish to assign the beacon to </p>
                          <br>
                        </div>
                        <div class="modal-body">
                        <form id="beaconass_form" name="beaconassform" class="animated" action="<?= site_url('admin/Beacons') ?>" method="post">
                        <br>
                          <div class="row form-row">
                            <div class="col-md-3"><b>Beacon: </b>
                            </div>
                            <div class="col-md-3">
                            <div id="beac_name"><b>Beacon Name</b></div>
                            <input id="beac_id" value="" name="beacassign[beacid]" type="hidden">
                            </div>
                            
                          </div>
                          <div class="row form-row">
	                           <div class="col-md-12">
	                            </div>  
                           </div>
                           <br>
	                        <div class="row form-row">
	                        	<div class="col-md-3"><b>Company: </b></div>
	                        	<div class="col-md-8">
	                        		<select required id="companyforbeacon" name="beacassign[company]" style="width:100%">
			                    <?php
			                    if(!empty($beacComp)){
			                    foreach ($beacComp as $companyId => $companyName) {?>
			                    	# code...
			                    <option name="company" value="<?php echo $companyId ?>"><?php echo $companyName; ?></option>
			                    <?php }
			                }else{
			                     ?>
			                     <option value="">You do not have any companies added...</option>
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
                          <i class="fa fa-th fa-7x"></i>
                          <h4 id="myModalLabel" class="semi-bold">Unassign Beacons</h4>
                          <p class="no-margin">You are about to unassign a Beacon</p>
                          <br>
                        </div>
                        <div class="modal-body">
                        <form id="beacunass_form" name="beacunassform" class="animated" action="<?= site_url('admin/Beacons') ?>" method="post">
                        <br>
                        <div><b>Are you sure you want to unassign this beacon from the company<h5 id="unasscompname"><b>Company</b></h5></b></div>
                        <input id="beacunass_id" value="" name="unassignbeac[beacid]" type="hidden">
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
          </div>
        </div>
      </div>