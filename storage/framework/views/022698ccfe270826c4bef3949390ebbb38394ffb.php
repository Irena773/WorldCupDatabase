<?php $__env->startSection('addTitle'); ?>
<title id = "title">Search Win Matches</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('addMeta'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQGKbv4WioLnjmUH3TDn8Cc4hVaBD0cd0" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('addCSS'); ?>
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


    <div id="test">
    <div id="search_form_area" class="container">
    <div  class="title">Search World Cup Database </div>
   
        <label for="Tournament">Tournament</label>
                <select  @click="LoadTour" :disabled="false" class="form-control" id="tournament" name="tournament">
                    <option id="tournament" name="tournament" @click="updateTeam(tournament.name)" :disabled="false" v-bind:value='tournament.name'  v-for="tournament in tournaments">{{tournament.name}}</option>  
                </select>   


        <label for="Round">Round</label>
                <select class="form-control" id="round" name="round">
                    <option></option>
                    <option @click="updateTeam_group" :disabled="false" id="group">Group</option>
                    <option @click="updateTeam_knock" :disabled="false" id="knockout">Knockout</option>  
        </select>  

        <label for="Team">Team</label>
                <select class="form-control" id="team" name="team">
                    <option></option>
                    <option id="team" @click="select_team(team.name)" :disabled="false" name="team" v-for="team in teams" value="" >{{team.name}}</option>  
                </select>  

        <div :style="{display:isDisplayGroup}">
        <label for="Group">Group</label>
                <select @click="LoadGroup" class="form-control" id="group" name="group">
                    <option></option>
                    <option  id="group" v-for="group in groups">{{group.name}}<option>
                </select>
        </div>

        <div :style = "{display:isDisplayOutcome}">
        <label for="Outcome" id="label_outcome">Outcome(for the team you set)</label>
                <select @click="LoadOutcome" class="form-control" id="select_outcome" name="outcome">
                    <option></option>
                   <option id="outcome" @click="select_out(outcome.outcome)" v-for="outcome in outcomes">{{outcome.outcome}}</option>
                </select>
        </div>

        <button type="submit" @click="Search" :disabled="false" class="btn btn-primary">Submit</button>
        
        </div>

        

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
                 

                </tr>
            </thead>
                <tr v-for="search in searchs">
                    <td id="tournament">{{search.TT}}</td>
                    <td id="round">{{search.RR}}</td>
                    <td id="group" >{{search.GR}}</td>
                    <td id="date">{{search.ST}}</td>
                    <td @click  = "addBlueMarkerMatch(search.TE)" :disabled="false" id="team">{{search.TE}}</td>
                    <td id="result">{{search.RS}}-{{search.RA}}</td>
                    <td @click  = "addBlueMarkerMatch(search.ENE)" :disabled="false" id="enemy">{{search.ENE}}</td>
                  
                </tr>
        </table>    
</div>  

     <div id="gmap">
            <div id="mapinfo"></div>
            <div id="map" class="z-depth-1" style="height: 500px"></div>
    </div>
</div>

<script src="<?php echo e(mix('js/test.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('common.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>