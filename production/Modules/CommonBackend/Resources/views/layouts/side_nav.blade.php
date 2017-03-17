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
                    <a href="{{route('backend')}}"  class="{{ Helper::isActiveRoute(Modules\CommonBackend\Providers\CommonBackendServiceProvider::getdashboardName()) }}" >
                        <div class="gui-icon"><i class="md md-home"></i></div>
                        <span class="title">Dashboard</span>
                    </a>
                </li>


                <li class="gui-folder">
                    <a>
                        <div class="gui-icon"><i class="fa fa-car fa-fw"></i></div>
                        <span class="title">Car</span>
                    </a>
                    <!--start submenu -->
                    <ul>
                        <li><a class="{{ Helper::isActiveResource('admin.carCompany') }}" href="{{ route('admin.carCompany.index') }}"><span class="title">Manage Car Companies</span></a></li>
                        <li><a class="{{ Helper::isActiveResource('admin.carModel') }}" href="{{ route('admin.carModel.index') }}"><span class="title">Manage Car Modal</span></a></li>
                        <li><a class="{{ Helper::isActiveResource('admin.engineTypes') }}" href="{{ route('admin.engineTypes.index') }}"><span class="title">Manage Engine Types</span></a></li>
                        <li><a class="{{ Helper::isActiveResource('admin.features') }}" href="{{ route('admin.features.index') }}"><span class="title">Manage Car Features</span></a></li>
                    </ul><!--end /submenu -->

                </li>

            </ul><!--end .main-menu -->
            <!-- END MAIN MENU -->

            <div class="menubar-foot-panel">
                <small class="no-linebreak hidden-folded">
                    <span class="opacity-75">Copyright &copy; {{date('Y')}} </span> <strong>PakAuction</strong>
                </small>
            </div>
        </div><!--end .menubar-scroll-panel-->
    </div>