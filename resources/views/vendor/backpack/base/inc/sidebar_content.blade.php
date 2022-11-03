{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i>
   {{ trans('backpack::base.dashboard') }}</a>
</li>
@if( backpack_user()->hasPermissionTo('Menus-index') )
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('menu-item') }}">
        <i class="nav-icon la la-list"></i>
        <span>Menu</span>
    </a>
</li>
@endif
@if( backpack_user()->hasPermissionTo('Pages-index') )
<li class='nav-item'>
    <a class='nav-link' href="{{ backpack_url('page') }}">
        <i class='nav-icon la la-file-o'></i>
        <span>Pages</span>
    </a>
</li>
@endif
@if( backpack_user()->hasPermissionTo('Files-index') )
<li class="nav-item">
   <a class="nav-link" href="{{ backpack_url('elfinder') }}">
   <i class="nav-icon la la-files-o"></i>
   <span>{{ trans('backpack::crud.file_manager') }}</span>
   </a>
</li>
@endif
@if( backpack_user()->hasPermissionTo('Users-index')
|| backpack_user()->hasPermissionTo('Roles-index')
|| backpack_user()->hasPermissionTo('Permissions-index')
)
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon la la-users"></i> Authentication
    </a>
    <ul class="nav-dropdown-items">
        @if( backpack_user()->hasPermissionTo('Users-index') )
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('user') }}">
                <i class="nav-icon la la-user"></i>
                <span>Users</span>
            </a>
        </li>
        @endif
        @if( backpack_user()->hasPermissionTo('Roles-index') )
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('role') }}">
                <i class="nav-icon la la-id-badge"></i> 
                <span>Roles</span>
            </a>
        </li>
        @endif
        @if( backpack_user()->hasPermissionTo('Permissions-index') )
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('permission') }}">
                <i class="nav-icon la la-key"></i> 
                <span>Permissions</span>
            </a>
        </li>
        @endif
   </ul>
</li>
@endif
@if( backpack_user()->hasPermissionTo('Events-index') )
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('event') }}">
        <i class="nav-icon la la-question"></i>Events
    </a>
</li>
@endif
@if( backpack_user()->hasPermissionTo('Categories-index') )
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('category') }}">
        <i class="nav-icon la la-question"></i>Categories
    </a>
</li>
@endif
@if( backpack_user()->hasPermissionTo('Sites-index') || backpack_user()->hasPermissionTo('Single Site-index') )
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('site') }}">
        <i class="nav-icon la la-question"></i>Sites
    </a>
</li>
@endif
@if( backpack_user()->hasPermissionTo('Logs-index') )
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('log') }}">
        <i class="nav-icon la la-question"></i>Logs
    </a>
</li>
@endif

@if( backpack_user()->hasPermissionTo('Settings-index') )
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('setting') }}'>
        <i class='nav-icon la la-cog'></i> 
        <span>Settings</span>
    </a>
</li>
@endif
