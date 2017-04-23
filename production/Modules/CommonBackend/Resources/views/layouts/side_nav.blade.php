<div id="menubar" class="menubar-inverse ">
    <div class="menubar-fixed-panel">
        <div>
            <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="expanded">
            <a href="#">
                <span class="text-lg text-bold text-primary ">PakAuction</span>
            </a>
        </div>
    </div>
    <div class="menubar-scroll-panel">

        <!-- BEGIN MAIN MENU -->
        <ul id="main-menu" class="gui-controls">

            <!-- BEGIN DASHBOARD -->
            <li>
                <a href="{{route('backend')}}"
                   class="{{ Helper::isActiveRoute(Modules\CommonBackend\Providers\CommonBackendServiceProvider::getdashboardName()) }}">
                    <div class="gui-icon"><i class="md md-home"></i></div>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            @if(!Auth::check())
                <li>
                    <a href="{{route('dashboard-login')}}" class="{{ Helper::isActiveRoute('dashboard-login') }}">
                        <div class="gui-icon"><i class="fa fa-sign-in"></i></div>
                        <span class="title">login</span>
                    </a>
                </li><!--end /menu-li -->
            @endif

            @if(Auth::user()->hasRole(['admin', 'staff']))

                <li class="gui-folder">
                    <a>
                        <div class="gui-icon"><i class="fa fa-user fa-fw"></i></div>
                        <span class="title">Manage Users</span>
                    </a>
                    <!--start submenu -->
                    <ul>
                        <li><a class="{{ Helper::isActiveRoute('admin.users.create') }}"
                               href="{{ route('admin.users.create') }}"><span class="title">Add User</span></a></li>
                        <li>
                            <a class="{{ Helper::isActiveRoute('admin.users.index') . Helper::isActiveRoute('admin.users.edit') }}"
                               href="{{ route('admin.users.index') }}"><span class="title">View Users</span></a></li>
                    </ul><!--end /submenu -->
                </li>
                <li class="gui-folder">
                    <a>
                        <div class="gui-icon"><i class="fa fa-car fa-fw"></i></div>
                        <span class="title">Car</span>
                    </a>
                    <!--start submenu -->
                    <ul>
                        <li><a class="{{ Helper::isActiveResource('admin.cars') }}"
                               href="{{ route('admin.cars.index') }}"><span class="title">Manage Cars</span></a></li>
                        <li><a class="{{ Helper::isActiveResource('admin.category') }}"
                               href="{{ route('admin.category.index') }}"><span class="title">Manage Category</span></a>
                        </li>
                        <li><a class="{{ Helper::isActiveResource('admin.carCompany') }}"
                               href="{{ route('admin.carCompany.index') }}"><span
                                        class="title">Manage Car Companies</span></a></li>
                        <li><a class="{{ Helper::isActiveResource('admin.carModel') }}"
                               href="{{ route('admin.carModel.index') }}"><span
                                        class="title">Manage Car Modal</span></a></li>
                        <li><a class="{{ Helper::isActiveResource('admin.engineTypes') }}"
                               href="{{ route('admin.engineTypes.index') }}"><span
                                        class="title">Manage Engine Types</span></a></li>
                        <li><a class="{{ Helper::isActiveResource('admin.features') }}"
                               href="{{ route('admin.features.index') }}"><span class="title">Manage Car Features</span></a>
                        </li>
                    </ul><!--end /submenu -->
                </li>
                <li>
                    <a href="{{route('admin.auctions.index')}}"
                       class="{{ Helper::isActiveResource('admin.auctions') }}">
                        <div class="gui-icon"><i class="fa fa-gavel" aria-hidden="true"></i>
                        </div>
                        <span class="title">Auctions</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.biddings.index')}}"
                       class="{{ Helper::isActiveResource('admin.biddings') }}">
                        <div class="gui-icon"><i class="fa fa-money" aria-hidden="true"></i>
                        </div>
                        <span class="title">Bidding</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.inspection.index')}}"
                       class="{{ Helper::isActiveResource('admin.inspection') }}">
                        <div class="gui-icon"><i class="fa fa-money" aria-hidden="true"></i>
                        </div>
                        <span class="title">Request Inspection</span>
                    </a>
                </li>

                <li class="gui-folder">
                    <a>
                        <div class="gui-icon"><i class="fa fa-file fa-fw"></i></div>
                        <span class="title">Pages</span>
                    </a>
                    <!--start submenu -->
                    <ul>
                        <li><a class="{{ Helper::isActiveRoute('admin.helpPage') }}"
                               href="{{ route('admin.helpPage') }}"><span class="title">Help</span></a></li>
                        <li><a class="{{ Helper::isActiveRoute('admin.rulesPage') }}"
                               href="{{ route('admin.rulesPage') }}"><span class="title">Rules</span></a></li>
                    </ul><!--end /submenu -->
                </li>
                <li>
                    <a href="{{route('admin.settings.index')}}"
                       class="{{ Helper::isActiveResource('admin.settings') }}">
                        <div class="gui-icon"><i class="fa fa-gears"></i></div>
                        <span class="title">Settings</span>
                    </a>
                </li>
            @endif
            @if(Auth::user()->hasRole(['auctioneer']))
                <li>
                    <a href="{{route('auctioneer.inspection.create')}}"
                       class="{{ Helper::isActiveResource('account.inspection') }}">
                        <div class="gui-icon"><i class="fa fa-gears"></i></div>
                        <span class="title">Request Inspection</span>
                    </a>
                </li>
            @endif
            @if(Auth::user()->hasRole(['bidder']))
                <li>
                    <a href="{{route('bidder.bidding')}}"
                       class="{{ Helper::isActiveResource('bidder.bidding') }}">
                        <div class="gui-icon"><i class="fa fa-gears"></i></div>
                        <span class="title">Bidding</span>
                    </a>
                </li>
            @endif

            <li>
                <a href="{{route('logout')}}" class="{{ Helper::isActiveRoute('logout') }}">
                    <div class="gui-icon"><i class="fa fa-sign-out "></i></div>
                    <span class="title">Logout</span>
                </a>
            </li><!--end /menu-li -->

        </ul><!--end .main-menu -->
        <!-- END MAIN MENU -->

        <div class="menubar-foot-panel">
            <small class="no-linebreak hidden-folded">
                <span class="opacity-75">Copyright &copy; {{date('Y')}} </span> <strong>PakAuction</strong>
            </small>
        </div>
    </div><!--end .menubar-scroll-panel-->
</div>