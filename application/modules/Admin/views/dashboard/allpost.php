<link rel='stylesheet prefetch' href='http://findercdn.com.au/static/2165/css/static.min.css'>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="<?php echo site_url();?>assets/js/add_company.js"></script>

<!-- <link rel="stylesheet" href="<?php echo site_url();?>assets/postedittable/css/style.css"> -->



<section class="content-header">
          <h1>
            All Post
            <small>Posts</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Page</a></li>
            <li class="active">View All Posts</li>
          </ol>
</section>

<section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">View All Posts</h3>
                  <span><a href="<?php echo site_url('Admin/Dashboard/deleteall');?>"><button style="margin-left: 15px;" type="button" class="btn-primary">Delete All Posts</button></a></span>
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
                        foreach ($posts as $post) {
                      ?>     
                        <tr  >
                            <td    ><?= $post->title ?></td>
                            <td    ><?= $post->purpose ?></td>
                            <td    ><?= $post->eligibility ?></td>
                            <td    ><?= $post->deadline ?></td>
                            <td    ><?= $post->category ?></td>
                            <td    ><a href="<?php echo site_url('Admin/Dashboard/editpost/'. $post->id);?>">Edit</a><br> 
                                    <div class="exp">
                                      <a class="expire" data-id="<?php echo $post->id ?>" data-url="<?php echo site_url('Admin/Dashboard/expire/'. $post->id);?>" href="#" data-toggle="tab">Expire</a>
                                    </div>
                            </td>
                        </tr>
                      <?php }  ?>
                      </tbody>
                  </table>
                </form>
              </div>
            </div>
          </div>
</section>


   

