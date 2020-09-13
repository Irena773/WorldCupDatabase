@extends('common.layout')
@section('addTitle')
<title id = "title">Search Win Matches</title>
@stop
@section('addMeta')
<meta name="csrf-token" content="{{csrf_token()}}">
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

<div id="test">
    <form action="./DB_search_result" method="POST">
    {{ csrf_field() }}
    <div　id="search_form_area" class="container">
    <div  class="title">Search World Cup Database </div>
    <form action="./DBController" method="POST">
    <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                <th scope="col">大会id</th>
                <th scope="col">大会名</th>
                <th scope="col">開始日</th>
                <th scope="col">開催年</th>
                <th scope="col">開催国</th>
               
                </tr>
            </thread> 

            <tr>
            <td><input type="text" name="tournament_id"></td>
            <td><input type="text" name="tour_name"></td>
            <td><input type="text" name="start_date"></td>
            <td><input type="text" name="start_year"></td>
            <td><input type="text" name="tour_country"></td>
            </tr>
           
            <thead class="thead-dark">
                <tr>
                <th scope="col">ラウンドid</th>
                <th scope="col">ラウンド名</th>
                <th scope="col">ラウンド並び順</th>
                <th scope="col">ノックアウト式ラウンド</th>
                <th scope="col">ラウンド開始日付</th>
                <th scope="col">ラウンド終了日付</th>
                </tr>
            </thread> 

            <tr>
            <td><input type="text" name="round_id"></td>
            <td><input type="text" name="round_name"></td>
            <td><input type="text" name="round_ordering"></td>
            <td><input type="text" name="round_knockout"></td>
            <td><input type="text" name="round_start_date"></td>
            <td><input type="text" name="round_end_date"></td>
            </tr>

            <thead class="thead-dark">
                <tr>
                <th scope="col">試合ID</th>
                <th scope="col">グループID</th>
                </tr>
            </thread> 

            <tr>
            <td><input type="text" name="match_id"></td>
            <td><input type="text" name="group_id"></td>
            </tr>

            <thead class="thead-dark">
                <tr>
                <th scope="col">試合結果ID</th>
                <th scope="col">チームID</th>
                <th scope="col">相手チームID</th>
                <th scope="col">得点</th>
                <th scope="col">得点(延長戦)</th>
                <th scope="col">得点(PK戦)</th>
                </tr>
            </thread> 

            <tr>
            <td><input type="text" name="result_id"></td>
            <td><input type="text" name="team_id0"></td>
            <td><input type="text" name="team_id1"></td>
            <td><input type="text" name="rs"></td>
            <td><input type="text" name="rs_extra"></td>
            <td><input type="text" name="rs_pk"></td>
            </tr>

            <thead class="thead-dark">
                <tr>
                <th scope="col">失点</th>
                <th scope="col">失点(延長戦)</th>
                <th scope="col">失点(PK戦)</th>
                <th scope="col">得失点差</th>
                <th scope="col">勝敗</th>
                <th scope="col">勝敗(90分)</th>
                </tr>
            </thread> 

            <tr>
            <td><input type="text" name="ra"></td>
            <td><input type="text" name="ra_extra"></td>
            <td><input type="text" name="ra_pk"></td>
            <td><input type="text" name="difference"></td>
            <td><input type="text" name="outcome"></td>
            <td><input type="text" name="outcome_90min"></td>
            </tr>

            <thead class="thead-dark">
                <tr>
                <th scope="col">勝利数</th>
                <th scope="col">敗北数</th>
                <th scope="col">引き分け数</th>
                <th scope="col">勝点</th>
                <th scope="col">延長戦</th>
                <th scope="col">PK戦</th>
                </tr>
            </thread> 

            <tr>
            <td><input type="text" name="count_win"></td>
            <td><input type="text" name="count_lose"></td>
            <td><input type="text" name="count_stillmate"></td>
            <td><input type="text" name="point"></td>
            <td><input type="text" name="extra"></td>
            <td><input type="text" name="pk"></td>
            </tr>

            <thead class="thead-dark">
                <tr>
                <th scope="col">試合結果の重複表示</th>
                </tr>
            </thread> 

            <tr>
            <td><input type="text" name="duplicate"></td>
            </tr>

    </table>  
    <button type="submit" class="btn btn-primary">登録</button>
    </form>
    </div>
</form>
  
</div>

<!-- <script src="{{ mix('js/database.js') }}"></script> -->
@stop
@include('common.footer')
