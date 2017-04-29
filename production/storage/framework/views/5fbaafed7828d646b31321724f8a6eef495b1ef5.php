<?php $__env->startSection('table'); ?>
    <table class="table table-striped table-hover dataTable">
        <thead>
        <tr>
            <th>Id</th>
            <th class="sorting" data-table="Car.title">Title</th>
            <th class="sorting" data-table="Auction.bid_starting_amount">Starting Amount</th>
            <th class="sorting" data-table="Auction.average_bid">Average Bid</th>
            <th class="sorting" data-table="Auction.start_date">Start Date</th>
            <th class="sorting" data-table="Auction.end_date">End Date</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        <?php ($i = $auctions->firstItem()); ?>

        <?php $__currentLoopData = $auctions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $auction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($i); ?></td>
                <td><?php echo e($auction->title); ?></td>
                <td><?php echo e($auction->bid_starting_amount); ?></td>
                <td><?php echo e($auction->average_bid); ?></td>
                <td><?php echo e($auction->start_date->format('d F Y')); ?></td>
                <td><?php echo e($auction->end_date->format('d F Y')); ?></td>
                <td width="150">
                    <a href="<?php echo e(route(Helper::route('edit'),$auction->id)); ?>" type="button" class="btn btn-icon-toggle" data-toggle="tooltip"
                       data-placement="top" data-original-title="Edit row">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" class="btn delete-row btn-icon-toggle"
                            data-id="<?php echo e($auction->id); ?>" data-toggle="tooltip"
                            data-placement="top" data-original-title="Delete row">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </td>
            </tr>

            <?php ($i++); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>
    ##parent-placeholder-93f8bb0eb2c659b85694486c41717eaf0fe23cd4##

    <script>

    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <style>

    </style>


<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'commonbackend::layouts.grid', ['pageTitle' => 'Auctions', 'obj' => $auctions] , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>