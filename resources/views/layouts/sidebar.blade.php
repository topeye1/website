<!-- SIDE-BAR -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<div class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
		<div class="sidebar-brand-icon rotate-n-0">
            <img src="{{URL::asset('assets/img/brand/logo-3.png')}}" class="header-brand-img light-logo1" alt="logo" style="width: 60px">
		</div>
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{URL::asset('assets/img/brand/logo-2.png')}}" class="header-brand-img light-logo1" alt="logo" style="width: 120px">
        </div>
	</div>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Nav Item - Dashboard -->
	<li class="nav-item {{$nav=='dashboard' ? 'active':''}}">
		<a class="nav-link" href="{{ url('/admin.dashboard-view/dashboard') }}">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>{{ __('userpage.home') }}</span>
		</a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<li class="nav-item {{$nav=='user-list' ? 'active':''}}">
		<a class="nav-link" href="{{ url('/admin.user-view/user-list') }}">
			<i class="fas fa-fw fa-user-injured"></i>
			<span>{{ __('userpage.user_common') }}</span>
		</a>
	</li>
	<li class="nav-item {{$nav=='user-revenue' ? 'active':''}}">
		<a class="nav-link" href="{{ url('/admin.user-revenue-view/user-revenue') }}">
			<i class="fas fa-fw fa-chart-area"></i>
			<span>{{ __('userpage.user_revenue') }}</span>
		</a>
	</li>
	<li class="nav-item {{($nav=='couponly' || $nav=='userly') ? 'active' : ''}}">
		<a class="nav-link collapsed" href="{{ url('/admin.revenue-coupon-view/couponly') }}" data-toggle="collapse" data-target="#collapseTwo"
			aria-expanded="true" aria-controls="collapseTwo">
			<i class="fas fa-fw fa-chart-area"></i>
			<span>{{ __('userpage.coupon_income') }}</span>
		</a>
		<div id="collapseTwo" class="collapse {{($nav=='couponly' || $nav=='userly') ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item {{$nav=='couponly' ? 'active':''}}" href="{{ url('/admin.revenue-coupon-view/couponly') }}">{{ __('userpage.coupon_bycoupon') }}</a>
				<a class="collapse-item {{$nav=='userly' ? 'active':''}}" href="{{ url('/admin.revenue-user-view/userly') }}">{{ __('userpage.coupon_byuser') }}</a>
			</div>
		</div>
	</li>

	<hr class="sidebar-divider">

	<!-- Nav Item - Utilities Collapse Menu -->
	<li class="nav-item {{($nav=='agent' || $nav=='revenue' || $nav=='request' || $nav=='complete' || $nav=='add') ? 'active' : ''}}">
		<a class="nav-link collapsed" href="{{ url('/admin.agent-view/agent') }}" data-toggle="collapse" data-target="#collapseUtilities"
			aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-fw fa-user-friends"></i>
			<span>{{ __('userpage.agent') }}</span>
		</a>
		<div id="collapseUtilities" class="collapse {{($nav=='agent' || $nav=='revenue' || $nav=='request' || $nav=='complete' || $nav=='add') ? 'show' : ''}}" aria-labelledby="headingUtilities"
			data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item {{$nav=='agent' ? 'active':''}}" href="{{ url('/admin.agent-view/agent') }}">{{ __('userpage.agent') }}</a>
				<a class="collapse-item {{$nav=='revenue' ? 'active':''}}" href="{{ url('/admin.agent-revenue-view/revenue') }}">{{ __('userpage.agent_profit') }}</a>
				<a class="collapse-item {{$nav=='request' ? 'active':''}}" href="{{ url('/admin.agent-calc-request/request') }}">{{ __('userpage.agent_settlement_request') }}</a>
				<a class="collapse-item {{$nav=='complete' ? 'active':''}}" href="{{ url('/admin.agent-calc-complete/complete') }}">{{ __('userpage.agent_completion_of_liquidation') }}</a>
				<a class="collapse-item {{$nav=='add' ? 'active':''}}" href="{{ url('/admin.agent-add-view/add') }}">{{ __('userpage.agent_add') }}</a>
			</div>
		</div>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<li class="nav-item {{$nav=='usage' ? 'active':''}}">
		<a class="nav-link" href="{{ url('/admin.usage-status-view/usage') }}">
			<i class="fas fa-fw fa-table"></i>
			<span>{{ __('userpage.usage') }}</span>
		</a>
	</li>
	<li class="nav-item {{$nav=='server' ? 'active':''}}">
		<a class="nav-link" href="{{ url('/admin.server-status-view/server') }}">
			<i class="fas fa-fw fa-server"></i>
			<span>{{ __('userpage.server_status') }}</span>
		</a>
	</li>
	<li class="nav-item {{$nav=='notifications' ? 'active':''}}">
		<a class="nav-link" href="{{ url('/admin.notice-view/notifications') }}">
			<i class="fas fa-fw fa-newspaper"></i>
			<span>{{ __('userpage.notice') }}</span>
		</a>
	</li>
	<li class="nav-item {{$nav=='create-coupon' ? 'active':''}}">
		<a class="nav-link" href="{{ url('/admin.coupon-create-view/create-coupon') }}">
			<i class="fas fa-fw fa-ticket-alt"></i>
			<span>{{ __('userpage.create_coupon') }}</span>
		</a>
	</li>
	<li class="nav-item {{$nav=='point-current' || $nav=='point-history' ? 'active':''}}">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
			aria-expanded="true" aria-controls="collapsePages">
			<i class="fas fa-fw fa-divide"></i>
			<span>{{ __('userpage.point_pay') }}</span>
		</a>
		<div id="collapsePages" class="collapse {{($nav=='point-current' || $nav=='point-history') ? 'show' : ''}}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item {{$nav=='point-current' ? 'active':''}}" href="{{ url('/admin.point-current-view/point-current') }}">{{ __('userpage.point_current') }}</a>
				<a class="collapse-item {{$nav=='point-history' ? 'active':''}}" href="{{ url('/admin.point-history-view/point-history') }}">{{ __('userpage.point_history') }}</a>
			</div>
		</div>
	</li>
	<li class="nav-item {{$nav=='permission' ? 'active':''}}">
		<a class="nav-link" href="{{ url('/admin.using-permission-view/permission') }}">
			<i class="fas fa-fw fa-people-arrows"></i>
			<span>{{ __('userpage.using_permission') }}</span>
		</a>
	</li>
	<li class="nav-item {{$nav=='params' ? 'active':''}}">
		<a class="nav-link" href="{{ url('/admin.parameter-view/params') }}">
			<i class="fas fa-fw fa-wrench"></i>
			<span>{{ __('userpage.parameter') }}</span>
		</a>
	</li>
	<li class="nav-item {{$nav=='emails' ? 'active':''}}">
		<a class="nav-link" href="{{ url('/admin.email-edit-view/emails') }}">
			<i class="fas fa-fw fa-mail-bulk"></i>
			<span>{{ __('userpage.email_send') }}</span>
		</a>
	</li>
    <li class="nav-item {{$nav=='address' ? 'active':''}}">
        <a class="nav-link" href="{{ url('/admin.address-view/address') }}">
            <i class="fas fa-fw fa-id-card"></i>
            <span>{{ __('userpage.deposit_address') }}</span>
        </a>
    </li>
    <li class="nav-item {{$nav=='broker' ? 'active':''}}">
        <a class="nav-link" href="{{ url('/admin.brokerid-view/broker') }}">
            <i class="fas fa-fw fa-id-card"></i>
            <span>Broker ID</span>
        </a>
    </li>

	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">
	<li class="nav-item">
		<a class="nav-link" href="{{ url('/admin.logout') }}">
			<i class="fas fa-fw fa-sign-out-alt"></i>
			<span>{{ __('userpage.logout') }}</span>
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
