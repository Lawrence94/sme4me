
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
                <form role="form" action="<?= site_url('Admin/Dashboard/makepost'); ?>" method="post">
                  <div class="box-body">
                    
				 <div class="box-body">
				<label for="exampleInputEmail1">Opportunity Title</label>
                <input name="adminpost[title]" class="form-control input-lg" type="text" placeholder="Post Title">
                      
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Purpose </label>
                      <input type="text" name="adminpost[purpose]" class="form-control" id="exampleInputPassword1" placeholder="Purpose">
                      </div>
					
                    <div class="form-group">
                      <label for="exampleInputPassword1">Eligibility </label>
                      <input type="text" name="adminpost[eligibility]" class="form-control" id="exampleInputPassword1" placeholder="Eligibility">
                    </div>
				
                    <div class="form-group">
                      <label for="exampleInputPassword1">Level of Study </label>
                      <input type="text" name="adminpost[level]" class="form-control" id="exampleInputPassword1" placeholder="Level">
                    </div>

                    <div class="form-group">
					            <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="text" name="adminpost[value]" class="form-control" placeholder="Value">
                        <span class="input-group-addon">.00</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="text" name="adminpost[valuedoll]" class="form-control" placeholder="Value in dollars">
                        <span class="input-group-addon">.00</span>
                      </div>
                    </div>

					          <div class="form-group">
                      <label for="exampleInputPassword1">Course </label>
                      <input type="text" name="adminpost[freq]" class="form-control" id="exampleInputPassword1" placeholder="Course">
                    </div>
					          
					          <div class="form-group">
                      <label for="exampleInputPassword1">Country of Study </label>
                      <input type="text" name="adminpost[country]" class="form-control" id="exampleInputPassword1" placeholder="Country">
                    </div>
					          
                    <div class="form-group">
                      <label for="exampleInputPassword1">Deadline</label>
                      <input type="text" name="adminpost[deadline]" class="form-control" id="exampleInputPassword1" placeholder="Deadline">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Weblink </label>
                      <input type="text" name="adminpost[weblink]" class="form-control" id="exampleInputPassword1" placeholder="Weblink">
                    </div>
                    
                    
                  </div><!-- /.box-body -->
				    
                    <!-- select -->
                    <div class="form-group">
                      <label>Category</label>
                      <select name="adminpost[catsingle]" class="form-control">
                        <option>Grant</option>
                        <option>Scholarship</option>
                        <option>Competition</option>
                        <option>Internship</option>
                        <option>Fellowship</option>
                        <option>Corporation</option>
                      </select>
                    </div>
                    

                    <!-- Select multiple-->
                    <!-- <div class="form-group">
                      <label>category</label>
                      <select name="adminpost[catmulti]" multiple class="form-control">
                        <option value="grants">Grants</option>
                        <option value="scholarships">Scholarships</option>
                        <option>Competitions</option>
                        <option>Internships</option>
                        <option>Fellowships</option>
                        <option>Corporations</option>
                      </select>
                    </div> -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
        </section><!-- /.content