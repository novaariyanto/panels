
         <!-- partial -->
   <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php $this->load->view('layouts/navigasi',['menu'=>'device']) ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="page-header">
              <h3 class="page-title">
                </span> Akun Dompul
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Device</a></li>
                  <li class="breadcrumb-item active" aria-current="page">List</li>
                </ul>
              </nav>
            </div>
            <a href="<?=base_url('/index.php/device/add')?>" class="btn btn-sm btn-primary" style="margin-top:-35px;margin-right:-4px" >Add </a>
          
            <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                   <div class="table-responsive">
                     <span style="color:red"> <?php echo $this->session->flashdata('message_add_device_error'); ?></span>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Nomor Dompul</th>
                          <th>Token</th>
                          <th>Expired</th>
                        
                          <th>Status</th>
                          <th>Option</th>
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
                        
                          foreach ($devices as $value) {
                             
                              $i += 1;
                              $status = $value->status;
                              $status_show = "";
                              $btn_scan = "";
                            
                              if($status === "1"){
                                $status_show = '<label class="badge badge-warning">UnPaired</label>';
                                $btn_scan = '<a class="btn btn-primary btn-sm" href="./device/authqr/'.$value->id.'"><i class="mdi mdi-qrcode-scan icon"></i></a>';
                              }else if($status === "2"){
                                $status_show = '<label class="badge badge-info">Paired</label>';
                                $btn_scan = '<a class="btn btn-danger btn-sm" href="./device/logout/'.$value->id.'">Logout</a>';
                              }else{
                                $status_show = '<label class="badge badge-success">Active</label>';
                                $btn_scan = '<a class="btn btn-warning btn-sm" href="./device/edit/'.$value->id.'">Edit</a>';
                                $btn_scan .= '<a class="btn btn-info btn-sm" href="./device/refreshToken/'.$value->id.'">Refresh Token</a>';
                              }
                              
                             
                              echo '<tr>
                          <td>'.$i.'</td>
                          <td>'.$value->nomor.'</td>
                          <td>'.$value->token.'</td>
                   
               
                          <td>'.$value->expired.'</td>
                          <td>'. $status_show.'</td>
                          <td>'. $btn_scan.'</td>
                        </tr>';
                          } ?>
                      
                       
                      </tbody>
                    </table>
                    
                   </div>
                   <?=$buttonNext?>
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