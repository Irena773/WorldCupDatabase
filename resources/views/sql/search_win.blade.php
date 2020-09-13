@extends('common.layout')
@section('addTitle')
<title id = "title">Search Win Matches</title>
@stop
@section('addCSS')
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
    <div class="title">Search World Cup Database </div>

    <form action="./search_win_results" method="POST">
        {{ csrf_field() }}

        <div id="search_form_area">
            <div class="title">Search Form</div>
                <div class="form-group">

                <form action ="./SQLController" method="POST">
                
                <label for="Tournament">Tournament</label>
                <select class="form-control" id="tournament" name="tournament">
                    <option id="tournament" value="" selected></option>  
                    <?php 
                        if(isset($tournaments))
                        foreach ($tournaments as $v) { ?>
                        <option name = "tournament" onclick= "clickTournament()";  value=<?php echo $v["name"]; ?>><?php echo $v["name"]; ?></option>
                    <?php } ?>
                </select>
                <!-- </form> -->
                
                <!-- <form action ="./SQLController" method="POST"> -->
                <label for="Round">Round</label>
                <select class="form-control" id="round" name="round">
                    <option  value="" selected></option> 
                    <option id="Knockout" onclick="clickKnockout()";>Knockout</option>
                    <option id ="Group"onclick = "clickRound()";>Group</option>
                    <?php 
                        if(isset($rounds)) 
                        foreach ($rounds as $v) { ?>
                        <option value=<?php echo $v["name"]; ?>><?php echo $v["name"]; ?></option>
                    <?php } ?>
                   
                  </select>
                <!-- </form> -->


                <!-- <form action ="./SQLController" method="POST"> -->
                <label for="Group" id="lavel_group">Group</label>
                <select class="form-control" id="select_group" name="group">
                    <option  value="" selected></option>   
                    <?php 
                        if(isset($groups))
                        foreach ($groups as $v) { ?>
                        <option id = group value=<?php echo $v["name"]; ?>><?php echo $v["name"]; ?></option>
                    <?php } ?>
                </select>
                <!-- </form> -->

                <script type="text/javascript">
                       document.getElementById("lavel_group").style.display ="none";
                       document.getElementById("select_group").style.display ="none";

                function clickTournament(){

                    
                }
                    
                function clickKnockout(){

                }       
                    
                function clickRound(){
                    
                    const select_group = document.getElementById("select_group");
                    const lavel_group = document.getElementById("lavel_group");

                if(select_group.style.display = "none"){
                    select_group.style.display = "block";
                    lavel_group.style.display = "block";
                  }
                else if(select_group.style.display = "block"){
                    select_group.style.display = "none";
                    lavel_group.style.display = "none";
                  }
                }
                </script>

                <!-- <form action ="./SQLController" method="POST"> -->
                <label for="Team">Team</label>
                <select class="form-control"  name="team">
                    <option value="" selected></option>  
                    <?php 
                        if(isset($teams))
                        foreach ($teams as $v) { ?>
                        <option   id = team onclick = "Team()"; value=<?php echo $v["name"]; ?> ><?php echo $v["name"]; ?></option>
                    <?php } ?> 
                </select>
                <!-- </form> -->
                <!-- <form action ="./SQLController" method="POST"> -->
                <label  for="Outcome" id='label_outcome'>Outcome(for the team you set)</label>
                <select  class="form-control" id='select_outcome' name="outcome">
                    <option value="" selected></option>   
                    <?php 
                        if(isset($outcomes))
                        foreach ($outcomes as $v) { ?>
                        <option id=outcome value=<?php echo $v["outcome"]; ?>><?php echo $v["outcome"]; ?></option>
                    <?php } ?>
                </select>

                <script type="text/javascript">
                    document.getElementById('label_outcome').style.display ="none";
                    document.getElementById('select_outcome').style.display ="none";
                    
                function Team(){
                    const select_outcome = document.getElementById('select_outcome');
                    const label_outcome = document.getElementById('label_outcome');
                    if(select_outcome.style.display = "none"){
                        select_outcome.style.display = 'block';
                        label_outcome.style.display = 'block';
                      
                     }else if(select_outcome.style.display ="block"){
                        select_outcome.style.display ='none';
                        label_outcome.style.display = 'none';
                     }
                 }

                </script>

                </form>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@stop
@include('common.footer')