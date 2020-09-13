@extends('common.layout')
@section('addTitle')
<title>Search World Cup Database</title>
@stop
@include('common.header')
@section('content')

<style>
    #search_form_area {
        padding: 0.5em 1em;
        margin: 2em 0;
        background: #f0f7ff;
        border: dashed 2px #5b8bd0;
    }
</style>

<div class="container">
    <div class="title">Search World Cup Database</div>

    <form action="./search_results" method="POST">
        {{ csrf_field() }}

        <div id="search_form_area">
            <div class="title">Search Form</div>
            <div class="form-group">
                <label for="Tournament">Tournament</label>
                <select class="form-control" id="tournament" name="tournament">
                    <option value="" selected></option>
                    <?php foreach ($tournaments as $v) { ?>
                        <option value=<?php echo $v->id; ?>><?php echo $v->name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@stop
@include('common.footer')
