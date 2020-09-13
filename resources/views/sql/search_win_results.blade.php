@extends('common.layout')
@section('addTitle')
<title>Search Win Matches: Results</title>
<meta name="csrf-token" content="{{csrf_token()}}">
@stop
@section('addMeta')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQGKbv4WioLnjmUH3TDn8Cc4hVaBD0cd0" type="text/javascript"></script>

@stop
@section('addCSS')
@stop
@section('addScript')
@stop
@include('common.header')
@section('content')
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
    <script src="{{ mix('js/gmap.js') }}">
    </script>

</body>
@stop
@include('common.footer')