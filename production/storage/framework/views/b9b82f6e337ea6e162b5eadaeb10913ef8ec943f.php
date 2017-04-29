<div id="menubar" class="menubar-inverse ">
    <div class="menubar-fixed-panel">
        <div>
            <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="expanded">
            <a href="<?php echo e(route('homepage')); ?>">
                <span class="text-lg text-bold text-primary ">PakAuction</span>
            </a>
        </div>
    </div>
    <div class="menubar-scroll-panel">

        <!-- BEGIN MAIN MENU -->
        <ul id="main-menu" class="gui-controls">

            <!-- BEGIN DASHBOARD -->
            <li>
                <a href="<?php echo e(route('backend')); ?>"
                   class="<?php echo e(Helper::isActiveRoute(Modules\CommonBackend\Providers\CommonBackendServiceProvider::getdashboardName())); ?>">
                    <div class="gui-icon"><i class="md md-home"></i></div>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <?php if(!Auth::check()): ?>
                <li>
                    <a href="<?php echo e(route('dashboard-login')); ?>" class="<?php echo e(Helper::isActiveRoute('dashboard-login')); ?>">
                        <div class="gui-icon"><i class="fa fa-sign-in"></i></div>
                        <span class="title">login</span>
                    </a>
                </li><!--end /menu-li -->
            <?php endif; ?>

            <?php if(Auth::user()->hasRole(['admin', 'staff'])): ?>

                <li class="gui-folder">
                    <a>
                        <div class="gui-icon"><i class="fa fa-user fa-fw"></i></div>
                        <span class="title">Manage Users</span>
                    </a>
                    <!--start submenu -->
                    <ul>
                        <li><a class="<?php echo e(Helper::isActiveRoute('admin.users.create')); ?>"
                               href="<?php echo e(route('admin.users.create')); ?>"><span class="title">Add User</span></a></li>
                        <li>
                            <a class="<?php echo e(Helper::isActiveRoute('admin.users.index') . Helper::isActiveRoute('admin.users.edit')); ?>"
                               href="<?php echo e(route('admin.users.index')); ?>"><span class="title">View Users</span></a></li>
                    </ul><!--end /submenu -->
                </li>
                <li class="gui-folder">
                    <a>
                        <div class="gui-icon"><i class="fa fa-car fa-fw"></i></div>
                        <span class="title">Car</span>
                    </a>
                    <!--start submenu -->
                    <ul>
                        <li><a class="<?php echo e(Helper::isActiveResource('admin.cars')); ?>"
                               href="<?php echo e(route('admin.cars.index')); ?>"><span class="title">Manage Cars</span></a></li>
                        <li><a class="<?php echo e(Helper::isActiveResource('admin.category')); ?>"
                               href="<?php echo e(route('admin.category.index')); ?>"><span class="title">Manage Category</span></a>
                        </li>
                        <li><a class="<?php echo e(Helper::isActiveResource('admin.carCompany')); ?>"
                               href="<?php echo e(route('admin.carCompany.index')); ?>"><span
                                        class="title">Manage Car Companies</span></a></li>
                        <li><a class="<?php echo e(Helper::isActiveResource('admin.carModel')); ?>"
                               href="<?php echo e(route('admin.carModel.index')); ?>"><span
                                        class="title">Manage Car Modal</span></a></li>
                        <li><a class="<?php echo e(Helper::isActiveResource('admin.engineTypes')); ?>"
                               href="<?php echo e(route('admin.engineTypes.index')); ?>"><span
                                        class="title">Manage Engine Types</span></a></li>
                        <li><a class="<?php echo e(Helper::isActiveResource('admin.features')); ?>"
                               href="<?php echo e(route('admin.features.index')); ?>"><span class="title">Manage Car Features</span></a>
                        </li>
                    </ul><!--end /submenu -->
                </li>
                <li>
                    <a href="<?php echo e(route('admin.auctions.index')); ?>"
                       class="<?php echo e(Helper::isActiveResource('admin.auctions')); ?>">
                        <div class="gui-icon"><i class="fa fa-gavel" aria-hidden="true"></i>
                        </div>
                        <span class="title">Auctions</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.biddings.index')); ?>"
                       class="<?php echo e(Helper::isActiveResource('admin.biddings')); ?>">
                        <div class="gui-icon"><i class="fa fa-money" aria-hidden="true"></i>
                        </div>
                        <span class="title">Bidding</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.inspection.index')); ?>"
                       class="<?php echo e(Helper::isActiveResource('admin.inspection')); ?>">
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
                        <li><a class="<?php echo e(Helper::isActiveRoute('admin.helpPage')); ?>"
                               href="<?php echo e(route('admin.helpPage')); ?>"><span class="title">Help</span></a></li>
                        <li><a class="<?php echo e(Helper::isActiveRoute('admin.rulesPage')); ?>"
                               href="<?php echo e(route('admin.rulesPage')); ?>"><span class="title">Rules</span></a></li>
                    </ul><!--end /submenu -->
                </li>
                <li>
                    <a href="<?php echo e(route('admin.settings.index')); ?>"
                       class="<?php echo e(Helper::isActiveResource('admin.settings')); ?>">
                        <div class="gui-icon"><i class="fa fa-gears"></i></div>
                        <span class="title">Settings</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(Auth::user()->hasRole(['auctioneer'])): ?>
                <li>
                    <a href="<?php echo e(route('auctioneer.inspection.index')); ?>"
                       class="<?php echo e(Helper::isActiveResource('auctioneer.inspection')); ?>">
                        <div class="gui-icon"><i class="fa fa-gears"></i></div>
                        <span class="title">Request Inspection</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('auctioneer.auctions')); ?>"
                       class="<?php echo e(Helper::isActiveRoute('auctioneer.auctions')); ?>">
                        <div class="gui-icon"><i class="fa fa-gavel"></i></div>
                        <span class="title">My Auctions</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(Auth::user()->hasRole(['bidder'])): ?>
                <li>
                    <a href="<?php echo e(route('bidder.bidding')); ?>"
                       class="<?php echo e(Helper::isActiveRoute('bidder.bidding')); ?>">
                        <div class="gui-icon"><i class="fa fa-gears"></i></div>
                        <span class="title">Bidding</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('bidder.wonAuctions')); ?>"
                       class="<?php echo e(Helper::isActiveRoute('bidder.wonAuctions')); ?>">
                        <div class="gui-icon"><i class="fa fa-gavel"></i></div>
                        <span class="title">Won Auctions</span>
                    </a>
                </li>
            <?php endif; ?>

            <li>
                <a href="<?php echo e(route('logout')); ?>" class="<?php echo e(Helper::isActiveRoute('logout')); ?>">
                    <div class="gui-icon"><i class="fa fa-sign-out "></i></div>
                    <span class="title">Logout</span>
                </a>
            </li><!--end /menu-li -->

        </ul><!--end .main-menu -->
        <!-- END MAIN MENU -->

        <div class="menubar-foot-panel">
            <small class="no-linebreak hidden-folded">
                <span class="opacity-75">Copyright &copy; <?php echo e(date('Y')); ?> </span> <strong>PakAuction</strong>
            </small>
        </div>
    </div><!--end .menubar-scroll-panel-->
</div>