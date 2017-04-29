<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Pak Auction')); ?></title>


    <!-- BEGIN STYLESHEETS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(Module::asset('commonbackend:admin_assets/css/theme-default/bootstrap.css?1422792965')); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo e(Module::asset('commonbackend:admin_assets/css/theme-default/materialadmin.css?1425466319')); ?>" />
    <link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo e(Module::asset('commonbackend:admin_assets/css/theme-default/material-design-iconic-font.min.css?1421434286')); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo e(Module::asset('commonbackend:admin_assets/css/theme-default/libs/DataTables/jquery.dataTables.css?1423553989')); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo e(Module::asset('commonbackend:admin_assets/css/theme-default/libs/DataTables/extensions/dataTables.colVis.css?1423553990')); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo e(Module::asset('commonbackend:admin_assets/css/theme-default/libs/DataTables/extensions/dataTables.tableTools.css?1423553990')); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo e(Module::asset('commonbackend:admin_assets/css/style.css')); ?>" />
    <!-- END STYLESHEETS -->


    <style>
        .table thead th:first-child{
            text-transform: uppercase;
        }
        <?php if(Auth::user()->hasRole(['staff'])): ?>
            .delete-row{
            display: none;
        }
            <?php endif; ?>
    </style>


    <!-- END STYLESHEETS -->
<?php echo $__env->yieldContent('style'); ?>

    <script>
        window.Laravel =<?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>;
    </script>
</head>
<body class="menubar-hoverable header-fixed menubar-first menubar-pin">
<!-- BEGIN BASE-->
<?php echo $__env->make('commonbackend::layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div id="base">

    <div class="offcanvas">
    </div><!--end .offcanvas-->
    <?php echo $__env->yieldContent('content'); ?>

     <?php echo $__env->make('commonbackend::layouts.side_nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</div>

<!-- BEGIN JAVASCRIPT -->
<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/libs/jquery/jquery-1.11.2.min.js')); ?>"></script>
<script>
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    });
</script>
<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/libs/jquery/jquery-migrate-1.2.1.min.js')); ?>"></script>
<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/libs/bootstrap/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/libs/spin.js/spin.min.js')); ?>"></script>
<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/libs/autosize/jquery.autosize.min.js')); ?>"></script>

<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/libs/DataTables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/by-team/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js')); ?>"></script>
<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js')); ?>"></script>


<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/libs/nanoscroller/jquery.nanoscroller.min.js')); ?>"></script>
<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/core/source/App.js')); ?>"></script>
<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/core/source/AppNavigation.js')); ?>"></script>
<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/core/source/AppOffcanvas.js')); ?>"></script>
<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/core/source/AppCard.js')); ?>"></script>
<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/core/source/AppForm.js')); ?>"></script>
<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/core/source/AppNavSearch.js')); ?>"></script>
<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/core/source/AppVendor.js')); ?>"></script>
<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/core/demo/Demo.js')); ?>"></script>
<script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/core/demo/DemoTableDynamic.js')); ?>"></script>

<script>
    $('#main-menu').find('a.active').closest('li').addClass('active expanded').closest('li.gui-folder').addClass('active expanded')
</script>


<!-- END JAVASCRIPT -->
<?php echo $__env->yieldContent('js'); ?>
<?php echo $__env->yieldContent('after-js'); ?>
<div class="pull-right">
    This page took <?php echo e((microtime(true) - LARAVEL_START)); ?> seconds to render
</div>

</body>
</html>
