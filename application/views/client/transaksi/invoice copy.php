
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
                  <img src="<?=  base_url("assets/purple/assets/images/faces/face1.jpg")?>" alt="image">
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
        <?php $this->load->view('layouts/navigasi',['menu'=>'transaksi']) ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="page-header">
              <h3 class="page-title">
                </span> Billings
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Billings</a></li>
                  <li class="breadcrumb-item active" aria-current="page">List</li>
                </ul>
              </nav>
            </div>
            <a href="<?=base_url('/index.php/billing_panel/add')?>" class="btn btn-sm btn-primary" style="margin-top:-35px;margin-right:-4px" >Add </a>
          
            <div class="row">
                
            <div class="col-lg-12 grid-margin stretch-card">
                
                <div class="card">
                  <div class="card-body">
                   <div class="table-responsive">
                     
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Code</th>
                          <th>Client</th>
                          <th>Package</th>
                          <th>Total Price</th>
                          <th>Discount</th>
                          <th>Status</th>
                          <th>Date</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 

                          function rupiah($angka){
                            
                            $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
                            return $hasil_rupiah;
                          
                          }
                         
                            $value = $devices;
                          print_r($devices);
                              $status = $value->status_paid;
                        
                              $status_show = "";
                              $btn_scan = "";
                            
                              if($status === "3"){
                                $status_show = '<label class="badge badge-success">Paid</label>';
                                $option_btn = '';
                                }else{
                                $status_show = '<label class="badge badge-danger">UnPaid</label>';
                                // $option_btn = '<a class="btn btn-sm btn-primary" href="'.base_url('index.php/billing/proses')."/".$value->id.'" >Pay</a>';
                                $option_btn = '<a class="btn btn-sm btn-primary" onclick="paybilll()" href="#" >Pay</a>';
                              }
                             
                             
                              echo '<tr>
                          <td>'.$value->kode_transaksi.'</td>
                          <td>'.$value->username.'</td>
                          <td>'.$value->package_name.'</td>
                          <td> '.rupiah($value->total_price).'</td>
                          <td>'. rupiah($value->discount).'</td>
                          <td>'. $status_show.'</td>
                          <td>'.substr($value->date_time,0,10).'</td>
                          <td>'. $option_btn.'</td>
                        </tr>';
                         ?>
                      
                       
                      </tbody>
                    </table>
                    
                   </div>
                 
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