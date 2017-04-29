<?php echo $__env->make('media::layoutfiles.embedd', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .nopadding{
            padding: 0 !important;
            margin: 0 !important;
        }

        .no-left-padding{
            padding-left: 0 !important;
            margin-left: 0 !important;
        }

        .no-right-padding{
            padding-right: 0 !important;
            margin-right: 0 !important;
        }
    </style>
 <?php $__env->stopSection(); ?>

<?php $__env->startSection('form-title'); ?>
    <header>Add User</header>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('form-submit-buttons'); ?>
    <button type="submit" id="savebtn" class="btn btn-primary">Create</button>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('password'); ?>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group <?php echo e($errors->has('password') ? 'has-error' : ''); ?>">
                <input  tabindex="6" type="password" class="form-control" value="<?php echo e(old('password')); ?>" name="password"
                       id="password">
                <label for="password">Password</label>
                <?php echo $errors->first('password', '<p class="help-block">:message</p>'); ?>

            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group <?php echo e($errors->has('confirm_password') ? 'has-error' : ''); ?>">
                <input  tabindex="7" type="password" class="form-control" value="<?php echo e(old('confirm_password')); ?>"
                       name="confirm_password" id="confirm_password">
                <label for="confirm-password">Confirm Password</label>
                <?php echo $errors->first('confirm_password', '<p class="help-block">:message</p>'); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('form-open'); ?>
    <form class="form" action="<?php echo e(route('admin.users.store')); ?>" enctype="multipart/form-data" data-uid="" method="post" >
<?php $__env->stopSection(); ?>


<?php if(session ('user_saved')): ?>
    <?php if(session ('user_saved') == '1'): ?>
        <?php $__env->startSection('form-alerts'); ?>
            <div class="alert alert-success">
                User successfully created.
                <strong><a href="<?php echo e(route('admin.users.index')); ?>">Return Back</a></strong>
            </div>
        <?php $__env->stopSection(); ?>
    <?php else: ?>
        <?php $__env->startSection('form-alerts'); ?>
            <div class="alert alert-danger">
                Sorry! There is an error while creating a new user. <br />
                Please try again. If problem persists then please contact to developer.
            </div>
        <?php $__env->stopSection(); ?>
    <?php endif; ?>
<?php endif; ?>


<?php $__env->startSection('content'); ?>
    <div id="content">
        <section class="">
            <div class="section-body">
                <div class="row">
                    <!-- BEGIN ALERT - REVENUE -->
                    <div class="col-sm-12">

                            <?php echo $__env->make('users::includes.add-user-form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    </div>

                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>

        jQuery('#lastname').blur(function (){
            var firstname = jQuery('#firstname').val();
            var lastname = $(this).val();

            var display_name = firstname + ' ' + lastname;

            jQuery('#display_name').val(display_name).addClass('dirty');
        });
    </script>
            <script src="<?php echo e(Module::asset("media:js/custom-functions.js")); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make( Module::get('commonbackend') != NULL ? 'commonbackend::layouts.admin_app': 'users::layouts.master' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>