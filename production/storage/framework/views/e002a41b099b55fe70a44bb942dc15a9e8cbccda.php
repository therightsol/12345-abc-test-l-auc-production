<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div id="content">
        <section class="style-default-bright">
            <div class="section-header">
                <h2 class="text-primary">Dashboard</h2>
            </div>
            <div class="section-body">
                <div class="row">
                    

                    <?php if(session('already_logged_in')): ?>
                        <div class="col-sm-12">
                            <div class="alert alert-info">
                                    You are already logged in.
                            </div>
                        </div>
                    <?php endif; ?>


                </div>
            </div>
        </section>
    </div>

    


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function ($) {

        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('commonbackend::layouts.admin_app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>