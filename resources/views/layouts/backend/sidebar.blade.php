{{-- @php
  dd($user);
@endphp --}}
<div class="fixed">
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
          <div class="pull-left image">
            {{--
            <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image"> --}} 
            @if(Auth::user()->image_icon)
    
            <img src="{{ URL::asset('uploads/settings/profile/'.Auth::user()->image_icon.'-s.jpg') }}"  class="img-circle" width="48" height="48" alt="User"> 
            @else
    
            <img src="{{ URL::asset('uploads/avatar.png') }}" alt="User" width="48" height="48" /> @endif
          </div>
          <div class="pull-left info">
            <p>{{ $user->full_name }}</p>
            {{--
            <!-- Designation -->{{ $user->designation }} --}}
            <div class="email">{{ $user->designation }}</div>
          </div>
        </div>
    
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <!-- Optionally, you can add icons to the links -->
          <li class="{!! classActivePath('dashboard') !!}">
            <a href="{{route('dashboard')}}" id="dashboard">
              <i class="fa fa-home"></i>
              <span>Dashboard</span>
            </a>
          </li>
    
          @foreach($modules as $module)
          <li class="@if(count($module->childrens)>0) treeview @endif {{ classActivePath('$module->menu_class') }}">
            <a href="@if(count($module->childrens)>0) javascript:void(0); @else {!! route($module->slug.'.index') !!} @endif" id="{{ $module->menu_class }}"
              @if(count($module->childrens) > 0) class="menu-toggle" @endif>
              <i class="{{ $module->icon }}"></i>
              <span>{{ $module->module_name }}</span>
              @if(count($module->childrens)>0)
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
              @endif
            </a>
            @if(count($module->childrens))
            <ul class="treeview-menu">
              @foreach($module->childrens as $children)
              <li id="{{ $children->menu_class }}">
                <a href="{{ route($children->slug.'.index') }}">
                  <i class="{{ $children->icon }}"></i>{{ $children->module_name }}
                </a>
              </li>
              @endforeach
            </ul>
            @endif
          </li>
          @endforeach
          {{-- <li>
            <a href="{{ route('auth.logout') }}"
                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i>
            <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
            </form>
          </li> --}}
        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
  </aside>
</div>