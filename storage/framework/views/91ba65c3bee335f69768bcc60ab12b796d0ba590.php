<?php $__env->startSection('addTitle'); ?>
<title>SQL Injection Sample</title>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('common.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>

<style>
    #search_form_area {
        padding: 0.5em 1em;
        margin: 2em 0;
        background: #f0f7ff;
        border: dashed 2px #5b8bd0;
    }
</style>

<div class="container">
    <div class="title">SQL Injection Sample</div>

    <form action="./injection" method="POST">
        <?php echo e(csrf_field()); ?>


        <div id="login_form">
            <div class="title">Login Form</div>
            <div class="form-group">
                <label for="User">User</label>
                <input class="form-control" id="user" name="user"></input>
            </div>
            <div class="form-group">
                <label for="Password">Password</label>
                <input class="form-control" id="password" name="password"></input>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('common.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>