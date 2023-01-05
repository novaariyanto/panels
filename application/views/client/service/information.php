

    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="#"><?=$setting->app_name;?></a>
          <a class="navbar-brand brand-logo-mini" href="#">WP</a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
              </div>
            </form>
          </div>
          <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>

              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>


              </div>
            </li>
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="<?=base_url("assets/purple/assets/images/faces/face1.jpg")?>" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                    <p class="mb-1 text-black"><?=$current_user->email?></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?=base_url("index.php/auth/logout")?>">
                  <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
         <!-- partial -->
   <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php $this->load->view('layouts/navigasi',['menu'=>'service']) ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

            <div class="page-header">
              <h3 class="page-title">
                </span> Service Information
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Service </a></li>
                  <li class="breadcrumb-item active" aria-current="page">Information</li>
                </ul>
              </nav>
            </div>

            <div class="row">
              <div class="col-lg-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <div class="card-me" style="padding:20px">
                  <div class="col"><h5><b>Package Information</b></h5>
                  <div class="separator"></div>
                  <span class="grey-text ft-size12">Code </span>
                  <h6>
                    <b>PCKG<?=$package->id?></b>
                  </h6>
                  <div class="separator ft-size12"></div>
                  <h6 class="grey-text ft-size12">Name </h6>
                  <h6><b><?=$package->name?></b></h6>
                  <div class="separator"></div>
                  <h6 class="grey-text ft-size12">Device Max</h6>
                  <h6><b><?=$package->device_max?> Device</b></h6>
                  <div class="separator"></div>
                  <h6 class="grey-text ft-size12">Subscription Date</h6>
                  <h6><b><?=$package->date_time?></b></h6>
                  <div class="separator"></div>

                  <div style="height: 30px;"></div>
                  <a data-portfolioid="8048863" value="142551109531" class="btn btn-danger btn-block py-3" href="./change_package">Change Package</a>
                  <div class="text-center" style="margin-top: 10px;">
                  <!-- <a href="#"><button class="btn btn-block py-3" style="color: rgb(219, 69, 64);">Hapus Nomor Layanan</button> </a> -->
                </div>
              </div>
            </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <div class="card-me" style="padding:20px">
                  <div class="col">
                    <h5><b>Client Data</b></h5>
                    <div class="separator"></div>
                    <span class="grey-text">Name</span>
                    <h6><b><?=$current_user->email?></b></h6>
                    <div class="separator"></div>
                    <h6 class="grey-text">Phone Number</h6>
                    <h6><b>-</b></h6>
                    <div class="separator"></div>
                    <h6 class="grey-text">E-mail</h6>
                    <h6><b><?=$current_user->email?></b></h6>
                  </div></div>
                  </div>
                </div>
              </div>

          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © kejarkoding.com 2021</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Thanks to <a href="#" target="_blank">Allah Ta'ala </a> for Everiting</span>

          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>



    <div class="modal" id="mymodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Billing Whatsva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <iframe width="100%" style="min-height:700px" height="100%" id="iframeLoad" src="" frameborder="0" allowfullscreen></iframe>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>