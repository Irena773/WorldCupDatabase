<?php $__env->startSection('addTitle'); ?>
<title>Hello Google Map!!</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('addMeta'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('addCSS'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('addScript'); ?>
<!-- Google Map JavaScript Library -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=API_KEY" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('common.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>

<div class="container">
    <div id="hello_gmap">
        <div class="title">Hello Google Map!!</div>
        <span>If your configuration is succeeded, you can see a world map in the following space.</span>
        <div id="gmap">
            <div id="mapinfo"></div>
            <div id="map" class="z-depth-1" style="height: 500px"></div>
        </div>
        <button type="submit" @click="addMarkerJapan" :disabled="false" class="btn btn-primary">Add Marker at Japan</button>
        <button type="submit" @click="addMarkerUSA" :disabled="false" class="btn btn-primary">Add Marker at U.S.A.</button>
        <button type="submit" @click="clearMarkers" :disabled="false" class="btn btn-primary">Clear Markers</button>
    </div>
</div>

<script src="<?php echo e(mix('js/hello_gmap.js')); ?>">
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('common.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>