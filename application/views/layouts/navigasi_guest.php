<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url("index.php/guest_dashboard")?>">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item <?=($menu=="device")?'active':'';?>">
              <a class="nav-link" href="<?=base_url("index.php/guest_devices")?>">
                <span class="menu-title">Device</span>
                <i class="mdi mdi-cellphone-iphone menu-icon"></i>
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
              <a class="nav-link" href="<?=base_url('index.php/guest_bulks')?>">
                <span class="menu-title">BroadCast</span>
                <i class="mdi mdi-send menu-icon"></i>
              </a>
            </li>
            <li class="nav-item <?=($menu=="group" ||$menu=="contact" )?'active':'';?>"style="margin-top:-20px">
              <a class="nav-link" href="<?=base_url('index.php/guest_list')?>">
              <span class="menu-title">List Contact</span>
                <i class="mdi mdi-account-box menu-icon"></i>
              </a>
            </li>
          
          
            <!-- <li class="nav-item sidebar-actions">
              <span class="nav-link">
               
                <div style="margin-top:-20px">
                  <div class="border-bottom">
                    <p class="text-secondary mb-2">Tools</p>
                  </div>
               
                </div>
              </span>
            </li>
         
            <li class="nav-item">
              <a class="nav-link" href="https://documenter.getpostman.com/view/6198796/U16opPKp" target="_blank">
                <span class="menu-title">Documentation</span>
                <i class="mdi mdi-file-document-box menu-icon"></i>
              </a>
            </li> -->
          </ul>
        </nav>
