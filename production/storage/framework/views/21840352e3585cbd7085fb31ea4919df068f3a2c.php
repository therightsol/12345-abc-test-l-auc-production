<?php if($can): ?>
<form id="add_bid" method="post" action="<?php echo e(url('add_bid')); ?>">
    <?php echo e(csrf_field()); ?>

    <div class="financing_calculator margin-top-40">
        <h3>Bid On <?php echo e($auction->car->title); ?></h3>
        <div class="table-responsive">
            <table class="table no-border no-margin">
                <tbody>
                <tr>
                    <td>Max Allowed Bids:</td>
                    <td><?php echo e(isset($settings['max_allowed_bids'])?$settings['max_allowed_bids']: 'Unlimited'); ?></td>
                </tr>
                <tr>
                    <td>Bid Amount(<?php echo e(Helper::currencySymbol()); ?>) start from <?php echo e($auction->bid_starting_amount); ?>:</td>
                    <td><input type="number" name="bid_amount" id="bidinput" class="number cost" placeholder="<?php echo e($auction->bid_starting_amount); ?>"/></td>
                </tr>
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn-inventory pull-right calculate">Submit</button>

    </div>
</form>
    <?php endif; ?>
<?php $__env->startSection('js'); ?>
    ##parent-placeholder-93f8bb0eb2c659b85694486c41717eaf0fe23cd4##

    <script>
        $('#add_bid').submit(function (e) {
            e.preventDefault();
            var amount = <?php echo e(isset($auction->bid_starting_amount) ? $auction->bid_starting_amount : 0); ?>;
            if (parseInt($('#bidinput').val()) < amount) {
                alert('Min Bid Amount Is ' + amount);
                return false;
            }
            $(this)[0].submit();
        })
    </script>
<?php $__env->stopSection(); ?>