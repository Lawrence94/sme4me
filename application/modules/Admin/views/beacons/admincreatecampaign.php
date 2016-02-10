<ul class="breadcrumb">
<li>
  <p>YOU ARE HERE</p>
</li>
<li><a href="<?php echo site_url('company/venues');?>" class="active">Manage Venues</a> </li>
<li><a href="<?= site_url('company/Venues/venueDetailsCamp/'.$modalcompEditQuery[0]['venueId']) ?>" class="active">Venue Details</a> </li>
<li><a href="#" class="active">Create Campaign</a> </li>
</ul>
<div class="page-title"> <a href="<?= site_url('company/Venues/venueDetailsCamp/'.$modalcompEditQuery[0]['venueId']) ?>" class="active"><i class="icon-custom-left"></i></a>
<h3>Create <span class="semi-bold">Campaigns</span></h3>
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
                  <h4>Create <span class="semi-bold">Campaign</span></h4>
                  
                </div>
                <div class="grid-body no-border">
				              <form id="admin_form" name="adminform" class="animated" action="<?= site_url('company/Venues/createCamp/'.$modalcompEditQuery[0]['venueId']) ?>" method="post">
                          <div class="row form-row">
                            <div class="col-md-6">
                              <input required type="text" class="form-control" name="createcamp[title]" id="beacname" placeholder="Offer Title">
                            </div>
                            <div class="col-md-6">
                              <select required name="createcamp[type]" style="width:100%" >
                                  <option value="">Offer Type</option>
                                  <option value="walk-in">Walk In</option>
                              </select>
                            </div>
                          </div>
                          <div class="row form-row">
                            <div class="col-md-5">
                              <select required id="selector" name="createcamp[section]" style="width:100%" data-url="<?php echo site_url('company/campaigns/get_beacons'); ?>">
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
                          </div>
                          <div class="row form-row">
                             <div class="col-md-12">
                               <input required type="text" name="createcamp[desc]" class="form-control" placeholder="Offer Description">
                              </div>  
                           </div>
                          <div class="row form-row">
                            <div class="col-md-3">
                               <input required type="text" name="createcamp[points]" class="form-control" placeholder="Total Point Allocation">
                            </div>
                            <div class="col-md-3">
                               <input required type="text" name="createcamp[userpoints]" class="form-control" placeholder="User Allocation">
                            </div>
                            <!-- <div class="col-md-2">
                                <select required id="selectsomething" name="createcamp[status]" style="width:100%">
                                  <option value="draft">Draft</option>
                                  <option value="live">Live</option>
                                </select>
                            </div> -->
                            <div class="col-md-3">
                              <div class="input-append success date">
                                  <input type="text" name="createcamp[startdate]" class="form-control" id="sandbox-advance1" placeholder="Start Date">
                                  <a href="#sandbox-advance1"><span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span></a>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="input-append success date">
                                  <input type="text" name="createcamp[expirydate]" class="form-control" id="sandbox-advance" placeholder="Expiry Date">
                                  <a href="#sandbox-advance"><span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span></a>
                              </div>
                            </div>
                          </div>
                          <h5><span class="semi-bold">Demographics</span></h5>
                          <div class="row form-row">
                            <div class="col-md-6">
                              <select required name="createcamp[gender]" style="width:100%" >
                                  <option value="">Gender</option>
                                  <option value="male">Male</option>
                                  <option value="female">Female</option>
                              </select>
                            </div>
                            <div class="col-md-6">
                              <select required name="createcamp[age]" style="width:100%" >
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
                          <div class="row form-row">
                            <div class="col-md-12">
                              <h5><b>Note:</b> If your start date is today, your campaign will be posted immediately</h5>
                            </div>
                          </div>
                				  <div class="form-actions">  
                  					<div class="pull-right">
                  					  <input name="" type="submit" class="btn btn-primary btn-cons" value="Create">
                  					</div>
                					</div>
				              </form>
                </div>
              </div>
            </div>
          </div>