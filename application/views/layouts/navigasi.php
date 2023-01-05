
<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url("index.php/dashboard")?>">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item <?=($menu=="device")?'active':'';?>">
              <a class="nav-link" href="<?=base_url("index.php/device")?>">
                <span class="menu-title">Akun Dompul</span>
                <i class="mdi mdi-account menu-icon"></i>
              </a>
            </li>
            <li class="nav-item sidebar-actions">
              <span class="nav-link">
               
                <div style="margin-top:-20px">
                  <div class="border-bottom">
                    <p class="text-secondary mb-2">Laporan</p>
                  </div>
               
                </div>
              </span>
            </li>
            <li class="nav-item <?=($menu=="laporan")?'active':'';?>">
              <a class="nav-link" href="<?=base_url("index.php/laporan")?>">
                <span class="menu-title">Data Nomor</span>
                <i class="mdi mdi-package menu-icon"></i>
              </a>
            </li>
            <!-- <li class="nav-item sidebar-actions">
              <span class="nav-link">
               
                <div style="margin-top:-20px">
                  <div class="border-bottom">
                    <p class="text-secondary mb-2">Billing</p>
                  </div>
               
                </div>
              </span>
            </li>
            <li class="nav-item <?=($menu=="billing")?'active':'';?>">
              <a class="nav-link" href="<?=base_url("index.php/billings")?>">
                <span class="menu-title">Billing</span>
                <i class="mdi mdi-currency-usd menu-icon"></i>
              </a>
            </li>
 -->
           
         
            <li class="nav-item sidebar-actions">
              <span class="nav-link">
               
                <div style="margin-top:-20px">
                  <div class="border-bottom">
                    <p class="text-secondary mb-2">Cek Nomor</p>
                  </div>
               
                </div>
              </span>
            </li>
            <li class="nav-item <?=($menu=="singlenomor")?'active':'';?>">
              <a class="nav-link" href="<?=base_url('index.php/singlenomor')?>">
                <span class="menu-title">Single Nomor</span>
                <i class="mdi mdi-account-box menu-icon"></i>
              </a>
            </li>
            <li class="nav-item <?=($menu=="multinomor")?'active':'';?>">
              <a class="nav-link" href="<?=base_url('index.php/multinomor')?>">
                <span class="menu-title">Multi Nomor</span>
                <i class="mdi mdi-account-box menu-icon"></i>
              </a>
            </li>
          
          
          </ul>
        </nav>
