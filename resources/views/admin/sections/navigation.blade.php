<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('admin.dashboard') }}" class="site_title">
                <!-- <span>{{ config('app.name') }}</span> -->
                <span>Reddit</span>
            </a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ auth()->user()->avatar }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <h2>{{ auth()->user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>{{ __('views.backend.section.navigation.sub_header_0') }}</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            {{ __('views.backend.section.navigation.menu_0_1') }}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>{{ __('views.backend.section.navigation.sub_header_1') }}</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ route('admin.users') }}">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            {{ __('views.backend.section.navigation.menu_1_1') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.keywords') }}">
                            <i class="fa fa-key" aria-hidden="true"></i>
                            Keywords
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.posts') }}">
                            <i class="fa fa-key" aria-hidden="true"></i>
                            Posts
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.comments') }}">
                            <i class="fa fa-key" aria-hidden="true"></i>
                            Comments
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.all-pages') }}">
                            <i class="fa fa-key" aria-hidden="true"></i>
                            All Pages
                        </a>
                    </li>
                </ul>
            </div>
            
            
        </div>
        <!-- /sidebar menu -->
    </div>
</div>
