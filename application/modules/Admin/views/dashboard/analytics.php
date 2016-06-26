  <!-- Content Header (Page header) -->
    <link rel='stylesheet prefetch' href='http://findercdn.com.au/static/2165/css/static.min.css'>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="<?php echo site_url();?>assets/js/add_company.js"></script>
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">View All Posts</h3>
                </div><!-- /.box-header -->
                <div class="tableui has-padding-bottom-x-small clearfix">
                    <div class="form__panel content-area-grey tableui__panel">
                        <div class="form__group-inline clearfix">
                            <label for="search" class="fin-text-blue form__label-inline">Search</label>
                            <input id="search" class="js-table-search pull-s-right form__input-text form__input-text--long" type="text" data-table=".searchable-table" placeholder="enter your keywords here"/>
                        </div>
                    </div>
                </div>
                <form name="compareForm" method="post">
                  <table class="custom-table js-tablesorter searchable-table" cellspacing="0"  data-table-show-rows="" >
                      <thead>
                          <tr><th  class="">Opportunity Title </th><th  class="">Purpose </th><th  class="">Eligibility </th><th  class="">Deadline </th><th  class="">Category </th> <th  class="">Action </th></tr>
                      </thead>
                      <tbody>
                      <?php
                        //foreach ($posts as $post) {
                      ?>     
                        <tr  >
                            <td    >bla</td>
                            <td    >bla</td>
                            <td    >bla</td>
                            <td    >bla</td>
                            <td    >bla</td>
                            <td    ><a href="<?php echo site_url('Admin/Dashboard/editpost/');?>">Edit</a><br> 
                                    <div class="exp">
                                      <a class="expire" data-id="<?php  ?>" data-uri="<?php echo site_url('Admin/Dashboard/activate/');?>" data-url="<?php echo site_url('Admin/Dashboard/expire/');?>" href="#" data-toggle="tab">
                                      "Activate"</a>
                                    </div>
                            </td>
                        </tr>
                      <?php //}  ?>
                      </tbody>
                  </table>
                </form>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->