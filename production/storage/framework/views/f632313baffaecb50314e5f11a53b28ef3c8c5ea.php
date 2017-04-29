<?php echo $__env->yieldContent('form-open', '<form class="form"  id="modal-form" data-uid="" method="post" >'); ?>
<?php echo e(csrf_field()); ?>

<?php echo $__env->yieldContent('form-alerts', ''); ?>
<div class="card">
    <?php if(!isset($user_saved)): ?>
    <div class="card-head style-primary">
        <?php echo $__env->yieldContent('form-title'); ?>
    </div>


    <div class="card-body floating-label">

        <div class="row">
            <div class="col-sm-7">
                <div class="form-group <?php echo e($errors->has('full_name') ? 'has-error' : ''); ?>">
                    <input autofocus type="text" class="form-control"  tabindex="1"
                           value="<?php if(!empty(old('full_name'))): ?><?php echo e(old('full_name')); ?><?php elseif(isset($user->full_name)): ?><?php echo e($user->full_name); ?><?php endif; ?>" id="full_name"
                           name="full_name">
                    <label for="full_name">Full Name</label>
                    <?php echo $errors->first('full_name', '<p class="help-block">:message</p>'); ?>

                </div>
                <div class="form-group <?php echo e($errors->has('username') ? 'has-error' : ''); ?>">
                    <input type="text" class="form-control"  tabindex="2"
                           value="<?php if(!empty(old('username'))): ?><?php echo e(old('username')); ?><?php elseif(isset($user->username)): ?><?php echo e($user->username); ?><?php endif; ?>"
                           name="username" id="username">
                    <label for="username">Username</label>
                    <?php echo $errors->first('username', '<p class="help-block">:message</p>'); ?>

                </div>
                <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
                    <input type="email" class="form-control"  tabindex="3"
                           value="<?php if(!empty(old('email'))): ?><?php echo e(old('email')); ?><?php elseif(isset($user->email)): ?><?php echo e($user->email); ?><?php endif; ?>"
                           name="email" id="email">
                    <label for="email">Email</label>
                    <?php echo $errors->first('email', '<p class="help-block">:message</p>'); ?>

                </div>
                <div class="col-sm-12 nopadding">
                    <div class="col-sm-6 no-left-padding">
                        <div class="form-group <?php echo e($errors->has('cnic') ? 'has-error' : ''); ?>">
                            <input type="text" class="form-control"  tabindex="4"
                                   value="<?php if(!empty(old('cnic'))): ?><?php echo e(old('cnic')); ?><?php elseif(isset($user->cnic)): ?><?php echo e($user->cnic); ?><?php endif; ?>"
                                   name="cnic" id="cnic">
                            <label for="cnic">CNIC</label>
                            <?php echo $errors->first('cnic', '<p class="help-block">:message</p>'); ?>

                        </div>
                    </div>
                    <div class="col-sm-6 no-right-padding">
                        <div class="form-group <?php echo e($errors->has('contact_number') ? 'has-error' : ''); ?>">
                            <input type="text" class="form-control"  tabindex="5"
                                   value="<?php if(!empty(old('contact_number'))): ?><?php echo e(old('contact_number')); ?><?php elseif(isset($user->contact_number)): ?><?php echo e($user->contact_number); ?><?php endif; ?>"
                                   name="contact_number" id="contact_number">
                            <label for="contact_number">Contact Number</label>
                            <?php echo $errors->first('contact_number', '<p class="help-block">:message</p>'); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 text-center">

                <?php echo $__env->yieldContent('insert-image-code'); ?>


            </div>

        </div>

        <?php echo $__env->yieldContent('password'); ?>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group <?php echo e($errors->has('url') ? 'has-error' : ''); ?>">
                    <input type="text"  tabindex="8" class="form-control" value="<?php if(!empty(old('url'))): ?><?php echo e(old('url')); ?><?php elseif(isset($user->url)): ?><?php echo e($user->url); ?><?php endif; ?>" name="url" id="url">
                    <label for="url">URL</label>
                    <?php echo $errors->first('url', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>


            <div class="col-sm-4">
                <div class="form-group <?php echo e($errors->has('user_role') ? 'has-error' : ''); ?>">

                    <label for="user_role">User Role</label>

                    <select  tabindex="9" class="form-control select2-list" name="user_role" id="user_role"
                            data-placeholder="Select Role">
                        <option selected value="">Choose Role</option>
                        <optgroup label="User Roles">
                            <?php $__currentLoopData = $userroles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userrole): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($userrole); ?>" <?php echo old('user_role') || ( isset($user->user_role) ? $user->user_role : '' ) == strtolower($userrole) ? 'selected' : ''; ?>>
                                    <?php echo e($userrole); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </optgroup>
                    </select>
                    <?php echo $errors->first('user_role', '<p class="help-block">:message</p>'); ?>



                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">

                    <label for="status">User Status</label>

                    <select  tabindex="10" class="form-control select2-list" name="status" id="status"
                            data-placeholder="status Role">
                        <option selected value="">Choose Status</option>
                        <optgroup label="User Status">
                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($status); ?>" <?php echo old('status') || ( isset($user->status) ? $user->status : '' ) == strtolower($status) ? 'selected' : ''; ?>>
                                    <?php echo e($status); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </optgroup>
                    </select>
                    <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>


                </div>
            </div>

        </div>
    </div>








    <div class="card-actionbar">
        <div class="card-actionbar-row">
            <?php echo $__env->yieldContent('form-submit-buttons'); ?>
        </div>
    </div>
    <?php endif; ?>
</div>
</div>
</form>
