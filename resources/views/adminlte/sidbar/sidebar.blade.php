<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{auth()->user()->name}}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header"><a href="{{route('dashboard.index')}}" ><i class="fa fa-th"></i>@lang('pos.dasboard')</a></li>
           @if(auth()->user()->hasPermission('read_users'))
            <li class="header"><a href="{{route('dashboard.users')}}" ><i class="fa fa-th"></i>@lang('pos.users')</a></li>
            @endif
            @if(auth()->user()->hasPermission('read_categories'))
                <li class="header"><a href="{{route('dashboard.categories.index')}}" ><i class="fa fa-th"></i>@lang('pos.categories')</a></li>
            @endif
            @if(auth()->user()->hasPermission('read_products'))
                <li class="header"><a href="{{route('dashboard.products.index')}}" ><i class="fa fa-th"></i>@lang('pos.products')</a></li>
            @endif
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>