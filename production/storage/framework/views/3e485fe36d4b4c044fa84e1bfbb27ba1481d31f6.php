<!--Header Start-->
<header data-spy="affix" data-offset-top="1" class="clearfix">
    <section class="toolbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 left_bar">
                    <ul class="left-none">

                        <?php if(show_login()): ?>
                            <li><a href="#"><i class="fa fa-user"></i>Login/Register</a></li>
                        <?php endif; ?>


                        <?php if(show_logout()): ?>
                            <li><a href="#"><i class="fa fa-sign-out"></i>Logout</a></li>
                        <?php endif; ?>


                        <?php if(is_page_active('help-page')): ?>
                            <li><a href="<?php echo e(url('help-page')); ?>">Help Page</a></li>
                        <?php endif; ?>
                        <?php if(is_page_active('rules-page')): ?>
                            <li><a href="<?php echo e(url('rules-page')); ?>">Rules Page</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-lg-6 ">
                    <ul class="right-none pull-right company_info">
                        <li><a href="tel:18005670123"><i
                                        class="fa fa-phone"></i> <?php echo e(isset($settings['phone_number'])?$settings['phone_number']: '1-800-567-0123'); ?>

                            </a></li>
                        <li class="address"><a href="contact.html"><i
                                        class="fa fa-map-marker"></i> <?php echo e(isset($settings['address'])?$settings['address']: '107 Sunset Blvd., Beverly Hills, CA  90210'); ?>

                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="toolbar_shadow"></div>
    </section>
    <div class="bottom-header">
        <div class="container">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1"><span
                                    class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                                    class="icon-bar"></span> <span class="icon-bar"></span></button>
                        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                            <span class="logo">
                                <?php if(isset($settings['picture'])): ?>
                                    <img style="    height: 61px;" src="<?php echo e(asset($settings['picture'])); ?>"
                                         alt="Auction">
                                <?php else: ?>
                                    <span class="primary_text">PakAuction</span> <span
                                            class="secondary_text">Starter Business</span>

                                <?php endif; ?>

                            </span>

                        </a></div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav pull-right">
                            <li class="<?php echo e(Helper::isActiveRoute('homepage')); ?>"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </div>
        <div class="header_shadow"></div>
    </div>
</header>
<!--Header End-->

<div class="clearfix"></div>