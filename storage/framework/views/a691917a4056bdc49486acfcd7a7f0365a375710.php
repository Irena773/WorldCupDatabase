<?php $__env->startSection('addTitle'); ?>
<title>Search Win Matches: Results</title>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('addMeta'); ?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQGKbv4WioLnjmUH3TDn8Cc4hVaBD0cd0" type="text/javascript"></script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('addCSS'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('addScript'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('common.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>
<body>
<div class="container">
<div id="googlemap">
    <div class="title">Search Win Matches: Results</div>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">TOURNAMENT</th>
                <th scope="col">ROUND</th>
                <th scope="col">GROUP</th>
                <th scope="col">DATE</th>
                <th scope="col">TEAM</th>
                <th scope="col">RESULT</th>
                <th scope="col">TEAM</th>
                <th scope="col">緯度</th>
                <th scope="col">経度</th>

            </tr>
        </thead>
        
        <?php foreach ($data as $val) { ?>
            <tr>
                <td><?php echo $val["TT"]; ?></td>
                <td><?php echo $val["RR"]; ?></td>
                <td><?php echo $val["GR"]; ?></td>
                <td><?php echo $val["ST"]; ?></td>
                <td><?php echo $val["TE"]; ?></td>
                <td><?php echo $val["RS"].  "-" .$val["RA"]. ""; ?></td>
                <td><?php echo $val["ENE"]; ?></td>
                <td><?php echo $val["LAT"]; ?></td>
                <td><?php echo $val["LNG"]; ?></td>
             
            </tr>
        <?php } ?>
    </table>

    <div class="title">Hello Google Map!!</div>
    <span>If your configuration is succeeded, you can see a world map in the following space.</span>
     <div id="gmap">
            <div id="mapinfo"></div>
            <div id="map" class="z-depth-1" style="height: 500px"></div>
        </div>
        <button type="submit" @click="addMarkerJapan" :disabled="false" class="btn btn-primary">Japan</button>
        <button type="submit" @click="addMarkerUSA" :disabled="false" class="btn btn-primary">U.S.A.</button>
        <button type="submit" @click="clearMarkers" :disabled="false" class="btn btn-primary">Clear Markers</button>
        </div>
    </div>
</div>
    <!-- ハッシュ付きファイルの最新の名前を自動的に判定 -->
    <script src="<?php echo e(mix('js/gmap.js')); ?>">
    </script>

</body>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('common.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>