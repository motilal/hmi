<?php
$segment_cntr = $this->uri->segment(2);
$segment_fun = $this->uri->segment(3);

$subadminIndex = ($segment_cntr == 'subadmins' && ($segment_fun == 'index' || $segment_fun == '')) ? 'active' : '';
$subadminAdd = ($segment_cntr == 'subadmins' && $segment_fun == 'add') ? 'active' : '';

$userIndex = ($segment_cntr == 'users' && ($segment_fun == 'index' || $segment_fun == '')) ? 'active' : '';
$userAdd = ($segment_cntr == 'users' && $segment_fun == 'add') ? 'active' : '';

$pageIndex = ($segment_cntr == 'pages' && ($segment_fun == 'index' || $segment_fun == '')) ? 'active' : '';
$pageAdd = ($segment_cntr == 'pages' && $segment_fun == 'manage') ? 'active' : '';

$sliderIndex = ($segment_cntr == 'sliders' && ($segment_fun == 'index' || $segment_fun == '')) ? 'active' : '';
$sliderAdd = ($segment_cntr == 'sliders' && $segment_fun == 'manage') ? 'active' : '';

$packageIndex = ($segment_cntr == 'packages' && ($segment_fun == 'index' || $segment_fun == '')) ? 'active' : '';
$packageCategoryIndex = ($segment_cntr == 'packages' && $segment_fun == 'categories') ? 'active' : '';
$packageAdd = ($segment_cntr == 'packages' && $segment_fun == 'manage') ? 'active' : '';

$bookingIndex = ($segment_cntr == 'bookings' && ($segment_fun == 'index' || $segment_fun == '')) ? 'active' : '';
$bookingAdd = ($segment_cntr == 'bookings' && $segment_fun == 'manage') ? 'active' : '';

$settingIndex = ($segment_cntr == 'settings' && ($segment_fun == 'index' || $segment_fun == '')) ? 'active' : '';
$settingProfile = ($segment_cntr == 'settings' && $segment_fun == 'profile') ? 'active' : '';
$logIndex = ($segment_cntr == 'logs') ? 'active' : '';

