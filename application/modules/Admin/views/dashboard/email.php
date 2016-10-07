
<section class="content-header">
          <h1>
            New Email
            <small>new</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Page</a></li>
            <li class="active">Send emails</li>
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
                <h3 class="box-title">Send Test mail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?= site_url('Admin/Dashboard/email'); ?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">

                    <br>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Test Receipient </label>
                      <input type="email" name="testmail[testemail]" class="form-control" id="exampleInputPassword1" placeholder="email address">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Subject </label>
                      <input type="text" name="testmail[subject]" class="form-control" id="exampleInputPassword1" placeholder="subject">
                    </div>
					
                    <div class="form-group">
                      <label for="exampleInputPassword1">Test Message </label>
                      <textarea name="testmail[testmessage]" class="form-control" id="exampleInputPassword1"></textarea>
                    </div>

                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Send</button>
                    </div>

                  </div>

                </form>
                </div>
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Send Full Mail</h3>
                  </div><!-- /.box-header -->
  				        <form role="form" action="<?= site_url('Admin/Dashboard/email'); ?>" method="post" enctype="multipart/form-data">
                    <div class="box-body">

                      <div class="form-group">
                        <label for="exampleInputPassword1">Subject </label>
                        <input type="text" name="fullmail[subject]" class="form-control" id="exampleInputPassword1" placeholder="subject">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputPassword1">Message to all email addresses </label>
                        <textarea name="fullmail[message]" class="form-control" id="exampleInputPassword1"></textarea>
                      </div>
                      
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Send</button>
                    </div>

                  </form>
                </div><!-- /.box -->
              </div><!-- /.box-body -->
          </div><!-- /.box -->
        </section><!-- /.content