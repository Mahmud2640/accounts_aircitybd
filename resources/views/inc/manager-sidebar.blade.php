<li class="nav-main-item">
    <a class="nav-main-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('home') }}">
        <i class="nav-main-link-icon si si-speedometer"></i>
        <span class="nav-main-link-name">Dashboard</span>
    </a>
</li>
<li class="nav-main-heading">Register Interface</li>
<li class="nav-main-item">
    <a class="nav-main-link {{ Request::is('tickets/create') ? 'active' : '' }}" href="{{ route('tickets.create') }}">
        <i class="nav-main-link-icon fa fa-plane-departure"></i>
        <span class="nav-main-link-name">Add New Register</span>
    </a>
</li>
<li class="nav-main-item">
    <a class="nav-main-link {{ Request::is('tickets') ? 'active' : '' }}" href="{{ route('tickets.index') }}">
        <i class="nav-main-link-icon fab fa-think-peaks"></i>
        <span class="nav-main-link-name">All register data</span>
    </a>
</li>
<li class="nav-main-item">
    <a class="nav-main-link {{ Request::is('vendors*') ? 'active' : '' }}" href="{{ route('vendors.index') }}">
        <i class="nav-main-link-icon fa fa-users"></i>
        <span class="nav-main-link-name">Vendors</span>
    </a>
</li>
<li class="nav-main-item">
    <a class="nav-main-link {{ Request::is('report/branch*') ? 'active' : '' }}" href="{{ route('report.branch.details',auth()->user()->branch_id) }}">
        <i class="nav-main-link-icon si si-energy"></i>
        <span class="nav-main-link-name">Profit / Loss  Report</span>
    </a>
</li>