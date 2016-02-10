<ul class="breadcrumb">
<li>
  <p>YOU ARE HERE</p>
</li>
<li><a href="<?php echo site_url('company/managers');?>" class="active">Manage Admin/Users</a> </li>
<li><a href="#" class="active">Edit Admins</a> </li>
</ul>
<div class="page-title"> <a href="<?php echo site_url('company/managers');?>" class="active"><i class="icon-custom-left"></i></a>
<h3>Edit <span class="semi-bold">Admins</span></h3>
</div>
              <?php echo show_notification(); ?>
              <span style="<?= $displayData ?>" >
              <?php echo show_valnotif(); ?>
              </span>
<?php 
if(!empty($modaluserEditQuery)) {
	foreach ($modaluserEditQuery as $val) {
?>
<div class="pull-right">
	 <button type="submit" class="btn btn-danger btn-cons" data-toggle="modal" data-target="#myModal"><i class="fa fa-eraser"></i>&nbsp;Remove User</button></a>
</div>
				 <!-- Modal -->
                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <br>
                          <i class="fa fa-user fa-7x"></i>
                          <h4 id="myModalLabel" class="semi-bold">Remove A User</h4>
                          <br>
                        </div>
                        <div class="modal-body">
                        <div class="text-center"><b>Are you sure you want to remove this user?</b></div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                          <a href="<?= site_url('company/Managers/deleteUser/'.$val['userId']); ?>"><input name="" type="submit" class="btn btn-primary" value="Most Definitely"></a>
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
				<form id="companyedit_form" name="companyeditform" class="animated" action="<?= site_url('company/Managers') ?>" method="post">
                      <div class="row form-row">
                            <div class="col-md-6">
                            <label class="form-label">First Name</label>
                              <input required value="<?= $val['userfName'] ?>" type="text" 
                              class="form-control" name="useredit[adminfname]" id="userfname" placeholder="">
                                <input value="<?= $val['userId'] ?>" name="useredit[adminid]" type="hidden">
                            </div>
                            <div class="col-md-6">
                            <label class="form-label">Last Name</label>
                            <input required value="<?= $val['userlName'] ?>" type="text" name="useredit[adminlname]" class="form-control" placeholder="">
                            </div>
                      </div>
                       <div class="row form-row">
                            <div class="col-md-12">
                            <label class="form-label">Email</label>
                              <input required email="true" value="<?= $val['userMail'] ?>" type="text" class="form-control" name="useredit[adminmail]" id="adminmail" placeholder="">
                            </div>
                      </div>
                     <div class="row form-row">
                            <div class="col-md-4">
                            <label class="form-label">Permission (This is required)</label>
                              <select required id="getperm" name="useredit[adminperm]" style="width:100%">
                            <option value="">Permission...</option>
			                    <?php
			                    foreach ($permission as $permId => $permName) {?>
			                    	# code...
			                    <option name="permission" value="<?php echo $permId ?>"><?php echo $permName; ?></option>
			                    <?php }
			                     ?>
			                  </select>
                            </div>
                            <div class="col-md-8">
                            <label class="form-label">Password</label>
                            <input required value="<?= $val['userPass'] ?>" type="password" name="useredit[adminpass]" class="form-control" placeholder="">
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


