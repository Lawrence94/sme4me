<ul class="breadcrumb">
<li>
  <p>YOU ARE HERE</p>
</li>
<li><a href="#" class="active">Manage Sections</a> </li>
</ul>
<div class="page-title">
<h3>Manage <span class="semi-bold">Sections</span></h3>
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
              <h4>Section <span class="semi-bold">Management</span></h4>

              <?php if($role == OWNER){ ?><div class="tools"><button type="button" class="btn btn-primary btn-small" data-toggle="modal" data-target="#myModal">Add Section  
              <i class="fa fa-plus"></i></button> <!-- <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config">
              </a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>  --></div>
              <?php } ?>
            </div>
            <!-- Modal -->
                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <br>
                          <i class="fa fa-map-marker fa-7x"></i>
                          <h4 id="myModalLabel" class="semi-bold">Add A New Section</h4>
                          <p class="no-margin">Please fill in the name of the section you wish to add </p>
                          <br>
                        </div>
                        <form id="venue_form" name="venueform" class="animated" action="<?= site_url('company/Sections') ?>" method="post">
                        <div class="modal-body">
                        
                        Section Information :<br>
                        <?php 
                            foreach ($company as $value) {
                            ?>
                          <div class="row form-row">
                            <div class="col-md-12">
                              <input required type="text" class="form-control" name="section[sectionname]" id="sectionname" placeholder="Section Name">
                              <input type="hidden" value="<?= $value['companyId'] ?>" class="form-control" name="section[companyId]" id="companyId">
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
        <!-- Modal -->
            <div class="grid-body ">
            <?php 
            	if (!empty($sectionQuery)) {
                ?>
              <table class="table table-striped dataTable" id="example3" aria-describedby="example3_info" >
                <thead class="center">
                  <tr>
                    <th>Section Name</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($sectionQuery as $val) {
                  ?>
                  <tr class="odd gradeX">
                    <td><?= $val['sectionName'] ?></td>
                    <td><?= date_format($val['dateCreated'], 'd-M-Y'); ?></td>
                    <td>
                      <div class="btn-group"> <a class="btn btn-info dropdown-toggle btn-demo-space btn-small" data-toggle="dropdown" href="#">
                       Actions <span class="caret"></span> </a>
                        <ul class="dropdown-menu">
                          <?php if($role == OWNER){ ?><li class="delete_section" data-sectionid="<?= $val['sectionId'] ?>">
                          <a href="#" data-toggle="modal" data-target="#myModal3">Delete</a></li><?php }?>
                          <?php if($role == OWNER){ ?><li class="edit_section" data-sectionname="<?= $val['sectionName'] ?>" 
                          data-sectionid="<?= $val['sectionId'] ?>">
                          <a href="#" data-toggle="modal" data-target="#myModal2">Edit</a></li><?php }?>
                          <?php if($role == CAMPAIGN_MAN || $role == USER || $role == ADMIN){ ?>
                          <li class="secass_beacon" data-sectionid="<?= $val['sectionId'] ?>">
                          <a href="#" data-toggle="modal" data-target="#myModal4">Assign Beacons</a>
                          </li>
                           <li class="secunass_beacon" data-secId="<?= $val['sectionId'] ?>">
                           <a href="#" data-toggle="modal" data-target="#myModal1">Unassign Beacons</a>
                           </li> 
                          <!-- <li><a id="beacons">Unassign Beacons</a></li> -->
                          <?php }?>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  <?php }?>
                  </tbody>
                  </table>
                  <?php
                  	}else{
                  ?>
                <?php if($role == OWNER){ ?><table class="table table-striped" id="" aria-describedby="" >
                  <div class="text-center"><b>You have not added any sections. Please click the "Add Section" button above to begin.</b></div>
                </table><?php }?>
                <?php if($role == CAMPAIGN_MAN || $role == USER || $role == ADMIN){ ?><table class="table table-striped" id="" aria-describedby="" >
                  <div class="text-center"><b>There seem to be no sections here, The administrator probably hasn't added any.</b></div>
                </table><?php } ?>
                  <?php 
                  	}
                  ?>
            </div>
          </div>
        </div>
      </div>


 

                  <!-- Modal -->
                  <div class="modal fade" id="myModal1" style="display: none" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <br>
                          <i class="fa fa-th fa-7x"></i>
                          <h4 id="myModalLabel" class="semi-bold">Unassign Beacons</h4>
                          <p class="no-margin">Please select a beacon you wish to unassign from the section</p>
                          <br>
                        </div>
                        <form id="beacunass_form" name="beacunassform" class="animated" action="<?= site_url('company/sections/unassignBeacon') ?>" method="post">
                        <div class="modal-body">
                        <br>
                        <div class="row form-row">
                            <div class="col-md-2">
                              <h5><b>Beacon:-</b></h5> 
                            </div>
                            <div class="col-md-7 select0">
                                <select required name="unassbeacon[unassign]" style="width:100%">
                                  <?php if (!empty($unAssignQuery)){ 
                                      foreach ($unAssignQuery as $beacId => $beacName) {  ?>
                                        <option value="<?php echo $beacId ?>"><?php echo $beacName ?></option>
                                    <?php } }else{ ?>
                                        <option value="">You haven't assigned or no beacons in this venue.</option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" class="secUnassignBeac" name="unassbeacon[secid]">
                            </div>
                          </div>
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
                </div>
                <!-- /.modal -->

                     <!-- Modal -->
                  <div class="modal fade" id="myModal4" style="display: none" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <br>
                          <i class="fa fa-th fa-7x"></i>
                          <h4 id="myModalLabel" class="semi-bold">Assign Beacons</h4>
                          <p class="no-margin">Please select a beacon you wish to assign to the section</p>
                          <br>
                        </div>
                        <form id="beacunass_form" name="beacunassform" class="animated" action="<?= site_url('company/sections/editSection') ?>" method="post">
                          <div class="modal-body">
                          
                          <br>
                            <div class="row form-row">
                              <div class="col-md-2">
                                <h5><b>Beacon:-</b></h5> 
                              </div>
                              <div class="col-md-7 select0">
                                  <select required name="assbeacon[assign]" style="width:100%">
                                    <?php if (!empty($assignQuery)){ 
                                      foreach ($assignQuery as $beacId => $beacName) {  ?>
                                        <option value="<?= $beacId ?>"><?= $beacName ?></option>
                                    <?php } }else{ ?>
                                        <option value="">No Beacons Assigned to your venue yet.</option>
                                    <?php } ?>
                                  </select>
                                  <input type="hidden" class="secAssignBeac" name="assbeacon[secid]">
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Assign">
                          </div>
                        </form>
                      <!-- /.modal-content -->
                      </div>
                    <!-- /.modal-dialog -->
                    </div>
                  </div>
                  <!-- /.modal -->

             <!-- Modal -->
                  <div class="modal fade" id="myModal3" style="display: none" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <br>
                          <i class="fa fa-map-marker fa-7x"></i>
                          <h4 id="myModalLabel" class="semi-bold">Delete Section</h4>
                          <p class="no-margin">You are about to delete a section </p>
                          <br>
                        </div>
                        <form id="editcamp1_form" action="<?= site_url('company/Sections/editSection')?>" name="adminform" class="animated editcamp1_form" method="post">
                        <div class="modal-body">
                        
                        <br>
                          <div class="row form-row">
                            <div class="col-md-12">
                              <div class="text-center"><h5>Are you sure you want to delete this section?</h5></div>
                              <input type="hidden" id="delsec_id" name="deletesection[id]">
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" id="closure" class="btn btn-default" data-dismiss="modal">No</button>
                          <input name="" type="submit" class="btn btn-primary" value="Yes">
                        </div>
                        </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->

                  <!-- Modal -->
                  <div class="modal fade" id="myModal2" style="display: none" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <br>
                          <i class="fa fa-map-marker fa-7x"></i>
                          <h4 id="myModalLabel" class="semi-bold">Edit Section</h4>
                          <p class="no-margin">Please fill in the details of the Section </p>
                          <br>
                        </div>
                        <form id="editcamp1_form" action="<?= site_url('company/Sections/editSection')?>" name="adminform" class="animated editcamp1_form" method="post">
                        <div class="modal-body">
                        
                        <h4>Section Details :</h4> <br>
                          <div class="row form-row">
                            <div class="col-md-3">
                              <h5>Section Name:-</h5> 
                            </div>
                            <div class="col-md-8">
                            <input required type="text" id="section_name" name="sectionedit[name]" class="form-control" >
                            <input type="hidden" id="section_id" name="sectionedit[id]">
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" id="closure" class="btn btn-default" data-dismiss="modal">Close</button>
                          <input name="" type="submit" class="btn btn-primary" value="Save">
                        </div>
                        </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->

      <!-- <script>
        $('.unassModal').click(function(){
            //console.log('hello world');
            $('#unassignBeaconModal').modal('show');
        });
      </script> -->