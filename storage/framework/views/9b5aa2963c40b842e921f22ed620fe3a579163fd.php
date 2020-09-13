<?php $__env->startSection('addTitle'); ?>
<title>Hello AJAX!!</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('addMeta'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('addCSS'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('common.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>

<div class="container">
    <div id="hello_ajax">
        <div class="title">Hello AJAX!!</div>
        <div><span>Push button to get message from the server: </span></div>
        <button type="submit" @click="showMessage1" :disabled="false" class="btn btn-primary">Show Message1</button>
        <button type="submit" @click="showMessage2" :disabled="false" class="btn btn-primary">Show Message2</button>
        <div class="title">{{ message }}</div>
    </div>
</div>

<script src="<?php echo e(mix('js/hello_ajax.js')); ?>">
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('common.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>