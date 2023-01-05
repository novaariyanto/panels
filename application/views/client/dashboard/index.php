<?php
 function rupiah($angka){
                            
  $hasil_rupiah = "Rp. " . number_format($angka,0,',','.');
  return $hasil_rupiah;

}
?>

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
                  <p class="mb-1 text-black"><?=@$current_user->email?></p>
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
        <?php 
        if(@$current_user->level == "4"){
          // user deposit
          $this->load->view('layouts/navigasi_depo',['menu'=>'dashboard']);
        }else{
          $this->load->view('layouts/navigasi',['menu'=>'dashboard']);
        }
       
         ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Your <?=@$setting->app_name;?>
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Dashboard <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="row">
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img  src="<?=base_url("assets/purple/assets/images/dashboard/circle.svg")?>"  class="card-img-absolute" alt="circle-image" />
                    Nomor Aktif
                    <h2 class="mb-3"><?=$nomor_aktif?></h2>
                    <p class="card-text"> </p>
                   
                  </div>
                </div>
              </div>
                 <div class="col-md-4 grid-margin stretch-card">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img  src="<?=base_url("assets/purple/assets/images/dashboard/circle.svg")?>"  class="card-img-absolute" alt="circle-image" />
                    Nomor Belum Aktif
                    <h2 class="mb-3"><?=$nomor_belum?></h2>
                    <p class="card-text"> </p>
                   
                  </div>
                </div>
              </div>
               <div class="col-md-4 grid-margin stretch-card">
                <div class="card bg-gradient-warning card-img-holder text-white">
                  <div class="card-body">
                    <img  src="<?=base_url("assets/purple/assets/images/dashboard/circle.svg")?>"  class="card-img-absolute" alt="circle-image" />
                    Proses Checking 
                      <h2 class="mb-3"><?=$nomor_checking?></h2>
                    <p class="card-text"> </p>
                   
                  </div>
                </div>
              </div> 
             
             
              </div>
            </div>
            <div class="col-md-12">
           
          
            <div class="row">
           
        
            
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
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>