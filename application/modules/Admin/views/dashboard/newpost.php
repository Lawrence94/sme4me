
<section class="content-header">
          <h1>
            New Post
            <small>new</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Page</a></li>
            <li class="active">Add a New Post</li>
          </ol>
        </section>

        <?php echo show_notification(); ?>
          

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Add a New Post</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?= site_url('Admin/Dashboard/makepost'); ?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    
                    <div class="form-group">
                      <input type="radio" name="type" checked value="skilled" style="box-shadow:none; border:none; float:left; width:20px; margin-top:3px;" /> <span style="float:left;">Skilled</span>
                      <br>
                      <input type="radio" name="type" checked value="unskilled" style="box-shadow:none; border:none; float:left; width:20px; margin-top:3px;" /> <span style="float:left;">UnSkilled</span>
                    </div>

                    <br>

                    <div class="form-group">
                      <label for="exampleInputPassword1">email </label>
                      <input type="text" name="email" class="form-control" id="exampleInputPassword1" placeholder="email">
                    </div>
					
                    <div class="form-group">
                      <label for="exampleInputPassword1">password </label>
                      <input type="text" name="password1" class="form-control" id="exampleInputPassword1" placeholder="password">
                    </div>
				
                    <div class="form-group">
                      <label for="exampleInputPassword1">Full Name </label>
                      <input type="text" name="fname" class="form-control" id="exampleInputPassword1" placeholder="Full Name">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Full Address </label>
                      <input type="text" name="address" class="form-control" id="exampleInputPassword1" placeholder="Full Address">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Mobile No: </label>
                      <input type="text" name="mobile" class="form-control" id="exampleInputPassword1" placeholder="Mobile No:">
                    </div>

                    <div class="form-group">
                      <label>Gender</label>
                      <select name="sex" class="form-control">
                        <option value="">==Gender==</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>

					          <div class="form-group">
                      <label for="exampleInputPassword1">Date of birth </label>
                      <input type="date" name="dob" class="form-control" id="exampleInputPassword1" placeholder="mm/dd/yyy">
                    </div>
					          
					          <div class="form-group">
                      <label for="exampleInputPassword1">Town </label>
                      <input type="text" name="town" class="form-control" id="exampleInputPassword1" placeholder="Town">
                    </div>
					          
                    <div class="form-group">
                      <label for="exampleInputPassword1">LGA</label>
                      <input type="text" name="lga" class="form-control" id="exampleInputPassword1" placeholder="LGA">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">State </label>
                      <input type="text" name="state" class="form-control" id="exampleInputPassword1" placeholder="State">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Country </label>
                      <input type="text" name="country" class="form-control" id="exampleInputPassword1" placeholder="Country">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Key skills </label>
                      <textarea type="text" name="key_skills" class="form-control" id="exampleInputPassword1"> </textarea>
                    </div>

                    <div class="form-group">
                      <label>Years Of Experience</label>
                      <select id="expyear" class="text requiredField" name="exp_year" style="width:150px; height:25px; float:right;">
                        <option value="">===Select===</option>
                        <option value="Fresher">Fresher</option>
                        <option value="1 Year">1 Year</option>
                        <option value="2 Years">2 Years</option>
                        <option value="3 Years">3 Years</option>
                        <option value="4 Years">4 Years</option>
                        <option value="5 Years">5 Years</option>
                        <option value="6 Years">6 Years</option>
                        <option value="7 Years">7 Years</option>
                        <option value="8 Years">8 Years</option>
                        <option value="9 Years">9 Years</option>
                        <option value="10 Years">10 Years</option>
                        <option value="more than 10 Years">more than 10 Years</option>
									    </select>
                    </div>         

                    <div class="form-group">
                      <label>Functional Areas</label>
                      <select id="func_area" class="text requiredField" name="func_area" style="width:150px; height:25px; float:right;">
                        <option value="">===Select===</option>                                                        
                        <option value="ARCHITECT">ARCHITECT</option>
                        <option value="ARCHITECT">ACCOUNTING</option>
                        <option value="AGRICULTURE">AGRICULTURE</option>
                        <option value="ARCHITECT">BANKING AND FINANCE</option>
                        <option value="BUSINESS ADMISTRATION">BUSINESS ADMISTRATION</option>
                        <option value="COMMUNICATIONS">COMMUNICATIONS</option>
                        <option value="CONSTRUCTIONS">CONSTRUCTIONS</option>
                        <option value="EDUCATION">EDUCATION</option>
                        <option value="ENGINEERING">ENGINEERING</option>
                        <option value="ENVIRONMENTAL">ENIVRONMENTAL</option>
                        <option value="GOVERNMENT">GOVERNMENT</option>
                        <option value="INFORMATION TECHNOLOGY">INFORMATION TECHNOLOGY</option>
                        <option value="HOTELS & RESORT">HOTELS & RESORT</option>
                        <option value="HUMAN RESOURCE">HUMAN RESOURCE</option>
                        <option value="MANAGEMENT">MANAGEMENT</option>
                        <option value="MARKETING">MARKETING</option>
                        <option value="MEDICAL">MEDICALS</option>
                        <option value="HEALTH SERVICES">HEALTH SERVICES</option>
                        <option value="PHARMARCY">PHARMARCY</option>
                        <option value="PUBLIC ADMINISTRATION">PUBLIC ADMINISTRATION</option>
                        <option value="PHARMARCY">OTHERS</option>
                      </select>
                    </div>     

                    <div class="form-group">
                      <label for="exampleInputPassword1">Name of primary school </label>
                      <input type="text" name="pri_name" class="form-control" id="exampleInputPassword1" placeholder="Primary school">
                    </div> 

                     <div class="form-group">
                      <label for="exampleInputPassword1">Year Of Graduation </label>
                        <select id="pri_grad" class="text requiredField" name="pri_grad" style="width:150px; height:25px; float:right;">
                          <option value="">===Select===</option>
                                    <?php
                          $d = date('Y');
                          for($i=$d; $i>=1960; $i--){
                          ?>
                          <option value="<?=$i?>"><?=$i?></option>
                          <?php
                          }
                          ?>	  
                    
                       </select>
                    </div> 

                    <div class="form-group">
                      <label for="exampleInputPassword1">Qualifications Obtained</label>
                      <select id="pri_duration" class="text requiredField" name="pri_qual" style="width:150px; height:25px; float:right;">
                        <option value="">===Select===</option>
                        <option value="First School Leaving">First School Leaving</option>
                        <option value="Others">Others</option>
									    </select>
                    </div> 

                    <div class="form-group">
                      <label for="exampleInputPassword1">Name of Secondary School</label>
                      <input type="text" name="sec_name" class="form-control" id="exampleInputPassword1" placeholder="Secondary School">
                    </div> 

                     <div class="form-group">
                      <label for="exampleInputPassword1">Year Of Graduation </label>
                        <select id="sec_grad" class="text requiredField" name="sec_grad" style="width:150px; height:25px; float:right;">
                          <option value="">===Select===</option>
                                    <?php
                          $d = date('Y');
                          for($i=$d; $i>=1960; $i--){
                          ?>
                          <option value="<?=$i?>"><?=$i?></option>
                          <?php
                          }
                          ?>	  
                    
                       </select>
                    </div> 

                    <div class="form-group">
                      <label for="exampleInputPassword1">Qualifications Obtained</label>
                      <select id="sec_duration" class="text requiredField" name="sec_qual" style="width:150px; height:25px; float:right;">
                        <option value="">===Select===</option>
                        <option value="WAEC">WAEC</option>
                        <option value="NECO">NECO</option>
                        <option value="SSCE">SSCE</option>
                        <option value="GCE">GCE</option>
                        <option value="Others">Others</option>
									    </select>
                    </div> 

                    <div class="form-group">
                      <label for="exampleInputPassword1">Name of University</label>
                      <input type="text" name="uni_name" class="form-control" id="exampleInputPassword1" placeholder="University">
                    </div> 

                    <div class="form-group">
                      <label for="exampleInputPassword1">Course Of Study</label>
                      <input type="text" name="uni_degree" class="form-control" id="exampleInputPassword1" placeholder="Course">
                    </div> 

                     <div class="form-group">
                      <label for="exampleInputPassword1">Year Of Graduation </label>
                        <select id="uni_grad" class="text requiredField" name="uni_grad" style="width:150px; height:25px; float:right;">
                          <option value="">===Select===</option>
                                    <?php
                          $d = date('Y');
                          for($i=$d; $i>=1960; $i--){
                          ?>
                          <option value="<?=$i?>"><?=$i?></option>
                          <?php
                          }
                          ?>	  
                    
                       </select>
                    </div> 

                    <div class="form-group">
                      <label for="exampleInputPassword1">Class Obtained</label>
                      <select id="pri_duration" class="text requiredField" name="uni_grade" style="width:150px; height:25px; float:right;">
                        <option value="">===Select===</option>
                                      <option value="First class">First Class</option>
                                        <option value="2:1/Upper Credit">2:1/Upper Credit</option>
                                        <option value="2:2/Lower Credit">2:2/Lower Credit</option>
                          <option value="Third Class">Third Class</option>
                          <option value="Pass">Pass</option>								  
                      </select>
                    </div> 

                    <div class="form-group">
                      <label for="exampleInputPassword1">Class Obtained</label>
                      <select id="pri_duration" class="text requiredField" name="uni_qual" style="width:150px; height:25px; float:right;">
                        <option value="">===Select===</option>
                                     <option value="BSc">BSc</option>
                                      <option value="BTech">BTech</option>
                        <option value="BSc(ED)">BSc(ED)</option>
                        <option value="BEng">BEng</option>
                                          <option value="BA">BA</option>
                        <option value="BCA">HND</option>
                        <option value="BCA">OND</option>
                                          <option value="Others">Others</option>								  
                      </select>
                    </div> 
                                  
                    <div class="form-group">
                      <label for="exampleInputPassword1">Masters University</label>
                      <input type="text" name="ms_univ" class="form-control" id="exampleInputPassword1" placeholder="MS University">
                    </div> 

                    <div class="form-group">
                      <label for="exampleInputPassword1">Masters Degree</label>
                      <input type="text" name="ms_degree" class="form-control" id="exampleInputPassword1" placeholder="Masters Degree">
                    </div> 

                     <div class="form-group">
                      <label for="exampleInputPassword1">Year Of MS Completion</label>
                        <select id="ms_completion" class="text requiredField" name="ms_completion" style="width:150px; height:25px; float:right;">
                          <option value="">===Select===</option>
                                    <?php
                          $d = date('Y');
                          for($i=$d; $i>=1960; $i--){
                          ?>
                          <option value="<?=$i?>"><?=$i?></option>
                          <?php
                          }
                          ?>	  
                    
                       </select>
                     </div> 

                     <div class="form-group">
                      <label for="exampleInputPassword1">Post Graduate University</label>
                      <input type="text" name="pg_univ" class="form-control" id="exampleInputPassword1" placeholder="PG University">
                    </div> 

                    <div class="form-group">
                      <label for="exampleInputPassword1">PostGraduate Degree</label>
                      <input type="text" name="pg_degree" class="form-control" id="exampleInputPassword1" placeholder="PG Degree">
                    </div> 

                     <div class="form-group">
                      <label for="exampleInputPassword1">Year Of PG Completion</label>
                        <select id="pg_completion" class="text requiredField" name="pg_completion" style="width:150px; height:25px; float:right;">
                          <option value="">===Select===</option>
                                    <?php
                          $d = date('Y');
                          for($i=$d; $i>=1960; $i--){
                          ?>
                          <option value="<?=$i?>"><?=$i?></option>
                          <?php
                          }
                          ?>	  
                    
                       </select>
                     </div> 
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
        </section><!-- /.content