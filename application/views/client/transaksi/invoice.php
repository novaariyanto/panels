<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap-redirect:
// https://docs.midtrans.com/en/snap/integration-guide?id=alternative-way-to-display-snap-payment-page-via-redirect

namespace Midtrans;

require_once dirname(__FILE__) . '/../../../libraries/midtrans-php/Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = $server_key;

// can find in Merchant Portal -> Settings -> Access keys

Config::$clientKey = $client_key;

// Add new notification url(s) alongside the settings on Midtrans Dashboard Portal (MAP)
Config::$appendNotifUrl = $url_handle_notification;
// Use new notification url(s) disregarding the settings on Midtrans Dashboard Portal (MAP)
Config::$overrideNotifUrl = $url_handle_notification;

//     // Add new notification url(s) alongside the settings on Midtrans Dashboard Portal (MAP)
// Config::$appendNotifUrl =   base_url('/index.php/io/midtrans');
//     // Use new notification url(s) disregarding the settings on Midtrans Dashboard Portal (MAP)
//     Config::$overrideNotifUrl =   base_url('/index.php/io/midtrans');
  
// non-relevant function only used for demo/example purpose
printExampleWarningMessage();


// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;
// Uncomment for production environment
// Config::$isProduction = true;

// Uncomment to enable sanitization
// Config::$isSanitized = true;

// Uncomment to enable 3D-Secure
// Config::$is3ds = true;

// Required

// Fill SNAP API parameter
$params = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

// try {
    
//     // Get Snap Payment Page URL
//     $paymentUrl = Snap::createTransaction($params)->redirect_url;
  
//     // Redirect to Snap Payment Page
//     header('Location: ' . $paymentUrl);
// }
// catch (\Exception $e) {
//     echo $e->getMessage()+"hello";
// }

// function printExampleWarningMessage() {
//     if (strpos(Config::$serverKey, $server_key) != false ) {
//         echo "<code>";
//         echo "<h4>Please set your server key from sandbox</h4>";
//         echo "In file: " . __FILE__;
//         echo "<br>";
//         echo "<br>";
//         die();
//     } 
// }





$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($params);
}
catch (\Exception $e) {
    echo $e->getMessage();
}
echo "snapToken = ".$snap_token;

function printExampleWarningMessage() {
    if (strpos(Config::$serverKey, 'your ') != false ) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
        die();
    } 
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
        <?php $this->load->view('layouts/navigasi',['menu'=>'billing']) ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="page-header">
              <h3 class="page-title">
                </span> Invoice
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Invoice</a></li>
                  <li class="breadcrumb-item active" aria-current="page"></li>
                </ul>
              </nav>
            </div>
           
            <div class="row">
                
            <div class="col-lg-12 grid-margin stretch-card">
            <div class="card col-12">
          
            <?php
             function rupiah($angka){
                            
                $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
                return $hasil_rupiah;
              
              }
             
                $value = $devices;
             
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
            ?>
            <div class="card-body">
                <div class="row" id="printarea404">
                    <div class="container bootstrap snippets bootdeys" >
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-default invoice" id="invoice">
                                    <div class="panel-body">
                                        <div class="invoice-ribbon">
                                          
                                        </div>
                                        <div class="row">

                                            <div class="col-sm-9 top-left">
                                               <img src="./../../../assets/img/brand/whatsva_brand.png" alt="" srcset="" style="height:100px;">
                                            </div>

                                            <div class="col-sm-3 top-right">
                                               <span>Invoice Code : <h3 class="marginright"><?= $value->kode_transaksi?></h3></span> 
                                                <span class="marginright"><?=substr($value->date_time,0,10)?></span> <br>
                                                <span class="marginright">Status: <?= $status_show?></span>
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="row">

                                           
                                            <div class="col-4 ">
                                                <p style="font-size:14px;font-weight:bold" class="lead marginbottom">Invoiced To : </p>
                                                  <span><?=$value->username?><br>
                                                Phone: <?=$value->phone_number?> <br>
                                                Email: <?=$value->email?> </span>

                                            </div>

                                            <div class="col-4 from">
                                                <p style="font-size:14px;font-weight:bold" class="lead marginbottom">Pay To :</p>
                                               <span> Kejarkoding <br>
                                                Jl. P. Diponegoro No.153, Parenggan <br>
                                                Pati Wetan, Kec. Pati <br>
                                                Kabupaten Pati, Jawa Tengah 59119</span>
                                               

                                            </div>


                                        </div>

                                        <div class="row table-row">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width:5%">#</th>
                                                        <th style="width:50%">Item</th>
                                                        <th class="text-right" style="width:15%">Quantity</th>
                                                        <th class="text-right" style="width:15%">Unit Price</th>
                                                        <th class="text-right" style="width:15%">Total Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">1</td>
                                                        <td><?=$value->package_name?></td>
                                                        <td class="text-right">1</td>
                                                        <td class="text-right"><?=rupiah($value->price_package)?></td>
                                                        <td class="text-right"><?=rupiah($value->price_package)?></td>
                                                    </tr>
  <tr>
                                                        <td colspan="3"></td>
                                                      
                                                        <td class="text-right">Sub Total</td>
                                                        <td class="text-right"><?=rupiah($value->price_package)?></td>
                                                    </tr>
                                                      <tr>
                                                        <td colspan="3"></td>
                                                      
                                                        <td class="text-right">0.00% PPN</td>
                                                        <td class="text-right">0</td>
                                                    </tr>
                                                     <tr>
                                                        <td colspan="3"></td>
                                                      
                                                        <td class="text-right">Total</td>
                                                        <td class="text-right"><?=rupiah($value->price_package)?></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>

                                       

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    if($value->status_paid !== "3"){
                        ?>
                         <button onclick="paybill('<?=$snap_token;?>')" class="btn btn-primary btn-sm"><i
                            class="fa fa-print"></i> Pay</button> <span style="width:10px"></span>

                            <a href="<?php echo base_url().'index.php/payment/paypal/buyProduct/'.$value->kode_transaksi; ?>" class="btn btn-warning btn-sm"><i
                            class="fa fa-print"></i>Pay with Paypal</a> <span style="width:10px"></span>
                        <?php 
                    }
                    ?>
                    <button onclick="printDiv('printarea404')" class="btn btn-success btn-sm" id="invoice-print"><i
                            class="fa fa-print"></i> Print Invoice</button>
                   
                </div>



                <!-- /.form group -->


            </div>
            </form>
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