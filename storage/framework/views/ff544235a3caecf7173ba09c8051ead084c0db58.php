<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <!-- <img src="/png/logo.png" class="rounded-circle pt-5 pl-5 pr-5" style="max-height: 27vh;background-color:black;" > -->
            <img src="<?php echo e($user->profile->profileImage()); ?>" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
             <div class="d-flex align-items-center pb-3">
                    <div class="h4"><?php echo e($user->username); ?></div>  
                    
                    <follow-button user-id="<?php echo e($user->id); ?>" follows="<?php echo e($follows); ?>"></follow-button>
             </div>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $user->profile)): ?>      
                 <a href="/p/create">Add New Post</a>
            <?php endif; ?>
            </div>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $user->profile)): ?>
                 <a href="/profile/<?php echo e($user->id); ?>/edit">Edit Profile</a>
            <?php endif; ?>
            <div class="d-flex">
               <!--  <div class="pr-5"><strong><?php echo e($user->posts->count()); ?></strong> posts</div>
                <div class="pr-5"><strong><?php echo e($user->profile->followers->count()); ?></strong> followers</div>
                <div class="pr-5"><strong><?php echo e($user->following->count()); ?></strong> following</div> -->
                <div class="pr-5"><strong><?php echo e($postCount); ?></strong> posts</div>
                <div class="pr-5"><strong><?php echo e($followersCount); ?></strong> followers</div>
                <div class="pr-5"><strong><?php echo e($followingCount); ?></strong> following</div>

            </div>
            <!-- <div class="pt-4 font-weight-bold">WishComeTrue.org</div>
            <div>World is a beautiful place. We have to take care of this place to hand it over to future generation.Stay calm Stay happy.Take care of your loved ones.</div>
            <div><a href="#">www.WishComeTrue.org</a></div> -->

            <div class="pt-4 font-weight-bold"><?php echo e($user->profile->title); ?></div>
            <div><?php echo e($user->profile->description); ?></div>
            <div><a href="#"><?php echo e($user->profile->url ?? 'N/A'); ?></a></div>

        </div>
    </div>

    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Dashboard')); ?></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <?php echo e(__('You are logged in!')); ?>

                </div>
            </div>
        </div>
    </div> -->
    <div class="row pt-5">
        <?php $__currentLoopData = $user->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-4 pb-4">
            <a href="/p/<?php echo e($post->id); ?>">
                <img src="/storage/<?php echo e($post->image); ?>" class="w-100">
            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /workspaces/Wishgram-/resources/views/profiles/index.blade.php ENDPATH**/ ?>