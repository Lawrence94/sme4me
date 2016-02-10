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
            <li><a href="<?= site_url('company/Venues/venueDetailsSec/'.$modalcompEditQuery[0]['venueId']) ?>">Sections</a></li>
            <li class="active"><a href="#tab1Inspire">Beacons</a></li>
            <li><a href="<?= site_url('company/Venues/venueDetailsCamp/'.$modalcompEditQuery[0]['venueId']) ?>">Campaigns</a></li>
          </ul>
          <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
          <div class="tab-content">
            
            <div class="tab-pane active" id="tab1Inspire">
              <div class="row">
                <div class="col-md-12">
                  <?php if($role == OWNER){ ?><div class="tools"> <button type="button" class="btn btn-primary btn-small" data-toggle="modal" data-target="#myModal1">Assign A Beacon</button></div>
                <?php }?>
                <br>
                <?php if (!empty($venueBeacons)) {
                  ?>
                  <table class="table table-striped dataTable example3" aria-describedby="example3_info" >
                <thead class="center">
                  <tr>
                    <th>Serial No.</th>
                    <th>Beacon Placement</th>
                    <th>Status</th>
                    <th>Section</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($venueBeacons as $val) {
                  ?>
                  <tr class="odd gradeX">
                    <td><?= $val['beaconUuid'] ?></td>
                    <td><?= $val['placement'] ?></td>
                    <td class="center"><?= $val['status'] ?></td>
                    <td class="center"><?= $val['section'] ?></td>
                    <td>
                      <div class="btn-group"> <a class="btn btn-info dropdown-toggle btn-demo-space btn-small" data-toggle="dropdown" href="#">
                       Actions <span class="caret"></span> </a>
                        <ul class="dropdown-menu">
                          <li><a href="<?= site_url('company/venues/unAssignBeacon/'.$val['beaconId'].'/'.$val['venueId']); ?>">Unassign Beacon</a></li>
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
                <div class="text-center"><b>No Beacons found in this venue. Please click the "Assign A Beacon" button above to begin.</b></div>
                  </table>
                  <?php } ?>
                </div>
              </div>
            </div>
             
          </div>
                            
          <!--   </div>
          </div>
 -->        </div>
      </div>
      
        <!-- Modal -->
      <?php foreach ($modalcompEditQuery as $val) {
                ?>
                  <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <br>
                          <i class="fa fa-th fa-7x"></i>
                          <h4 id="myModalLabel" class="semi-bold">Assign A Beacon</h4>
                          <p class="no-margin">Please select the beacon you wish to assign from the drop down </p>
                          <br>
                        </div>
                        <div class="modal-body">
                        <form id="venue_form1" name="venueform" class="animated" action="<?= site_url('company/Venues') ?>" method="post">
                        <br>
                          <div class="row form-row">
                            <div class="col-md-3"><b>Beacon: </b></div>
                            <div class="col-md-8">
                              <select required id="companyforbeacon" name="beacassign[beacon]" style="width:100%">
                          <?php
                          if(!empty($beacComp)){
                          foreach ($beacComp as $beaconId => $beaconName) {?>
                            # code...
                          <option name="beacon" value="<?php echo $beaconId ?>"><?php echo $beaconName; ?></option>
                          <?php }
                      }else{
                           ?>
                           <option value="">You do not have any beacons assigned to you...</option>
                           <?php
                        }
                           ?>
                        </select>
                        <input type="hidden" value="<?= $val['venueId'] ?>" class="form-control" name="beacassign[venueId]" id="venueId">
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
                  <?php } ?>
                  <!-- /.modal -->

                   