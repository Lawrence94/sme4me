<ul class="breadcrumb">
<li>
  <p>YOU ARE HERE</p>
</li>
<li><a href="#" class="active">Campaigns</a> </li>
</ul>
<div class="page-title">
<h3><span class="semi-bold">Campaigns</span></h3>
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
              <h4>View <span class="semi-bold">Campaigns</span></h4>
            </div>
          
            <div class="grid-body ">
            <?php 
            	if (!empty($campQuery)) {
                ?>
              <table class="table table-striped dataTable" id="example3" aria-describedby="example3_info" >
                <thead class="center">
                  <tr>
                    <th>Date Created</th>
                    <th>Campaign Title</th>
                    <th>Start Date</th>
                    <th>Expiry Date</th>
                    <th>Venue</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($campQuery as $val) { ?>
                  <tr class="odd gradeX">
                    <td><?= date_format($val['dateCreated'], 'd-M-Y'); ?></td>
                    <td><?= $val['offerTitle'] ?></td>
                    <td><?= date_format($val['startDate'], 'd-M-Y'); ?></td>
                    <td><?= date_format($val['expiryDate'], 'd-M-Y'); ?></td>
                    <td><?= $val['venue']; ?></td>
                    <td>
                      <div class="btn-group"> <a class="btn btn-info dropdown-toggle btn-demo-space btn-small" data-toggle="dropdown" href="#">
                       Actions <span class="caret"></span> </a>
                        <ul class="dropdown-menu">
                          <li><a href="<?php echo site_url('company/Admincampaign/editCamp/'. $val['offerId']);?>">View Details</a></li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                  </tbody>
                  </table>
                  <?php
                  	}else{
                  ?>
                <?php if($role == OWNER){ ?><table class="table table-striped" id="" aria-describedby="" >
                  <div class="text-center"><b>None of your venues have added any campaigns</b></div>
                </table><?php }?>
                  <?php 
                  	}
                  ?>
            </div>
          </div>
        </div>
      </div>