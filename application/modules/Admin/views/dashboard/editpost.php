
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
                <form role="form" action="<?= site_url('Admin/Dashboard/editpost/'. $post->id ); ?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    
				 <div class="box-body">

				<label for="exampleInputEmail1">Opportunity Title</label>
                <input name="adminpost[title]" class="form-control input-lg" type="text" placeholder="Post Title" value="<?= $post->title ?>">
                      
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputPassword1">Purpose </label>
                      <input type="text" name="adminpost[purpose]" class="form-control" id="exampleInputPassword1" placeholder="Purpose" value="<?= $post->purpose ?>">
                      </div>
					
                    <div class="form-group">
                      <label for="exampleInputPassword1">Eligibility </label>
                      <input type="text" name="adminpost[eligibility]" class="form-control" id="exampleInputPassword1" placeholder="Eligibility" value="<?= $post->eligibility ?>">
                    </div>
				
                    <div class="form-group">
                      <label for="exampleInputPassword1">Level of Study </label>
                      <input type="text" name="adminpost[level]" class="form-control" id="exampleInputPassword1" placeholder="Level" value="<?= $post->level ?>">
                    </div>

                    <div class="form-group">
					            <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="text" name="adminpost[value]" class="form-control" placeholder="Value" value="<?= $post->value ?>">
                        <span class="input-group-addon">.00</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="text" name="adminpost[valuedoll]" class="form-control" placeholder="Value in dollars" value="<?= $post->valuedoll ?>">
                        <span class="input-group-addon">.00</span>
                      </div>
                    </div>

					          <div class="form-group">
                      <label for="exampleInputPassword1">Course </label>
                      <input type="text" name="adminpost[freq]" class="form-control" id="exampleInputPassword1" placeholder="Course" value="<?= $post->frequency ?>">
                    </div>
					          
					          <div class="form-group">
                      <label for="exampleInputPassword1">Country of Study </label>
                      <input type="text" name="adminpost[country]" class="form-control" id="exampleInputPassword1" placeholder="Country" value="<?= $post->country ?>">
                    </div>
					          
                    <div class="form-group">
                      <label for="exampleInputPassword1">Deadline</label>
                      <input type="text" name="adminpost[deadline]" class="form-control" id="exampleInputPassword1" placeholder="Deadline" value="<?= $post->deadline ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Weblink </label>
                      <input type="text" name="adminpost[weblink]" class="form-control" id="exampleInputPassword1" placeholder="Weblink" value="<?= $post->weblink ?>">
                    </div>
                    
                    
                  </div><!-- /.box-body -->
				    
                    <!-- select -->
                    <div class="form-group">
                      <label>Category</label>
                      <select name="adminpost[catsingle]" class="form-control">
                      <option>Select One</option>
                        <option>Phd</option>
                        <option>Mba</option>
                        <option>Master</option>
                        <option>Startup</option>
                        <option>Essay</option>
                        <option>Ngo</option>
                        <option>Bachelor</option>
                        <option>Loan</option>
                        <option>Philantropy</option>
                        <option>Internship</option>
                        <option>Award</option>
                        <option>Postdoctorate</option>
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
        </section><!-- /.content