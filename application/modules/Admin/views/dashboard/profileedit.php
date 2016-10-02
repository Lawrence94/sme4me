
<section class="content-header">
          <h1>
            Edit your details
            <small>Edit</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Page</a></li>
            <li class="active">Edit your details</li>
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
                <h3 class="box-title">Edit your details</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?= site_url('Admin/Dashboard/edituser/' . $id); ?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    
                    <div class="form-group">
                      <label for="exampleInputPassword1">First Name </label>
                      <input type="text" value="<?php echo $details->firstname; ?>" required name="fname" class="form-control" id="exampleInputPassword1">
                    </div>

                      <div class="form-group">
                      <label for="exampleInputPassword1">Last Name </label>
                      <input type="text" value="<?php echo $details->lastname; ?>" required name="lname" class="form-control" id="exampleInputPassword1">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputPassword1">New Password </label>
                        <input type="password" required name="password" class="form-control" id="exampleInputPassword1" placeholder="enter new password">
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