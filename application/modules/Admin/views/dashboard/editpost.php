
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
                <form role="form" action="<?= site_url('Admin/Dashboard/adduser'); ?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    
				 <div class="box-body">
                      
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputPassword1">Email </label>
                      <input type="text" name="email" class="form-control" id="exampleInputPassword1" placeholder="Email">
                      </div>
					
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password </label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="password">
                    </div>
				
                     <!-- select -->
                    <div class="form-group">
                      <label>Access Control Level</label>
                      <select required name="aid" class="form-control">
                      <?php 
                      foreach ($aids as $val) {
                      ?>
                        <option value="<?= $val->id ?>"><?= $val->name ?></option>
                      <?php 
                      }     
                      ?>                   
                      </select>
                    </div>
                    
                    
                  </div><!-- /.box-body -->
				    
                   
                    

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