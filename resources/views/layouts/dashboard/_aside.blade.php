<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard_files/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>@lang('site.title')</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-th"></i><span>@lang('site.dashboard')</span></a></li>



            @if (auth()->user()->hasPermission('categories_read'))
                <li><a href="{{ route('dashboard.categories.index') }}"><i class="fa fa-th"></i><span>@lang('site.categories')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('products_read'))
                <li><a href="{{ route('dashboard.products.index') }}"><i class="fa fa-th"></i><span>@lang('site.products')</span></a></li>
            @endif
{{--            @if (auth()->user()->hasPermission('read_stores'))--}}
{{--                <li><a href="{{ route('dashboard.stores.index') }}"><i class="fa fa-th"></i><span>@lang('site.stores')</span></a></li>--}}
{{--            @endif--}}

            @if (auth()->user()->hasPermission('clients_read'))
                <li><a href="{{ route('dashboard.clients.index') }}"><i class="fa fa-th"></i><span>@lang('site.clients')</span></a></li>
            @endif


{{--            @if (auth()->user()->hasPermission('read_suppliers'))--}}
{{--                <li><a href="{{ route('dashboard.suppliers.index') }}"><i class="fa fa-th"></i><span>@lang('site.suppliers')</span></a></li>--}}
{{--            @endif--}}

{{--            @if (auth()->user()->hasPermission('read_orders'))--}}
{{--                <li><a href="{{ route('dashboard.orders.index') }}"><i class="fa fa-th"></i><span>@lang('site.orders')</span></a></li>--}}
{{--            @endif--}}

{{--            @if (auth()->user()->hasPermission('read_orders_suppliers'))--}}
{{--                <li><a href="{{ route('dashboard.orders_suppliers.index') }}"><i class="fa fa-th"></i><span>@lang('site.orders_suppliers')</span></a></li>--}}
{{--            @endif--}}

{{--            @if (auth()->user()->hasPermission('read_orders_return'))--}}
{{--                <li><a href="{{ route('dashboard.orders_return.index') }}"><i class="fa fa-th"></i><span>@lang('site.orders_return')</span></a></li>--}}
{{--            @endif--}}

{{--            @if (auth()->user()->hasPermission('read_orders_suppliers_return'))--}}
{{--                <li><a href="{{ route('dashboard.ordersuppliers_return.index') }}"><i class="fa fa-th"></i><span>@lang('site.orders_suppliers_return')</span></a></li>--}}
{{--            @endif--}}


{{--            --}}{{--<li><a href="{{ route('dashboard.categories.index') }}"><i class="fa fa-book"></i><span>@lang('site.categories')</span></a></li>--}}
{{--            --}}{{----}}
{{--            --}}{{----}}
            @if (auth()->user()->hasPermission('users_read'))
            <li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-users"></i><span>@lang('site.users')</span></a></li>
            @endif
{{--            --}}{{--<li class="treeview">--}}
{{--            --}}{{--<a href="#">--}}
{{--            --}}{{--<i class="fa fa-pie-chart"></i>--}}
{{--            --}}{{--<span>الخرائط</span>--}}
{{--            --}}{{--<span class="pull-right-container">--}}
{{--            --}}{{--<i class="fa fa-angle-left pull-right"></i>--}}
{{--            --}}{{--</span>--}}
{{--            --}}{{--</a>--}}
{{--            --}}{{--<ul class="treeview-menu">--}}
{{--            --}}{{--<li>--}}
{{--            --}}{{--<a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a>--}}
{{--            --}}{{--</li>--}}
{{--            --}}{{--<li>--}}
{{--            --}}{{--<a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a>--}}
{{--            --}}{{--</li>--}}
{{--            --}}{{--<li>--}}
{{--            --}}{{--<a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a>--}}
{{--            --}}{{--</li>--}}
{{--            --}}{{--<li>--}}
{{--            --}}{{--<a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a>--}}
{{--            --}}{{--</li>--}}
{{--            --}}{{--</ul>--}}
{{--            --}}{{--</li>--}}

{{--            @if (auth()->user()->hasPermission('read_roles'))--}}
{{--            <li><a href="{{ route('dashboard.roles.index') }}"><i class="fa fa-th"></i><span>@lang('site.roles')</span></a></li>--}}
{{--        @endif--}}
{{--        @if (auth()->user()->hasPermission('read_users'))--}}
{{--            <li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-th"></i><span>@lang('site.users')</span></a></li>--}}
{{--        @endif--}}


        </ul>

    </section>

</aside>

