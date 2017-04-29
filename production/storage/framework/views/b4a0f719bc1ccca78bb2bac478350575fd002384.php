<?php echo $__env->make('media::layoutfiles.embedd', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startSection('style'); ?>
    <style>
        .picture{
            height: auto !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="content">
        <section class="">
            <div class="section-header">
                <h2 class="text-primary">General Settings</h2>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $__env->make('commonbackend::layouts._alert-response', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div><!--end .col -->
                    <div class="col-lg-8 col-lg-offset-2">
                        <?php echo Form::open(['route' => 'admin.settings.save', 'method'=>'post', 'class' => '']); ?>


                        <?php echo $__env->make('generalsettings::_form', [
                        'buttonText' => 'Update',
                        'title' => 'General Settings',
                        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo Form::close(); ?>


                    </div>
                </div>
            </div>
        </section>
    </div>



    <ul id="response">

    </ul>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

    <script src="<?php echo e(Module::asset("media:js/custom-functions.js")); ?>"></script>

<?php $__env->stopSection(); ?>

 


<?php echo $__env->make('commonbackend::layouts.admin_app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>