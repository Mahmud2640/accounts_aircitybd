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
{{-- <li class="nav-main-item">
    <a class="nav-main-link {{ Request::is('tickets') ? 'active' : '' }}" href="{{ route('tickets.index') }}">
        <i class="nav-main-link-icon fab fa-think-peaks"></i>
        <span class="nav-main-link-name">All register data</span>
    </a>
</li> --}}


<li class="nav-main-item  {{ Request::is('tickets*') ? 'open' : '' }}">
    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
        <i class="nav-main-link-icon fab fa-think-peaks"></i>
        <span class="nav-main-link-name">All register data</span>
    </a>
    <ul class="nav-main-submenu">
        <li class="nav-main-item">
            <a class="nav-main-link {{ Request::is('tickets') ? 'active' : '' }}" href="{{ route('tickets.index') }}">
                <span class="nav-main-link-name">All Register</span>
            </a>
        </li>
        <li class="nav-main-item">
            <a class="nav-main-link {{ Request::is('tickets/all/dues') ? 'active' : '' }}" href="{{ route('tickets.all.due') }}">
                <span class="nav-main-link-name">All Due Data</span>
            </a>
        </li>
        @foreach (\App\Models\Regtype::all() as $item)
            <li class="nav-main-item">
                <a class="nav-main-link {{ Request::is('tickets/type/'.$item->name) ? 'active' : '' }}" href="{{ route('tickets.ticket_type',$item->name) }}">
                    <span class="nav-main-link-name">{{ $item->name }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</li>



<li class="nav-main-item">
    <a class="nav-main-link {{ Request::is('branchs*') ? 'active' : '' }}" href="{{ route('branchs.index') }}">
        <i class="nav-main-link-icon fa fa-landmark"></i>
        <span class="nav-main-link-name">Branch</span>
    </a>
</li>

<li class="nav-main-item  {{ Request::is('airlines*') ? 'open' : '' }}">
    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
        <i class="nav-main-link-icon fa fa-plane"></i>
        <span class="nav-main-link-name">Airlines Data</span>
    </a>
    <ul class="nav-main-submenu">
        <li class="nav-main-item">
            <a class="nav-main-link {{ Request::is('airlines*') ? 'active' : '' }}" href="{{ route('airlines.index') }}">
                <i class="nav-main-link-icon fa fa-plane"></i>
                <span class="nav-main-link-name">Airlines</span>
            </a>
        </li>
        <li class="nav-main-item">
            <a class="nav-main-link {{ Request::is('sector*') ? 'active' : '' }}" href="{{ route('sector.index') }}">
                <i class="nav-main-link-icon fas fa-vector-square"></i>
                <span class="nav-main-link-name">Sector</span>
            </a>
        </li>
        <li class="nav-main-item">
            <a class="nav-main-link {{ Request::is('regtype*') ? 'active' : '' }}" href="{{ route('regtype.index') }}">
                <i class="nav-main-link-icon fas fa-registered"></i>
                <span class="nav-main-link-name">Register Type</span>
            </a>
        </li>
    </ul>
</li>


<li class="nav-main-item">
    <a class="nav-main-link {{ Request::is('vendors*') ? 'active' : '' }}" href="{{ route('vendors.index') }}">
        <i class="nav-main-link-icon fa fa-users"></i>
        <span class="nav-main-link-name">Vendors</span>
    </a>
</li>
<li class="nav-main-item">
    <a class="nav-main-link {{ Request::is('salevendor*') ? 'active' : '' }}" href="{{ route('salevendor.index') }}">
        <i class="nav-main-link-icon fas fa-chalkboard-teacher"></i>
        <span class="nav-main-link-name">Sale Vendors</span>
    </a>
</li>
<li class="nav-main-item">
    <a class="nav-main-link {{ Request::is('user*') ? 'active' : '' }}" href="{{ route('user.index') }}">
        <i class="nav-main-link-icon si si-users"></i>
        <span class="nav-main-link-name">User</span>
    </a>
</li>
<li class="nav-main-item">
    <a class="nav-main-link {{ Request::is('banks*') ? 'active' : '' }}" href="{{ route('banks.index') }}">
        <i class="nav-main-link-icon fas fa-university"></i>
        <span class="nav-main-link-name">Banks</span>
    </a>
</li>
<li class="nav-main-item">
    <a class="nav-main-link {{ Request::is('salary*') ? 'active' : '' }}" href="{{ route('salary.index') }}">
        <i class="nav-main-link-icon fas fa-dollar-sign"></i>
        <span class="nav-main-link-name">Salary</span>
    </a>
</li>
<li class="nav-main-item">
    <a class="nav-main-link {{ Request::is('links*') ? 'active' : '' }}" href="{{ route('links.index') }}">
        <i class="nav-main-link-icon fas fa-link"></i>
        <span class="nav-main-link-name">WebSite Link</span>
    </a>
</li>
<li class="nav-main-item">
    <a class="nav-main-link {{ Request::is('messages/create*') ? 'active' : '' }}" href="{{ route('messages.create') }}">
        <i class="nav-main-link-icon fas fa-sms"></i>
        <span class="nav-main-link-name">Message</span>
    </a>
</li>
<li class="nav-main-item  {{ Request::is('report*') ? 'open' : '' }}">
    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
        <i class="nav-main-link-icon si si-energy"></i>
        <span class="nav-main-link-name">Reports</span>
    </a>
    <ul class="nav-main-submenu">
        <li class="nav-main-item">
            <a class="nav-main-link {{ Request::is('report/authot') ? 'active' : '' }}" href="{{ route('report.authot') }}">
                <span class="nav-main-link-name">Authot Report</span>
            </a>
        </li>
        <li class="nav-main-item">
            <a class="nav-main-link {{ Request::is('report/profit-loss') ? 'active' : '' }}" href="{{ route('report.profit-loss') }}">
                <span class="nav-main-link-name">Profit / Loss  Report</span>
            </a>
        </li>
        <li class="nav-main-item">
            <a class="nav-main-link {{ Request::is('report/branch*') ? 'active' : '' }}" href="{{ route('report.branch') }}">
                <span class="nav-main-link-name">Branch Report</span>
            </a>
        </li>
    </ul>
</li>
