<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            
            <li class="nav-item <?=($menu=="dashboard")?'active':'';?>">
              <a class="nav-link" href="<?=base_url("index.php/dashboard")?>">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
          
            <li class="nav-item <?=($menu=="user")?'active':'';?>">
              <a class="nav-link" href="<?=base_url("index.php/user")?>">
                <span class="menu-title">User</span>
                <i class="mdi mdi-account menu-icon"></i>
              </a>
            </li>
            <li class="nav-item <?=($menu=="package")?'active':'';?>">
              <a class="nav-link" href="<?=base_url("index.php/packages")?>">
                <span class="menu-title">Package</span>
                <i class="mdi mdi-package menu-icon"></i>
              </a>
            </li>
            <li class="nav-item <?=($menu=="transaksi")?'active':'';?>">
              <a class="nav-link" href="<?=base_url("index.php/transactions")?>">
                <span class="menu-title">Transactions</span>
                <i class="mdi mdi-currency-usd menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>