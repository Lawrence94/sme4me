<ul class="breadcrumb">
<li>
  <p>YOU ARE HERE</p>
</li>
<li><a href="<?php echo site_url('company/venues');?>" class="active">Manage Venues</a> </li>
<li><a href="#" class="active">Venue Details</a> </li>
</ul>
<div class="page-title"> <a href="<?php echo site_url('company/venues');?>" class="active"><i class="icon-custom-left"></i></a>
<h3>Venue <span class="semi-bold">Details</span></h3>
</div>

<!-- BEGIN PLUGIN CSS -->
<link href="<?php echo site_url();?>assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo site_url();?>assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo site_url();?>assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
<style>
.datepicker{z-index:1151 !important;}
</style>
<link href="<?php echo site_url();?>assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo site_url();?>assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
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

<div class="row">
        <div class="col-md-12">
          <!-- <div class="grid simple "> -->
            <!-- <div class="grid-title"> -->
            
            <?php foreach ($modalcompEditQuery as $val) {
              ?>
              <h4><span class="semi-bold"><?= $val['venueName']; ?></span></h4>
            <?php } ?>
            <!-- </div> -->
           
            <!-- <div class="grid-body "> -->
          <ul class="nav nav-tabs" id="">
            <li><a href="<?= site_url('company/Venues/venueDetailsSum/'.$modalcompEditQuery[0]['venueId']) ?>">Summary</a></li>
            <li class="active"><a href="#tab1FollowUs">Sections</a></li>
            <li><a href="<?= site_url('company/Venues/venueDetailsBeac/'.$modalcompEditQuery[0]['venueId']) ?>">Beacons</a></li>
            <li><a href="<?= site_url('company/Venues/venueDetailsCamp/'.$modalcompEditQuery[0]['venueId']) ?>">Campaigns</a></li>
          </ul>
          <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
          <div class="tab-content">
            <div class="tab-pane active" id="tab1FollowUs">
              <div class="row">
                <div class="col-md-12">
                <?php if($role == OWNER){ ?><div class="tools"> <button type="button" class="btn btn-primary btn-small" data-toggle="modal" data-target="#myModal">Add A Section <i class="fa fa-plus"></i></button></div>
                <?php }?>
                <br>
                <?php if (!empty($sectionQuery)) {
                  ?>
                  <table class="table table-striped dataTable" id="example3" aria-describedby="example3_info" >
                <thead class="center">
                  <tr>
                    <th>Name</th>
                    <th>Beacons</th>
                    <th>Active Campaigns</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($sectionQuery as $val) {
                  ?>
                  <tr class="odd gradeX">
                    <td><?= $val['sectionName'] ?></td>
                    <td><?= $val['beacons'] ?></td>
                    <td class="center"><?= $val['campaigns'] ?></td>
                    <td>
                      <div class="btn-group"> <a class="btn btn-info dropdown-toggle btn-demo-space btn-small" data-toggle="dropdown" href="#">
                       Actions <span class="caret"></span> </a>
                        <ul class="dropdown-menu">
                           <li class="secass_beacon" data-sectionid="<?= $val['sectionId'] ?>">
                            <a href="#" data-toggle="modal" data-target="#myModal5">Assign Beacons</a>
                           </li>
                           <li class="secunass_beacon" data-secId="<?= $val['sectionId'] ?>">
                            <a href="#" data-toggle="modal" data-target="#myModal4">Unassign Beacons</a>
                           </li> 
                        </ul>
                      </div>
                    </td>
                  </tr>
                  <?php }?>
                  </tbody>
                  </table>
                  <?php 
                   }else{ ?>
                   <table class="table table-striped">
                <div class="text-center"><b>No Sections found. Please click the "Add A Section" button above to begin.</b></div>
                  </table>
                  <?php } ?>
                </div>
              </div>
            </div>
        </div>
      </div>


      <!-- Modal -->
      <?php foreach ($modalcompEditQuery as $val) {
                ?>
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
                        <div class="modal-body">
                        <form id="venue_form" name="venueform" class="animated" action="<?= site_url('company/Venues') ?>" method="post">
                        Section Information :<br>
                        <?php 
                            foreach ($company as $value) {
                            ?>
                          <div class="row form-row">
                            <div class="col-md-12">
                              <input required type="text" class="form-control" name="section[sectionname]" id="sectionname" placeholder="Section Name">
                              <input type="hidden" value="<?= $value['companyId'] ?>" class="form-control" name="section[companyId]" id="companyId">
                              <input type="hidden" value="<?= $val['venueId'] ?>" class="form-control" name="section[venueId]" id="venueId">
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
                  <?php } ?>
                  <!-- /.modal -->

                  <!-- Modal -->
                  <div class="modal fade" id="myModal4" style="display: none" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <form id="beacunass_form" name="beacunassform" class="animated" action="<?= site_url('company/venues/venueDetailsSec/'. $modalcompEditQuery[0]['venueId'] ) ?>" method="post">
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
                  <div class="modal fade" id="myModal5" style="display: none" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <form id="beacunass_form" name="beacunassform" class="animated" action="<?= site_url('company/venues/venueDetailsSec/'. $modalcompEditQuery[0]['venueId'] ) ?>" method="post">
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
