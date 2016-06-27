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
            <?php if ($state == 'totalusers') {
              # code...
            ?>
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Total Users</h3>
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
                          <tr><th  class="">S/N </th><th  class="">Name </th><th  class="">Email </th><th  class="">Status </th>
                      </thead>
                      <tbody>
                      <?php
                        $sn = 1;
                        foreach ($totalUsers as $total) {
                      ?>     
                        <tr>
                            <td><?= $sn++ ?></td>
                            <td><?= $total->fullname ?></td>
                            <td><?= $total->email ?></td>
                            <td><?= $total->status == '1' ? "Active" : "Expired" ?></td>
                        </tr>
                      <?php }  ?>
                      </tbody>
                  </table>
                </form>
              </div>
              <?php }elseif ($state == 'totalvouchers') {
              ?>
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Total Vouchers</h3>
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
                          <tr><th  class="">S/N </th><th  class="">Voucher Code </th><th  class="">Serial Number </th>
                      </thead>
                      <tbody>
                      <?php
                        $sn = 1;
                        foreach ($totalVouchers as $total) {
                      ?>     
                        <tr>
                            <td><?= $sn++ ?></td>
                            <td><?= $total->vouchercode ?></td>
                            <td><?= $total->serial ?></td>
                        </tr>
                      <?php }  ?>
                      </tbody>
                  </table>
                </form>
              </div>
              <?php }elseif ($state == 'activeusers') {
                # code...
              ?>
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Active Users</h3>
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
                          <tr><th  class="">S/N </th><th  class="">Name </th><th  class="">Email </th><th  class="">Status </th>
                      </thead>
                      <tbody>
                      <?php
                        $sn = 1;
                        foreach ($activeusers as $total) {
                      ?>     
                        <tr>
                            <td><?= $sn++ ?></td>
                            <td><?= $total->fullname ?></td>
                            <td><?= $total->email ?></td>
                            <td><?= $total->status == '1' ? "Active" : "Expired" ?></td>
                        </tr>
                      <?php }  ?>
                      </tbody>
                  </table>
                </form>
              </div>
              <?php }elseif ($state == 'expiredusers') {
                # code...
              ?>
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Expired Users</h3>
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
                          <tr><th  class="">S/N </th><th  class="">Name </th><th  class="">Email </th><th  class="">Status </th>
                      </thead>
                      <tbody>
                      <?php
                        $sn = 1;
                        foreach ($expiredUsers as $total) {
                      ?>     
                        <tr>
                            <td><?= $sn++ ?></td>
                            <td><?= $total->fullname ?></td>
                            <td><?= $total->email ?></td>
                            <td><?= $total->status == '1' ? "Active" : "Expired" ?></td>
                        </tr>
                      <?php }  ?>
                      </tbody>
                  </table>
                </form>
              </div>
              <?php }elseif ($state == 'usedvouchers') {
                # code...
              ?>
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Used Vouchers</h3>
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
                          <tr><th  class="">S/N </th><th  class="">Voucher Code </th><th  class="">Serial Number </th>
                      </thead>
                      <tbody>
                      <?php
                        $sn = 1;
                        foreach ($usedVouchers as $total) {
                          var_dump($total['id']);
                          exit;
                      ?>     
                        <tr>
                            <td><?= $sn++ ?></td>
                            <td><?= $total['vouchercode'] ?></td>
                            <td><?= $total['serial'] ?></td>
                        </tr>
                      <?php }  ?>
                      </tbody>
                  </table>
                </form>
              </div>
              <?php } ?>
            </div><!-- ./col -->
          </div><!-- /.row -->

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->