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
        @foreach (\App\Models\Regtype::all() as $item)
            <li class="nav-main-item">
                <a class="nav-main-link {{ Request::is('tickets/type/'.$item->name) ? 'active' : '' }}" href="{{ route('tickets.ticket_type',$item->name) }}">
                    <span class="nav-main-link-name">{{ $item->name }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</li>

@php
    $headoffice = \App\Models\Branch::where('name','Head office')->first();
@endphp
@if (auth()->user()->branch_id == $headoffice->id)
    <li class="nav-main-item">
        <a class="nav-main-link {{ Request::is('salevendor*') ? 'active' : '' }}" href="{{ route('salevendor.index') }}">
            <i class="nav-main-link-icon fas fa-chalkboard-teacher"></i>
            <span class="nav-main-link-name">Sale Vendors</span>
        </a>
    </li>
@endif
