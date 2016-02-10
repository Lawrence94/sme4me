<ul class="breadcrumb">
<li>
  <p>YOU ARE HERE</p>
</li>
<li><a href="<?php echo site_url('company/Admincampaign');?>" class="active">Manage Campaigns</a> </li>
<li><a href="#" class="active">Edit Campaign</a> </li>
</ul>
<div class="page-title"> <a href="<?php echo site_url('company/Admincampaign');?>" class="active"><i class="icon-custom-left"></i></a>
<h3>Edit <span class="semi-bold">Campaign</span></h3>
</div>

<!-- Begin Css -->
<link href="<?php echo site_url();?>assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
<link href="<?php echo site_url();?>assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
<style>
.datepicker{z-index:1151 !important;}
</style>

<?php echo show_notification(); ?>
              <span style="<?= $displayData ?>" >
              <?php echo show_valnotif(); ?>
              </span>


          <div class="row">
            <div class="col-md-12">
              <div class="grid simple">
                <div class="grid-title no-border">
                  <h4>Campaign <span class="semi-bold">Details</span></h4>
                  
                </div>
                <?php foreach ($campaign as $value) {
                ?>
                <div class="grid-body no-border">
                      <form id="admin_formm" name="adminform" class="animated" action="<?= site_url('company/Campaigns/editCampaign/'. $value['id']) ?>" method="post">
                          <div class="row form-row">
                            <div class="col-md-6">
                              <h5><b>Campaign Title:</b>   <?= $value['title'] ?></h5>
                            </div>
                            <div class="col-md-6">
                              <h5><b>Campaign Type:</b>   <?= $value['type'] ?></h5>
                            </div>
                          </div>
                          <br>
                          <div class="row form-row">
                            <div class="col-md-12">
                              <h5><b>Campaign Description:</b>   <?= $value['desc'] ?></h5>
                            </div>  
                           </div>
                           <br>
                          <div class="row form-row">
                            <div class="col-md-3">
                              <h5><b>Total Point Allocation:</b>   <?= $value['points'] ?></h5>
                            </div>
                            <div class="col-md-3">
                              <h5><b>User Point Allocation:</b>   <?= $value['userAlloc'] ?></h5>
                            </div>
                            <div class="col-md-3">
                              <h5><b>Allocated Points:</b>   <?= (empty($value['allocated']))? '0' : $value['allocated'] ?></h5>
                            </div>
                            <div class="col-md-3">
                              <h5><b>Point Balance:</b>   <?= $value['balance'] ?></h5>
                            </div>
                          </div>
                          <br>
                          <div class="row form-row">
                            <div class="col-md-3">
                              <h5><b>Start Date:</b>   <?= date_format($value['startDate'], 'd-M-Y'); ?></h5>  
                            </div>
                            <div class="col-md-3">
                              <h5><b>Expiry Date:</b>   <?= date_format($value['endDate'], 'd-M-Y'); ?></h5>
                            </div>
                            <div class="col-md-3">
                              <h5><b>Age Range:</b>   <?= $value['age'] ?></h5>
                            </div>
                            <div class="col-md-3">
                              <h5><b>Gender:</b>   <?= $value['gender'] ?></h5>
                            </div>
                          </div>
                      </form>
                </div>
                <?php }?>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-12">
              <div class="grid simple">
                <div class="grid-title no-border">
                  <h4>Edit <span class="semi-bold">Campaign</span></h4>
                  
                </div>
                <?php foreach ($campaign as $value) {
                ?>
                <div class="grid-body no-border">
				              <form id="admin_formm" name="adminform" class="animated" action="<?= site_url('company/Admincampaign/editCamp/'. $value['id']) ?>" method="post">
                          <div class="row form-row">
                            <div class="col-md-6">
                              <input value="<?= $value['title'] ?>" type="text" class="form-control" name="editcamp[title]" id="beacname" placeholder="Offer Title">
                            </div>
                            <div class="col-md-6">
                              <select name="editcamp[type]" style="width:100%" >
                                  <option value="">Offer Type</option>
                                  <option value="<?= $value['type'] ?>"><?= $value['type'] ?></option>
                              </select>
                            </div>
                          </div>
                          <!-- <div class="row form-row">
                            <div class="col-md-5">
                              <select id="selector" name="editcamp[section]" style="width:100%" data-url="<?php echo site_url('company/campaigns/get_beacons'); ?>">
                                  <option value="">Section...</option>
                                <?php foreach ($sectionQuery as $sectionId => $sectionName) {
                                 ?>
                                  <option value="<?= $sectionId ?>"><?= $sectionName ?></option>
                                <?php } ?>
                              </select>
                            </div>
                             <div class="col-md-5">
                              <h5 id="selectorwords"></h5>
                            </div>
                          </div> -->
                          <div class="row form-row">
                             <div class="col-md-12">
                               <input value="<?= $value['desc'] ?>" type="text" name="editcamp[desc]" class="form-control" placeholder="Offer Description">
                              </div>  
                           </div>
                          <div class="row form-row">
                            <div class="col-md-3">
                               <input value="<?= $value['points'] ?>" type="text" name="editcamp[points]" class="form-control" placeholder="Total Point Allocation">
                            </div>
                            <div class="col-md-3">
                               <input value="<?= $value['userAlloc'] ?>" type="text" name="editcamp[userpoints]" class="form-control" placeholder="User Allocation">
                            </div>
                            <!-- <div class="col-md-2">
                                <select id="selectsomething" name="createcamp[status]" style="width:100%">
                                  <option value="draft">Draft</option>
                                  <option value="live">Live</option>
                                </select>
                            </div> -->
                            <div class="col-md-3">
                              <div class="input-append success date">
                                  <input type="text" name="editcamp[expirydate]" class="form-control" id="sandbox-advance" placeholder="Expiry Date">
                                  <a href="#sandbox-advance"><span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span></a>
                              </div>
                            </div>
                          </div>
                          <h5><span class="semi-bold">Demographics</span></h5>
                          <div class="row form-row">
                            <div class="col-md-6">
                              <select name="editcamp[gender]" style="width:100%" >
                                  <option value="">Gender</option>
                                  <option value="male">Male</option>
                                  <option value="female">Female</option>
                              </select>
                            </div>
                            <div class="col-md-6">
                              <select name="editcamp[age]" style="width:100%" >
                                  <option value="">Age Range</option>
                                  <option value="12-19">12-19</option>
                                  <option value="20-27">20-27</option>
                                  <option value="28-35">28-35</option>
                                  <option value="36-43">36-43</option>
                                  <option value="44-51">44-51</option>
                                  <option value="51 and older">51 and older</option>
                              </select>
                            </div>
                          </div>
                				  <div class="form-actions">  
                  					<div class="pull-right">
                  					  <input name="" type="submit" class="btn btn-primary btn-cons" value="Save">
                  					</div>
                					</div>
				              </form>
                </div>
                <?php }?>
              </div>
            </div>
          </div>