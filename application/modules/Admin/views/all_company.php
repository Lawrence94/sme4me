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
              <h4>Venue <span class="semi-bold">Management</span></h4>

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
                        <form id="company_form" name="companyform" class="animated" action="<?= site_url('admin/Company') ?>" method="post">
                        Venue General Information :<br>
                          <div class="row form-row">
                            <div class="col-md-8">
                              <input required type="text" class="form-control" name="company[companyname]" id="companyname" placeholder="Company Name">
                            </div>
                            <div class="col-md-4">
                            <input required email="true" type="text" name="company[companymail]" class="form-control" placeholder="Company Mail">
                            </div>
                          </div>
                          <div class="row form-row">
                            <div class="col-md-4">
                            
                            <select id="remote" name="company[companycountry]" style="width:100%" data-url="<?php echo site_url('admin/company/get_states'); ?>">
                            <option value="">Country...</option>
			                    <?php
			                    foreach ($country as $countryId => $countryName) {?>
			                    	# code...
			                    <option name="country" value="<?php echo $countryId ?>"><?php echo $countryName; ?></option>
			                    <?php }
			                     ?>
			                  </select>
                            </div>
                            <div class="col-md-3">
                              <select id="remote2" name="company[companystate]" style="width:100%">
			                    <option value="">State...</option>
			                  </select>
                            </div>
                            <div class="col-md-5">
                             <input required type="text" name="company[companyaddr]" class="form-control" placeholder="Address">
                            </div>
                          </div>
                           <div class="row form-row">
	                           <div class="col-md-6">
	                             <input required type="text" name="company[companyphone]" class="form-control" placeholder="Phone">
	                            </div>
                           </div>
                          Company Owner Information :<br/>
                          <div class="row form-row">
                            <div class="col-md-6">
                              <input required email="true" type="text" class="form-control" name="company[ownermail]" placeholder="Owner Email (Will be used to login)">
                            </div>
                            <div class="col-md-6">
                              <input required minlength="8" type="password" class="form-control" name="company[ownerpass]" placeholder="Password (any generic password)">
                            </div>
                          </div>
                          <div class="row form-row">
                            <div class="col-md-5">
                              <input required type="text" class="form-control" name="company[ownerfname]" placeholder="First Name">
                            </div>
                            <div class="col-md-4">
                              <input required type="text" class="form-control" name="company[ownerlname]" placeholder="Last Name">
                            </div>
                            <div class="col-md-3">
                              <select id="remote3" name="company[ownergender]" style="width:100%">
			                    <option value="">Gender...</option>
			                    <option value="Male">Male</option>
			                    <option value="Female">Female</option>
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
            	if (!empty($modalcompQuery)) {
            		foreach ($modalcompQuery as $val) {
                ?>
              <table class="table table-striped dataTable" id="example3" aria-describedby="example3_info" >
                <thead class="center">
                  <tr>
                    <th>Company Name</th>
                    <th>Company Address</th>
                    <th>Phone</th>
                    <th>Company Email</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="odd gradeX">
                    <td><?= $val['compName'] ?></td>
                    <td><?= $val['compAddr'] ?></td>
                    <td><?= $val['compPhone'] ?></td>
                    <td class="center"><?= $val['compEmail'] ?></td>
                    <td>
                    	<div class="btn-group"> <a class="btn btn-info dropdown-toggle btn-demo-space btn-small" data-toggle="dropdown" href="#">
                    	 Actions <span class="caret"></span> </a>
                    		<ul class="dropdown-menu">
		                      <li><a href="<?php echo site_url('admin/company/editCompany/'. $val['compId']);?>">Edit</a></li>
		                      <li class="divider"></li>
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
                  <div class="text-center"><b>No companies found. Please click the "Add A Company" button above to begin.</b></div>
                </table><?php } ?>
                <?php if($role == ADMIN){ ?><table class="table table-striped" id="" aria-describedby="" >
                  <div class="text-center"><b>No companies here. The Administrator probably hasn't added any.</b></div>
                </table><?php }?>
                  <?php 
                  	}
                  ?>
            </div>
          </div>
        </div>
      </div>
