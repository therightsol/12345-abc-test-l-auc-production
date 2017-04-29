<?php (   $maxFileSize = ini_get('upload_max_filesize')); ?>
<?php (   $maxFileSize = str_replace('M', '', $maxFileSize)); ?>
<?php if(! isset($gallery_images)): ?>
    <?php ($gallery_images = ''); ?>
<?php endif; ?>
<?php $__env->startSection('style'); ?>
    ##parent-placeholder-26ec8d00fb6b55466b3a115f1d559422a7fa7aac##
    <link type="text/css" rel="stylesheet" href="<?php echo e(Module::asset('media:css/bootstrap-datepicker/datepicker3.css')); ?>" />
    <?php echo $__env->make('media::layoutfiles.embedd.includes.styles', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    ##parent-placeholder-93f8bb0eb2c659b85694486c41717eaf0fe23cd4##
    <?php echo $__env->make('media::layoutfiles.embedd.includes.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    ##parent-placeholder-040f06fd774092478d450774f5ba30c5da78acc8##
    <?php echo $__env->make('media::layoutfiles.embedd.media-modal-viewer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('insert-image-code'); ?>

    <div class="img img-thumbnail" id="picture-btn" style="position: relative;">
        <i class="ajax-loader single-img medium animate-spin" style="display: none"></i>

        <img class="picture" data-picture="<?php if(!empty(old('picture'))): ?><?php echo e(asset(old('picture'))); ?><?php elseif(isset($featured_img)): ?><?php echo e(url('/') . '/' . $featured_img); ?> <?php else: ?><?php echo e(asset('images/image-not-found-100x100.png')); ?><?php endif; ?>" id="picture"
             src="<?php if(!empty(old('picture'))): ?><?php echo e(asset(old('picture'))); ?><?php elseif(isset($featured_img)): ?><?php echo e(url('/') . '/' . $featured_img); ?><?php else: ?><?php echo e(asset('images/image-not-found-100x100.png')); ?><?php endif; ?>" style="    height: 200px;max-width: 290px" alt="profile-image" />
    </div>
    <input type="hidden" name="picture" id="picture-val" value="<?php if(!empty(old('picture'))): ?><?php echo e((old('picture'))); ?><?php elseif(isset($featured_img)): ?><?php echo e($featured_img); ?> <?php else: ?><?php echo e('images/image-not-found-100x100.png'); ?><?php endif; ?>">

    <p class="text-center no-margin" >Click the image to edit or update</p>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('insert-product-variation-code'); ?>



    <div class="img img-thumbnail" id="picture-btn" style="position: relative;">
        <i class="ajax-loader single-img medium animate-spin" style="display: none"></i>

        <img class="picture" data-picture="<?php if(!empty(old('picture'))): ?><?php echo e(asset(old('picture'))); ?><?php elseif(isset($featured_img)): ?><?php echo e(url('/') . '/' . $featured_img); ?> <?php else: ?><?php echo e(asset('images/image-not-found-100x100.png')); ?><?php endif; ?>" id="picture"
             src="<?php if(!empty(old('picture'))): ?><?php echo e(asset(old('picture'))); ?><?php elseif(isset($featured_img)): ?><?php echo e(url('/') . '/' . $featured_img); ?><?php else: ?><?php echo e(asset('images/image-not-found-100x100.png')); ?><?php endif; ?>" style="    height: 200px;max-width: 290px" alt="profile-image" />
    </div>
    <input type="hidden" name="picture" id="picture-val" value="<?php if(!empty(old('picture'))): ?><?php echo e((old('picture'))); ?><?php elseif(isset($featured_img)): ?><?php echo e($featured_img); ?> <?php else: ?><?php echo e('images/image-not-found-100x100.png'); ?><?php endif; ?>">

    <p class="text-center no-margin" >Click the image to edit or update</p>


<?php $__env->stopSection(); ?>



<?php $__env->startSection('insert-image-gallery'); ?>

    <div class="image_gallery_container" id="image_gallery_container">
         <div class='hidden'>
            <input type='hidden' name="gallery_images_ids" id='gallery_images_ids' value='' />
        </div>
    </div>
    <div style="text-align: center; margin-top: 10px;">
        <i class="ajax-loader gallery medium animate-spin" style="display: none;"></i>
        <input type="button" class="btn btn-sm btn-primary" value="Click to add Images" id="gallery_pictures-btn">
    </div>
<?php $__env->stopSection(); ?>