$user_permissions = $this->session->userdata('_subadmin_module_permissions');
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo gravatar_url($_UserAuth->email); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info"> 
                <p><?php echo $_UserAuth->first_name . ' ' . $_UserAuth->last_name ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div> 
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php echo $segment_cntr == 'dashboard' ? 'active' : ''; ?>">
                <a href="<?php echo site_url('admin/dashboard'); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
                </a>
            </li> 

            <?php if (is_allow_admin(FALSE)) { ?>
                <li class="treeview <?php echo $segment_cntr == 'subadmins' ? 'active menu-open' : ''; ?>">
                    <a href="#">
                        <i class="fa fa-user-secret"></i>
                        <span>SubAdmin Manager</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:<?php echo $segment_cntr == 'subadmins' ? 'block' : 'none'; ?>;">
                        <li class="<?php echo $subadminIndex; ?>"><a href="<?php echo site_url('admin/subadmins'); ?>"><i class="fa fa-th-list"></i> Manage SubAdmins</a></li>
                        <li class="<?php echo $subadminAdd; ?>"><a href="<?php echo site_url('admin/subadmins/add'); ?>"><i class="fa fa-plus"></i> Add New SubAdmins</a></li> 
                    </ul>
                </li>
            <?php } ?> 

            <?php if (is_allow_module('user')) { ?>
                <li class="treeview <?php echo $segment_cntr == 'users' ? 'active menu-open' : ''; ?>">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>User Manager</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:<?php echo $segment_cntr == 'users' ? 'block' : 'none'; ?>;">
                        <li class="<?php echo $userIndex; ?>"><a href="<?php echo site_url('admin/users'); ?>"><i class="fa fa-th-list"></i> Manage User</a></li>
                        <li class="<?php echo $userAdd; ?>"><a href="<?php echo site_url('admin/users/add'); ?>"><i class="fa fa-plus"></i> Add New User</a></li> 
                    </ul>
                </li>
            <?php } ?>


            <?php if (is_allow_module('package')) { ?>
                <li class="treeview <?php echo $segment_cntr == 'packages' ? 'active menu-open' : ''; ?>">
                    <a href="#">
                        <i class="fa fa-product-hunt"></i>
                        <span>Manage Packages</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:<?php echo $segment_cntr == 'packages' ? 'block' : 'none'; ?>;">
                        <?php if (is_allow_action('package-index')) { ?>
                            <li class="<?php echo $packageIndex; ?>"><a href="<?php echo site_url('admin/packages'); ?>"><i class="fa fa-th-list"></i> Manage Package</a></li>
                        <?php } ?>
                        <?php if (is_allow_action('package-category-index')) { ?>
                            <li class="<?php echo $packageCategoryIndex; ?>"><a href="<?php echo site_url('admin/packages/categories'); ?>"><i class="glyphicon glyphicon-tags"></i> Manage Categories</a></li>
                        <?php } ?>
                        <?php if (is_allow_action('package-add')) { ?>
                            <li class="<?php echo $packageAdd; ?>"><a href="<?php echo site_url('admin/packages/manage'); ?>"><i class="fa fa-plus"></i> Add New Package</a></li> 
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>


            <?php if (is_allow_module('booking')) { ?>
                <li class="treeview <?php echo $segment_cntr == 'bookings' ? 'active menu-open' : ''; ?>">
                    <a href="#">
                        <i class="fa fa-opencart"></i>
                        <span>Manage Booking</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:<?php echo $segment_cntr == 'bookings' ? 'block' : 'none'; ?>;">
                        <?php if (is_allow_action('booking-index')) { ?>
                            <li class="<?php echo $bookingIndex; ?>"><a href="<?php echo site_url('admin/bookings'); ?>"><i class="fa fa-th-list"></i> Manage Booking</a></li>
                        <?php } ?> 
                        <?php if (is_allow_action('booking-add')) { ?>
                            <li class="<?php echo $bookingAdd; ?>"><a href="<?php echo site_url('admin/bookings/manage'); ?>"><i class="fa fa-plus"></i> Add New Booking</a></li> 
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?> 

            <?php if (is_allow_module('city')) { ?>    
                <li class="<?php echo $segment_cntr == 'cities' ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('admin/cities'); ?>">
                        <i class="fa fa-institution"></i> <span>Manage Cities</span> 
                    </a>
                </li>
            <?php } ?>

            <?php if (is_allow_module('slider')) { ?>
                <li class="treeview <?php echo $segment_cntr == 'sliders' ? 'active menu-open' : ''; ?>">
                    <a href="#">
                        <i class="fa fa-image"></i>
                        <span>Sliders</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:<?php echo $segment_cntr == 'sliders' ? 'block' : 'none'; ?>;">
                        <?php if (is_allow_action('slider-index')) { ?>
                            <li class="<?php echo $sliderIndex; ?>"><a href="<?php echo site_url('admin/sliders'); ?>"><i class="fa fa-th-list"></i> Manage Slider</a></li>
                        <?php } ?>
                        <?php if (is_allow_action('slider-add')) { ?>
                            <li class="<?php echo $sliderAdd; ?>"><a href="<?php echo site_url('admin/sliders/manage'); ?>"><i class="fa fa-plus"></i> Add New Slide</a></li> 
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?> 

            <?php if (is_allow_module('page')) { ?>
                <li class="treeview <?php echo $segment_cntr == 'pages' ? 'active menu-open' : ''; ?>">
                    <a href="#">
                        <i class="fa fa-file-text-o"></i>
                        <span>Static Pages</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:<?php echo $segment_cntr == 'pages' ? 'block' : 'none'; ?>;">
                        <?php if (is_allow_action('page-index')) { ?>
                            <li class="<?php echo $pageIndex; ?>"><a href="<?php echo site_url('admin/pages'); ?>"><i class="fa fa-th-list"></i> Manage Pages</a></li>
                        <?php } ?>
                        <?php if (is_allow_action('page-add')) { ?>
                            <li class="<?php echo $pageAdd; ?>"><a href="<?php echo site_url('admin/pages/manage'); ?>"><i class="fa fa-plus"></i> Add New Page</a></li> 
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>   

            <?php if (is_allow_module('email templates')) { ?>    
                <li class="<?php echo $segment_cntr == 'email_templates' ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('admin/email_templates'); ?>">
                        <i class="fa fa-envelope-o"></i> <span>Email Templates</span> 
                    </a>
                </li>
            <?php } ?>  

            <?php if (is_allow_module('contact')) { ?>    
                <li class="<?php echo $segment_cntr == 'contacts' ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('admin/contacts'); ?>">
                        <i class="fa fa-phone"></i> <span>Contacts</span> 
                    </a>
                </li>
            <?php } ?>

            <li class="treeview <?php echo in_array($segment_cntr, array('settings', 'logs')) ? 'active menu-open' : ''; ?>">
                <a href="#">
                    <i class="fa fa-gear"></i>
                    <span>Setting</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display:<?php echo in_array($segment_cntr, array('settings', 'visitors', 'flash_messages', 'logs', 'database_backups')) ? 'block' : 'none'; ?>;"> 
                    <li class="<?php echo $settingProfile; ?>"><a href="<?php echo site_url('admin/settings/profile'); ?>"><i class="fa fa-user-plus"></i> Manage Profile</a></li>
                    <?php if (is_allow_action('settings-index')) { ?>
                        <li class="<?php echo $settingIndex; ?>">
                            <a href="<?php echo site_url('admin/settings/index'); ?>"><i class="fa fa-gear"></i> Site Settings</a>
                        </li> 
                    <?php } ?> 

                    <?php if (is_allow_admin(FALSE)) { ?>  
                        <li class="<?php echo $logIndex; ?>">
                            <a href="<?php echo site_url('admin/logs'); ?>"><i class="fa fa-bug"></i> System Error Log</a>
                        </li>   
                    <?php } ?> 
                </ul>
            </li> 
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>