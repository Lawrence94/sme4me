  <!-- Content Header (Page header) -->
    <link rel="stylesheet" href="<?php echo site_url();?>assets/datatable/css/normalize.css">

    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='http://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css'>
    <link rel='stylesheet prefetch' href='http://cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css'>

    <link rel="stylesheet" href="<?php echo site_url();?>assets/datatable/css/style.css">

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='http://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js'></script>
    <script src='http://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js'></script>
    <script src='http://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js'></script>
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
              <table summary="This table shows your personalised Opportunities" class="table table-bordered table-hover dt-responsive">
                                    <caption class="text-center">Personalised Opportunities </caption>
                                    <thead>
                                      <tr>
                                        <th>Deadline</th>
                                        <th>Opportunity Name</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Link</th>
                                        <th>Details</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php //foreach ($results as $result) {
                                    ?>
                                      <tr>
                                        <td>bla</td>
                                        <td>bla</td>
                                        <td>bla</td>
                                        <td>bla</td>
                                        <td><a href="#" target="_blank">Visit Website</a></td>
                                        <td><a href="<?= site_url('dashboard/posts/' ) ?>">More Details</a></td>
                                        <td><div class="opp"><a class="oppremove" id="oppremove" href="#" data-uri="<?= site_url('Main/Dashboard/save/') ?>" data-url="<?= site_url('Main/Dashboard/unsave/') ?>">Remove</a></div></td>
                                      </tr>
                                    <?php //}
                                    ?>
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <td colspan="5" class="text-center"><a href="dashboard" target="_blank">Opportunities</a> </td>
                                      </tr>
                                    </tfoot>
                                </table>
            </div><!-- ./col -->
          </div><!-- /.row -->

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->