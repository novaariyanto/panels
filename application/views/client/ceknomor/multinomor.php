

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
        <?php $this->load->view('layouts/navigasi',['menu'=>'multinomor']) ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="page-header">
              <h3 class="page-title">
                </span> Akun dompul
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Akun dompul</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ul>
              </nav>
            </div>
            <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <form class="forms-sample" method="post" action="">
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Multi Nomor <br> <span style="color:red"></span></label>
                        <div class="col-sm-9">
                          <textarea name="nomor" class="form-control" id="" placeholder="ex : 08753610348xx,0819283913"></textarea>
                          <!-- <input type="text"  name="nomor" id="exampleInputUsername2" placeholder="ex : 08753610348xx,0819283913" value=""> -->
                         
                      </div>
                    
                         </div>
                      
                      <button type="submit" class="btn btn-gradient-primary mr-2">Cari</button>
                       <a href="<?=base_url("./index.php/multinomor");?>" class="btn btn-info">Refresh</a>
                        <a href="<?=base_url("./index.php/resetnumber");?>" class="btn btn-danger">Reset</a>
                    </form>
              
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                   <div class="table-responsive">
                      <!-- <div class="col-sm-3"> <a href="<?=base_url();?>rechecknumber?tanggal=<?=@$_GET['tanggal'];?> "class="btn btn-gradient-primary mr-2">ReCheck Nomor</a></div> -->
                    
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nomor Hp</th>
                          <th>Status</th>
                          <th>Masa Aktif</th>
                          <th>Tanggal Periksa</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 

                        $page = @$_GET['page'];
                        $page2 = (int)$page + 1;
                          $limit = 10;
                          if(!@$page){
                              $start = 0;
                          }else{
                              $start = $page * $limit;
                              
                          }
                          
                          if(($start+$limit) >= $devices_count){
                              $buttonNext = '<a href="#" class="btn btn-sm">Next</a>';
                          }else{
                              $buttonNext = '<a href="?page='.$page2.'" class="btn btn-sm">Next</a>';
                          }
  
                          $i = $start ;
                        
                          foreach ($devicesa as $value) {
                             
                              $i += 1;
                            
                              echo '<tr>
                          <td>'.$i.'</td>
                          <td>'.$value->nomor.'</td>
                          <td>'.$value->status.'</td>

                          <td>'.$value->tanggal_aktif.'</td>
                          <td>'.$value->tanggal_periksa.'</td>
                   
                        </tr>';
                          } ?>
                      
                       
                      </tbody>
                    </table>
                  
                   </div>
                 
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