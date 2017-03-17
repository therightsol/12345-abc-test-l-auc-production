<div id="menubar" class="menubar-inverse ">
    <div class="menubar-fixed-panel">
        <div>
            <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="expanded">
            <a href="{{ route('dashboard') }}">
                <span class="text-lg text-bold text-primary ">PakAuction</span>
            </a>
        </div>
    </div>
    <div class="menubar-scroll-panel">

        <!-- BEGIN MAIN MENU -->
        <ul id="main-menu" class="gui-controls">

            <!-- BEGIN DASHBOARD -->
            <li>
                <a href="{{ route('dashboard') }}" class="{{ isActiveRoute('dashboard', 'active') }}">
                    <div class="gui-icon"><i class="md md-home"></i></div>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard-login') }}">
                    <div class="gui-icon"><i class="fa fa-sign-in"></i></div>
                    <span class="title">login</span>
                </a>
            </li><!--end /menu-li -->
            <li>
                <a href="{{ route('dashboard-logout') }}">
                    <div class="gui-icon"><i class="fa fa-sign-out "></i></div>
                    <span class="title">Logout</span>
                </a>
            </li><!--end /menu-li -->




            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="fa fa-user fa-fw"></i></div>
                    <span class="title">Manage Users</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li><a {{ isActiveRoute('admin.user.index', 'class=active') }} href="{{route('admin.user.index')}}"><span
                                    class="title">View Users</span></a></li>
                    <li ><a {{ isActiveRoute('admin.user.create', 'class=active') }} href="{{route('admin.user.create')}}"><span
                                    class="title">Add User</span></a></li>
                </ul><!--end /submenu -->
            </li>



            <li class="gui-folder {{ isActiveRoute('add-post', 'expandable active') }}">
                <a>
                    <div class="gui-icon"><i class="fa fa-file fa-fw"></i></div>
                    <span class="title">Posts</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li {{ isActiveRoute('view-posts', 'class=active') }}><a
                                {{ isActiveRoute('view-posts', 'class=active') }} href="{{route('view-posts')}}"><span
                                    class="title">View Posts</span></a></li>
                    <li {{ isActiveRoute('add-post', 'class=active') }}><a
                                {{ isActiveRoute('add-post', 'class=active') }} href="{{route('add-post')}}"><span
                                    class="title">Add Post</span></a></li>
                </ul><!--end /submenu -->
            </li>


            <li class="gui-folder {{ isActiveRoute('add-media', 'expandable active') }}">
                <a>
                    <div class="gui-icon"><i class="fa fa-folder fa-fw"></i></div>
                    <span class="title">Media</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li {{ isActiveRoute('media', 'class=active') }}><a
                                {{ isActiveRoute('media', 'class=active') }} href="{{route('media')}}"><span
                                    class="title">All Media</span></a></li>
                    <li {{ isActiveRoute('add-media', 'class=active') }}><a
                                {{ isActiveRoute('add-media', 'class=active') }} href="{{route('add-media')}}"><span
                                    class="title">Add Media</span></a></li>
                </ul><!--end /submenu -->
            </li>


            <!-- BEGIN LEVELS -->
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="fa fa-map-o fa-fw"></i></div>
                    <span class="title">Address</span>
                </a>
                <!--start submenu -->
                <ul>

                    <li><a  class="{{ isActiveRoute('admin.country.index') }}"
                                href="{{route('admin.country.index')}}"><span class="title">Country</span></a></li>
                    <li><a class="{{ isActiveResource('admin.region', 'active') }}"
                                href="{{ route('admin.region.index') }}"><span class="title">Manage Regions</span></a>
                    </li>
                    <li><a class="{{ isActiveResource('admin.city', 'active') }}" href="{{route('admin.city.index')}}"><span
                                    class="title">Manage City</span></a></li>
                </ul><!--end /submenu -->
            </li><!--end /menu-li -->
            <!-- END LEVELS -->

            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="fa fa-money fa-fw"></i></div>
                    <span class="title">Sales</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li>
                        <a class="{{ isActiveResource('admin.shippingMethod', 'active') }}" href="{{route('admin.shippingMethod.index')}}">
                            <span class="title">Shipping Methods</span>
                        </a>
                    </li>
                    <li>
                        <a  class="{{ isActiveResource('admin.shippingRate', 'active') }}"href="{{route('admin.shippingRate.index')}}">
                            <span class="title">Shipping Rates</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ isActiveResource('admin.courier', 'active') }}" href="{{route('admin.courier.index')}}">
                            <span class="title">Courier</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ isActiveResource('admin.order', 'active') }}" href="{{route('admin.order.index')}}">
                            <span class="title">Orders</span>
                        </a>
                    </li>
                    <li>
                        <a class="" >
                            <span class="title">Promo Discount</span>
                        </a>
                    </li>
                </ul><!--end /submenu -->
            </li>
            <li class="gui-folder {{ areActiveRoutes([], 'expandable active') }}">
                <a>
                    <div class="gui-icon"><i class="fa fa-usd fa-fw"></i></div>
                    <span class="title">Currency</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li {{ isActiveRoute('admin.currencies.setup', 'class=active') }}><a
                                {{ isActiveRoute('admin.currencies.setup', 'class=active') }} href="{{route('admin.currencies.setup')}}"><span
                                    class="title">Currency Setup</span></a></li>
                    <li {{ isActiveRoute('admin.currencies.rates', 'class=active') }}><a
                                {{ isActiveRoute('admin.currencies.rates', 'class=active') }} href="{{route('admin.currencies.rates')}}"><span
                                    class="title">Manage Currency Rates</span></a></li>
                    <li {{ isActiveRoute('admin.currencies.symbols', 'class=active') }}><a
                                {{ isActiveRoute('admin.currencies.symbols', 'class=active') }} href="{{route('admin.currencies.symbols')}}"><span
                                    class="title">Manage Currency Symbols</span></a></li>
                </ul><!--end /submenu -->
            </li>
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="fa fa-product-hunt fa-fw"></i></div>
                    <span class="title">Product</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li>
                        <a class="{{ isActiveResource('admin.product', 'active') }}" href="{{route('admin.product.index')}}">
                            <span  class="title">Manage Product</span></a></li>
                    <li>
                        <a  {{ isActiveResource('admin.product_catalog', 'class=active') }} href="{{route('admin.product_catalog.index')}}">
                            <span  class="title">Manage Categories</span></a></li>
                </ul><!--end /submenu -->
            </li>
            <li>
                <a class="{{ isActiveResource('admin.settings', 'active') }}" href="{{route('admin.settings.index')}}">
                <div class="gui-icon"><i class="fa fa-cogs"></i></div>
                    <span class="title">Settings</span>
                </a>
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