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
                <span class="menu-title">Device</span>
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
              <a class="nav-link" href="<?=base_url("index.php/billings")?>">
                <span class="menu-title">Billing</span>
                <i class="mdi mdi-currency-usd menu-icon"></i>
              </a>
            </li>

            <li class="nav-item sidebar-actions">
              <span class="nav-link">
               
                <div style="margin-top:-20px">
                  <div class="border-bottom">
                    <p class="text-secondary mb-2">BROADCAST</p>
                  </div>
               
                </div>
              </span>
            </li>
            <li class="nav-item <?=($menu=="bulk")?'active':'';?>">
              <a class="nav-link" href="<?=base_url('index.php/bulk')?>">
                <span class="menu-title">BroadCast</span>
                <i class="mdi mdi-send menu-icon"></i>
              </a>
            </li>
            <li class="nav-item <?=($menu=="group" ||$menu=="contact" )?'active':'';?>"style="margin-top:-20px">
              <a class="nav-link" href="<?=base_url('index.php/group')?>">
              <span class="menu-title">List</span>
                <i class="mdi mdi-account-box menu-icon"></i>
              </a>
            </li>
            <li class="nav-item sidebar-actions">
              <span class="nav-link">
               
                <div style="margin-top:-20px">
                  <div class="border-bottom">
                    <p class="text-secondary mb-2">Message</p>
                  </div>
               
                </div>
              </span>
            </li>
            <li class="nav-item <?=($menu=="message")?'active':'';?>">
              <a class="nav-link" href="<?=base_url('index.php/messageOut')?>">
                <span class="menu-title">Message</span>
                <i class="mdi mdi-send menu-icon"></i>
              </a>
            </li>
          
            <li class="nav-item sidebar-actions">
              <span class="nav-link">
               
                <div style="margin-top:-20px">
                  <div class="border-bottom">
                    <p class="text-secondary mb-2">Tools</p>
                  </div>
               
                </div>
              </span>
            </li>
            <li class="nav-item <?=($menu=="webhook")?'active':'';?>">
              <a class="nav-link" href="<?=base_url('index.php/webhook')?>">
                <span class="menu-title">Webhook</span>
                <i class="mdi mdi-access-point menu-icon"></i>
              </a>
            </li>
            <li class="nav-item <?=($menu=="autoreply")?'active':'';?>">
              <a class="nav-link" href="<?=base_url('index.php/autoreply')?>">
                <span class="menu-title">Autoreply</span>
                <i class="mdi mdi-reply  menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://documenter.getpostman.com/view/6198796/U16opPKp" target="_blank">
                <span class="menu-title">Documentation</span>
                <i class="mdi mdi-file-document-box menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>
