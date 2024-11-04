<!-- SIDE-BAR -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<div class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
		<div class="sidebar-brand-icon rotate-n-0">
            <img src="<?php echo e(URL::asset('assets/img/brand/logo-3.png')); ?>" class="header-brand-img light-logo1" alt="logo" style="width: 60px">
		</div>
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="<?php echo e(URL::asset('assets/img/brand/logo-2.png')); ?>" class="header-brand-img light-logo1" alt="logo" style="width: 120px">
        </div>
	</div>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Nav Item - Dashboard -->
	<li class="nav-item <?php echo e($nav=='dashboard' ? 'active':''); ?>">
		<a class="nav-link" href="<?php echo e(url('/admin.dashboard-view/dashboard')); ?>">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span><?php echo e(__('userpage.home')); ?></span>
		</a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<li class="nav-item <?php echo e($nav=='user-list' ? 'active':''); ?>">
		<a class="nav-link" href="<?php echo e(url('/admin.user-view/user-list')); ?>">
			<i class="fas fa-fw fa-user-injured"></i>
			<span><?php echo e(__('userpage.user_common')); ?></span>
		</a>
	</li>
	<li class="nav-item <?php echo e($nav=='user-revenue' ? 'active':''); ?>">
		<a class="nav-link" href="<?php echo e(url('/admin.user-revenue-view/user-revenue')); ?>">
			<i class="fas fa-fw fa-chart-area"></i>
			<span><?php echo e(__('userpage.user_revenue')); ?></span>
		</a>
	</li>
	<li class="nav-item <?php echo e(($nav=='couponly' || $nav=='userly') ? 'active' : ''); ?>">
		<a class="nav-link collapsed" href="<?php echo e(url('/admin.revenue-coupon-view/couponly')); ?>" data-toggle="collapse" data-target="#collapseTwo"
			aria-expanded="true" aria-controls="collapseTwo">
			<i class="fas fa-fw fa-chart-area"></i>
			<span><?php echo e(__('userpage.coupon_income')); ?></span>
		</a>
		<div id="collapseTwo" class="collapse <?php echo e(($nav=='couponly' || $nav=='userly') ? 'show' : ''); ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item <?php echo e($nav=='couponly' ? 'active':''); ?>" href="<?php echo e(url('/admin.revenue-coupon-view/couponly')); ?>"><?php echo e(__('userpage.coupon_bycoupon')); ?></a>
				<a class="collapse-item <?php echo e($nav=='userly' ? 'active':''); ?>" href="<?php echo e(url('/admin.revenue-user-view/userly')); ?>"><?php echo e(__('userpage.coupon_byuser')); ?></a>
			</div>
		</div>
	</li>

	<hr class="sidebar-divider">

	<!-- Nav Item - Utilities Collapse Menu -->
	<li class="nav-item <?php echo e(($nav=='agent' || $nav=='revenue' || $nav=='request' || $nav=='complete' || $nav=='add') ? 'active' : ''); ?>">
		<a class="nav-link collapsed" href="<?php echo e(url('/admin.agent-view/agent')); ?>" data-toggle="collapse" data-target="#collapseUtilities"
			aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-fw fa-user-friends"></i>
			<span><?php echo e(__('userpage.agent')); ?></span>
		</a>
		<div id="collapseUtilities" class="collapse <?php echo e(($nav=='agent' || $nav=='revenue' || $nav=='request' || $nav=='complete' || $nav=='add') ? 'show' : ''); ?>" aria-labelledby="headingUtilities"
			data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item <?php echo e($nav=='agent' ? 'active':''); ?>" href="<?php echo e(url('/admin.agent-view/agent')); ?>"><?php echo e(__('userpage.agent')); ?></a>
				<a class="collapse-item <?php echo e($nav=='revenue' ? 'active':''); ?>" href="<?php echo e(url('/admin.agent-revenue-view/revenue')); ?>"><?php echo e(__('userpage.agent_profit')); ?></a>
				<a class="collapse-item <?php echo e($nav=='request' ? 'active':''); ?>" href="<?php echo e(url('/admin.agent-calc-request/request')); ?>"><?php echo e(__('userpage.agent_settlement_request')); ?></a>
				<a class="collapse-item <?php echo e($nav=='complete' ? 'active':''); ?>" href="<?php echo e(url('/admin.agent-calc-complete/complete')); ?>"><?php echo e(__('userpage.agent_completion_of_liquidation')); ?></a>
				<a class="collapse-item <?php echo e($nav=='add' ? 'active':''); ?>" href="<?php echo e(url('/admin.agent-add-view/add')); ?>"><?php echo e(__('userpage.agent_add')); ?></a>
			</div>
		</div>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<li class="nav-item <?php echo e($nav=='usage' ? 'active':''); ?>">
		<a class="nav-link" href="<?php echo e(url('/admin.usage-status-view/usage')); ?>">
			<i class="fas fa-fw fa-table"></i>
			<span><?php echo e(__('userpage.usage')); ?></span>
		</a>
	</li>
	<li class="nav-item <?php echo e($nav=='server' ? 'active':''); ?>">
		<a class="nav-link" href="<?php echo e(url('/admin.server-status-view/server')); ?>">
			<i class="fas fa-fw fa-server"></i>
			<span><?php echo e(__('userpage.server_status')); ?></span>
		</a>
	</li>
	<li class="nav-item <?php echo e($nav=='notifications' ? 'active':''); ?>">
		<a class="nav-link" href="<?php echo e(url('/admin.notice-view/notifications')); ?>">
			<i class="fas fa-fw fa-newspaper"></i>
			<span><?php echo e(__('userpage.notice')); ?></span>
		</a>
	</li>
	<li class="nav-item <?php echo e($nav=='create-coupon' ? 'active':''); ?>">
		<a class="nav-link" href="<?php echo e(url('/admin.coupon-create-view/create-coupon')); ?>">
			<i class="fas fa-fw fa-ticket-alt"></i>
			<span><?php echo e(__('userpage.create_coupon')); ?></span>
		</a>
	</li>
	<li class="nav-item <?php echo e($nav=='point-current' || $nav=='point-history' ? 'active':''); ?>">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
			aria-expanded="true" aria-controls="collapsePages">
			<i class="fas fa-fw fa-divide"></i>
			<span><?php echo e(__('userpage.point_pay')); ?></span>
		</a>
		<div id="collapsePages" class="collapse <?php echo e(($nav=='point-current' || $nav=='point-history') ? 'show' : ''); ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item <?php echo e($nav=='point-current' ? 'active':''); ?>" href="<?php echo e(url('/admin.point-current-view/point-current')); ?>"><?php echo e(__('userpage.point_current')); ?></a>
				<a class="collapse-item <?php echo e($nav=='point-history' ? 'active':''); ?>" href="<?php echo e(url('/admin.point-history-view/point-history')); ?>"><?php echo e(__('userpage.point_history')); ?></a>
			</div>
		</div>
	</li>
	<li class="nav-item <?php echo e($nav=='permission' ? 'active':''); ?>">
		<a class="nav-link" href="<?php echo e(url('/admin.using-permission-view/permission')); ?>">
			<i class="fas fa-fw fa-people-arrows"></i>
			<span><?php echo e(__('userpage.using_permission')); ?></span>
		</a>
	</li>
	<li class="nav-item <?php echo e($nav=='params' ? 'active':''); ?>">
		<a class="nav-link" href="<?php echo e(url('/admin.parameter-view/params')); ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span><?php echo e(__('userpage.parameter')); ?></span>
		</a>
	</li>
	<li class="nav-item <?php echo e($nav=='emails' ? 'active':''); ?>">
		<a class="nav-link" href="<?php echo e(url('/admin.email-edit-view/emails')); ?>">
			<i class="fas fa-fw fa-mail-bulk"></i>
			<span><?php echo e(__('userpage.email_send')); ?></span>
		</a>
	</li>
    <li class="nav-item <?php echo e($nav=='address' ? 'active':''); ?>">
        <a class="nav-link" href="<?php echo e(url('/admin.address-view/address')); ?>">
            <i class="fas fa-fw fa-id-card"></i>
            <span><?php echo e(__('userpage.deposit_address')); ?></span>
        </a>
    </li>
    <li class="nav-item <?php echo e($nav=='broker' ? 'active':''); ?>">
        <a class="nav-link" href="<?php echo e(url('/admin.brokerid-view/broker')); ?>">
            <i class="fas fa-fw fa-id-card"></i>
            <span>Broker ID</span>
        </a>
    </li>

	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">
	<li class="nav-item">
		<a class="nav-link" href="<?php echo e(url('/admin.logout')); ?>">
			<i class="fas fa-fw fa-sign-out-alt"></i>
			<span><?php echo e(__('userpage.logout')); ?></span>
		</a>
	</li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- SIDE-BAR CLOSED -->
<?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>