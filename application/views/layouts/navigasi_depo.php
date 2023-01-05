<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url("index.php/dashboard")?>">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item <?=($menu=="device")?'active':'';?>">
              <a class="nav-link" href="<?=base_url("index.php/device_depo")?>">
                <span class="menu-title">Devices</span>
                <i class="mdi mdi-cellphone-iphone menu-icon"></i>
              </a>
            </li>
            <li class="nav-item sidebar-actions">
              <span class="nav-link">
               
                <div style="margin-top:-20px">
                  <div class="border-bottom">
                    <p class="text-secondary mb-2">Billing</p>
                  </div>
               
                </div>
              </span>
            </li>
            <li class="nav-item <?=($menu=="billing")?'active':'';?>">
              <a class="nav-link" href="<?=base_url("index.php/billing_depo")?>">
                <span class="menu-title">Billing</span>
                <i class="mdi mdi-currency-usd menu-icon"></i>
              </a>
            </li>

          </ul>
        </nav>
