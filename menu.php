<style>
    .badge {
        padding: .1rem .55rem !important;
    }
    </style>
<div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="assets/images/logo.png" alt="" srcset="">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class='sidebar-title'>Main Menu</li>
                        <li class="sidebar-item <?php active('index.php');?> ">
                            <a href="index.php" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?php active('member_list.php');?> ">
                            <a href="member_list.php" class='sidebar-link'>
                                <i data-feather="inbox" width="20"></i>
                                <span>ผู้ใช้งาน</span>
                            </a>
                        </li>
        
                        <li class="sidebar-item <?php active('category_list.php');?> ">
                            <a href="category_list.php" class='sidebar-link'>
                                <i data-feather="award" width="20"></i>
                                <span>หมวดหมู่</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?php active('product_list.php');?> ">
                            <a href="product_list.php" class='sidebar-link'>
                                <i data-feather="at-sign" width="20"></i>
                                <span>คลังสินค้า</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?php active('list.php');?> ">
                            <a href="list.php" class='sidebar-link'>
                                <i data-feather="heart" width="20"></i>
                                <span>เข้าStock</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?php active('list2.php');?> ">
                            <a href="list2.php" class='sidebar-link'>
                                <i data-feather="heart" width="20"></i>
                                <span>ออกStock</span>
                            </a>
                        </li>
                      
                      
                        <li class="sidebar-item <?php active('input_report.php');?>">
                            <a href="input_report.php" class='sidebar-link'>
                                <i data-feather="file" width="20"></i>
                                <span>รายงาน</span>
                            </a>

                          

                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
    
