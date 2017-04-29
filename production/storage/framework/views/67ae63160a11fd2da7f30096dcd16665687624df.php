<div class="card-body" style="padding-top: 0;padding-bottom: 0">
    <div class="row">
        <div class="col-sm-3" style="margin: 24px 0;">
            Showing <?php echo e($obj->firstItem()); ?> to <?php echo e($obj->lastItem()); ?>

            of <?php echo e($obj->total()); ?>

        </div>
        <div class="col-sm-9 text-right">
            <?php echo e($obj->appends(request()->input())->links()); ?>

        </div>
    </div>
</div>