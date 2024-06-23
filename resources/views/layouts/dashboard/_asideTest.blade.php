<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard_files/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>

            <div class="pull-left info">

                {{-- @if(Auth::check())
                  <p>{{ Auth::user()->name }}</p>
                @endif --}}

                @auth
                    <p>{{ Auth::user()->name }}</p>
                @endauth

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">

            {{-- //dashboard --}}
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-th"></i><span>@lang('site.dashboard')</span></a></li>

            {{-- //categories --}}
            <li><a href="{{ route('dashboard.categories.index') }}"><i class="fa fa-th"></i><span>@lang('site.categories')</span></a></li>

            {{-- //products --}}
            <li><a href="{{ route('dashboard.products.index') }}"><i class="fa fa-th"></i><span>@lang('site.products')</span></a></li>

            {{-- //profile --}}
            <li><a href="{{ route('dashboard.user.profile') }}"><i class="fa fa-th"></i><span>@lang('site.profile')</span></a></li>





            <li class="user-footer">

                <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">@lang('site.logout')</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </li>




        </ul>

    </section>

</aside>

