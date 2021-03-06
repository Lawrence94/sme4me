<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo site_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $firstName . ' ' . $lastName;?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">SME4ME NAV</li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="<?= site_url($redirect) ?>"><i class="fa fa-circle-o"></i> Home</a></li>
               
              </ul>
            </li>
            
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Post</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('Admin/Dashboard/newpost');?>"><i class="fa fa-circle-o"></i> New Post</a></li>
                <li><a href="<?php echo site_url('Admin/Dashboard/allpost');?>"><i class="fa fa-circle-o"></i> All Posts</a></li>
                <?php if ($role ==  SUPER_ADMINISTRATOR) {
                ?><li><a href="<?php echo site_url('Admin/Dashboard/adduser');?>"><i class="fa fa-circle-o"></i> User Management</a></li>
                <?php } ?>
                <?php if ($role ==  SUPER_ADMINISTRATOR) {
                ?><li><a href="<?php echo site_url('Admin/Dashboard/email');?>"><i class="fa fa-circle-o"></i> Send Email</a></li>
                <?php } ?>
              </ul>
            </li>
      
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
  
