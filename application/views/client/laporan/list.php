
         <!-- partial -->
   <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php $this->load->view('layouts/navigasi',['menu'=>'laporan']) ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="page-header">
              <h3 class="page-title">
                </span> Laporan
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                </ul>
              </nav>
            </div>
          
            <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
                <div class="card">

                <div class="card-body">

                  <form class="forms-sample" method="GET" action="">
                      <div class="form-group row">
                        <div class="col-sm-4">  <select name="status" class="form-control" >
                             <option value="">Pilih Status</option>
                             <option <?=(@$_GET['status']=="Sudah")?"selected":"";?> value="Sudah">Sudah</option>
                             <option <?=(@$_GET['status']=="Belum")?"selected":"";?> value="Belum">Belum</option>
                           </select></div>
                        <div class="col-sm-5">
                         

                          <input type="date" class="form-control"  name="tanggal"  id="exampleInputUsername2" placeholder="ex : 08753610348xx" value="<?=@$_GET['tanggal'];?>">
                         
                      </div>
                      <div class="col-sm-3"> <button type="submit" class="btn btn-gradient-primary mr-2">Cari</button></div>
                    
                         </div>
                      
                     
                    </form>
              
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
                        
                          foreach ($devices as $value) {
                             
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