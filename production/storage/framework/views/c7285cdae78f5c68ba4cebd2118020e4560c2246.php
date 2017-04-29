<?php $__env->startSection('content'); ?>
    <div id="content">
        <section class="">
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-head">
                                <?php echo $__env->make('commonbackend::layouts._section-head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                            <div class="card-body dataTables_wrapper" style="padding-top: 0;">
                                <form id="filters" action="#">
                                    <?php echo $__env->make('commonbackend::layouts._table-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php echo $__env->yieldContent('table'); ?>
                                </form>
                            </div><!--end .card-body -->
                            <?php echo $__env->make('commonbackend::layouts._table-footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php echo $__env->make('commonbackend::layouts.confirm-modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(Module::asset('commonbackend:admin_assets/js/includes/h-functions.js')); ?>"></script>
    <script>

        $(document).ready(function () {
            $('table.dataTable').setTableOrder({
                form: 'form#filters'
            });
            deleteRow('<?php echo e(route(Helper::route('destroy'), '')); ?>');
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('commonbackend::layouts.admin_app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>