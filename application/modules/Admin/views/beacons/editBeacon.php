<ul class="breadcrumb">
<li>
  <p>YOU ARE HERE</p>
</li>
<li><a href="<?php echo site_url('company/campaigns');?>" class="active">Manage Campaigns</a> </li>
<li><a href="#" class="active">Edit Campaigns</a> </li>
</ul>
<div class="page-title"> <a href="<?php echo site_url('company/campaigns');?>" class="active"><i class="icon-custom-left"></i></a>
<h3>Edit <span class="semi-bold">Campaign</span></h3>
</div>
              <?php echo show_notification(); ?>
              <span style="<?= $displayData ?>" >
              <?php echo show_valnotif(); ?>
              </span>
<?php 
if(!empty($modalBeaconEditQuery)) {
	foreach ($modalBeaconEditQuery as $val) {
?>
<div class="pull-right">
	 <?php if($role == SUPER_ADMIN){ ?><button type="submit" class="btn btn-danger btn-cons" data-toggle="modal" data-target="#myModal"><i class="fa fa-eraser"></i>&nbsp;Remove Beacon</button><?php } ?>
</div>
				 <!-- Modal -->
                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <br>
                          <i class="fa fa-user fa-7x"></i>
                          <h4 id="myModalLabel" class="semi-bold">Remove A Beacon</h4>
                          <br>
                        </div>
                        <div class="modal-body">
                        <div class="text-center"><b>Are you sure you want to remove this Beacon?</b></div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                          <a href="<?= site_url('admin/Beacons/deleteBeacon/'.$val['beaconId']); ?>"><input name="" type="submit" class="btn btn-primary" value="Most Definitely"></a>
                        </div>
                       
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
<div class="row">
            <div class="col-md-12">
              <div class="grid simple">
                <div class="grid-title no-border">
                  <h4>Admin <span class="semi-bold">Details</span></h4>
                  
                </div>
                <div class="grid-body no-border">
				<form id="companyedit_form" name="companyeditform" class="animated" action="<?= site_url('admin/Beacons') ?>" method="post">
                      <div class="row form-row">
                            <div class="col-md-6">
                            <label class="form-label">Beacon Name</label>
                              <input required value="<?= $val['beaconName'] ?>" type="text" 
                              class="form-control" name="editbeac[beaconname]" id="userfname" placeholder="">
                                <input value="<?= $val['beaconId'] ?>" name="editbeac[beaconid]" type="hidden">
                            </div>
                            <div class="col-md-6">
                            <label class="form-label">Beacon Major</label>
                            <input required value="<?= $val['beaconMajor'] ?>" type="text" name="editbeac[beaconmajor]" class="form-control" placeholder="">
                            </div>
                      </div>
                       <div class="row form-row">
                            <div class="col-md-12">
                            <label class="form-label">Beacon UUID</label>
                              <input required value="<?= $val['beaconUuid'] ?>" type="text" class="form-control" name="editbeac[beaconuuid]" id="beaconuuid" placeholder="">
                            </div>
                      </div>
                     <div class="row form-row">
                            <div class="col-md-6">
                            <label class="form-label">Beacon Minor</label>
                            <input required value="<?= $val['beaconMinor'] ?>" type="text" class="form-control" name="editbeac[beaconminor]" id="beaconminor">
                            </div>
                            
                      </div>
				  <div class="form-actions">  
					<div class="pull-right">
					  <input name="" type="submit" class="btn btn-primary btn-cons" value="Save">
					</div>
					</div>
				</form>
                </div>
              </div>
            </div>
            </div>
            <?php 
              } 
            }
            ?>


