<?php

namespace App\Http\Controllers;


use PDO;
use DB;
use Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Book;

class DBController extends Controller
{
    public function __construct()
    {
        $this->servername = "localhost";
        $this->username = "np";
        $this->password = "irena773";
        $this->dbname = "mydb";
    }

    public function Insert(){
        $options = [];
        $pdo = null;
        try{
            $dsn = "mysql:dbname=" .$this->dbname . ";host=" . $this->servername;
            $pdo = new PDO($dsn, $this->username, $this->password);
        }catch(PDOException $e){
            abort(301, "database connection failed." . $e->getMessage());
        }
        

        $tour_id = request('tournament_id');
        $tour_name = request('tour_name');
        $start_name = request('start_date');
        $start_year = request('start_year');
        $tour_country = request('tour_country');
   
        $tournament_sql = "INSERT INTO wc_tournament VALUES (:tour_id,:tour_name,:start_name,:start_year,:tour_country)";
        $tournament_stmt= $pdo->prepare($tournament_sql);
        $tournament_stmt->bindParam(':tour_id',$tour_id);
        $tournament_stmt->bindParam(':tour_name',$tour_name);
        $tournament_stmt->bindParam(':start_name',$start_name);
        $tournament_stmt->bindParam(':start_year',$start_year);
        $tournament_stmt->bindParam(':tour_country',$tour_country);
        $tournament_stmt->execute();
       

        $round_id=request('round_id');
        $round_name =request('round_name');
        $round_ordering = request('round_ordering');
        $round_knockout = request('round_knockout');
        $round_start_date = request('round_start_date');
        $round_end_date = request('round_end_date');

        $round_sql = "INSERT INTO wc_round
                       VALUES (:round_id,:tour_id, :round_name, :round_ordering,:round_knockout,:round_start_date,:round_end_date)";
        $round_stmt = $pdo->prepare($round_sql);
        $round_stmt->bindParam(':round_id', $round_id);
        $round_stmt->bindParam(':tour_id', $tour_id);
        $round_stmt->bindParam(':round_name', $round_name);
        $round_stmt->bindParam(':round_ordering', $round_ordering);
        $round_stmt->bindParam(':round_knockout', $round_knockout);
        $round_stmt->bindParam(':round_start_date', $round_start_date);
        $round_stmt->bindParam(':round_end_date', $round_end_date);
        $round_stmt->execute();
      
        $match_id = request('match_id');
        $group_id = request('group_id');
        $match_sql = "INSERT INTO wc_match 
                       VALUES (:match_id, :round_id, :group_id , :round_start_date, :round_ordering,:round_knockout)";
        $match_stmt = $pdo->prepare($match_sql);
        $match_stmt->bindParam(':match_id', $match_id);
        $match_stmt->bindParam(':round_id', $round_id);
        $match_stmt->bindParam(':group_id', $group_id);
        $match_stmt->bindParam(':round_start_date', $round_start_date);
        $match_stmt->bindParam(':round_ordering', $round_ordering);
        $match_stmt->bindParam(':round_knockout', $round_knockout);
        $match_stmt->execute();

        

        $result_id = request('result_id');
        $team_id0 = request('team_id0');
        $team_id1 = request('team_id1');
        $rs = request('rs');
        $rs_extra = request('rs_extra');
        $rs_pk = request('rs_pk');

        $ra = request('ra');
        $ra_extra = request('ra_extra');
        $ra_pk = request('ra_pk');
        $difference = request('difference');
        $outcome = request('outcome');
        $outcome_90min = request('outcome_90min');

        $count_win = request('count_win');
        $count_lose = request('count_lose');
        $count_stillmate = request('count?stillmate');
        $point = request('point');
        $estra = request('extra');
        $pk = request('pk');
        $duplicate = request('duplicate');

        $result_sql = "INSERT  INTO wc_result
                        VALUES (:result_id, :match_id,:team_id0,:team_id1,:rs, :rs_extra,:rs_pk,:ra,:ra_extra, :ra_pk,
                                :difference,:outcome,:outcome_90min,:count_win,:count_lose,:count_stillmate,:point,:extra,:pk,:duplicate)";

        $result_stmt = $pdo->prepare($result_sql);
        $result_stmt->bindParam(':result_id', $result_id);
        $result_stmt->bindParam(':match_id', $match_id);
        $result_stmt->bindParam(':team_id0', $team_id0);
        $result_stmt->bindParam(':team_id1', $team_id1);
        $result_stmt->bindParam(':rs', $rs);
        $result_stmt->bindParam(':rs_extra', $rs_extra);
        $result_stmt->bindParam(':rs_pk', $rs_pk);
        $result_stmt->bindParam(':ra', $ra);
        $result_stmt->bindParam(':ra_extra', $ra_extra);
        $result_stmt->bindParam(':ra_pk', $ra_pk);
        $result_stmt->bindParam(':difference', $difference);
        $result_stmt->bindParam(':outcome', $outcome);
        $result_stmt->bindParam(':outcome_90min', $outcome_90min);
        $result_stmt->bindParam(':count_win', $count_win);
        $result_stmt->bindParam(':count_lose', $count_lose);
        $result_stmt->bindParam(':count_stillmate', $count_stillmate);
        $result_stmt->bindParam(':point', $point);
        $result_stmt->bindParam(':extra', $extra);
        $result_stmt->bindParam(':pk', $pk);
        $result_stmt->bindParam(':duplicate', $duplicate);
        $result_stmt->execute();

        
    
        return view('sql/DB_search_result',[
            'tournament' => $tournament_stmt,
            'round'=> $round_stmt,
            'match'=> $match_stmt,
            'result'=>$result_stmt
        ]);

    }
}
?>