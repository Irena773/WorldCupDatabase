<?php

namespace App\Http\Controllers;

use mysqli;
use PDO;
use DB;
use Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Book;

class SQLController extends Controller
{
    public function __construct()
    {
        $this->servername = "localhost";
        $this->username = "np";
        $this->password = "irena773";
        $this->dbname = "mydb";
    }

    // MySQLi: SQL Injection
    public function injectionMySQLi()
    {
        $loginUser = request('user');
        $loginPassword = request('password');
        if (!isset($loginUser) || !isset($loginPassword)) {
            abort(301, "user or password not set.");
        }

        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            abort(301, "database connection failed.");
        }

        $sql = "SELECT id FROM np_user WHERE id = '$loginUser' AND password = '$loginPassword';";
        $results = $conn->query($sql);

        $message = "Login Failed!!";
        if ($results->num_rows > 0) {
            $message = "Login Success!!";
        }
        return view('sql/injection_result', ['message' => $message, 'query' => $sql]);
    }

    // MySQLi: No SQL Injection
    public function noInjectionMySQLi()
    {
        $loginUser = request('user');
        $loginPassword = request('password');
        if (!isset($loginUser) || !isset($loginPassword)) {
            abort(301, "user or password not set.");
        }

        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            abort(301, "database connection failed.");
        }

        $sql = "SELECT id FROM np_user WHERE id = ? AND password = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $loginUser, $loginPassword);
        $stmt->execute();
        $results = $stmt->get_result();

        $message = "Login Failed!!";
        if ($results->num_rows > 0) {
            $message = "Login Success!!";
        }
        // MySQLi does not have api to get complete query after binding parameters
        return view('sql/injection_result', ['message' => $message, 'query' => $sql]);
    }

    // PDO: SQL Injection
    public function injectionPDO()
    {
        $loginUser = request('user');
        $loginPassword = request('password');
        if (!isset($loginUser) || !isset($loginPassword)) {
            abort(301, "user or password not set.");
        }

        $pdo = null;
        try {
            $dsn = "mysql:dbname=" . $this->dbname . ";host=" . $this->servername;
            $pdo = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            abort(301, "database connection failed." . $e->getMessage());
        }

        $sql = "SELECT id FROM np_user WHERE id = '$loginUser' AND password = '$loginPassword';";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $message = "Login Failed!!";
        if ($stmt->rowCount() > 0) {
            $message = "Login Success!!";
        }
        return view('sql/injection_result', ['message' => $message, 'query' => $stmt->queryString]);
    }

    // PDO: No SQL Injection
    public function noInjectionPDO()
    {
        $loginUser = request('user');
        $loginPassword = request('password');
        if (!isset($loginUser) || !isset($loginPassword)) {
            abort(301, "user or password not set.");
        }

        $pdo = null;
        try {
            $dsn = "mysql:dbname=" . $this->dbname . ";host=" . $this->servername;
            $pdo = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            abort(301, "database connection failed." . $e->getMessage());
        }

        $sql = "SELECT id FROM np_user WHERE id = :loginUser AND password = :loginPassword;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':loginUser', $loginUser);
        $stmt->bindParam(':loginPassword', $loinPassword);
        $stmt->execute();

        $message = "Login Failed!!";
        if ($stmt->rowCount() > 0) {
            $message = "Login Success!!";
        }
        // PDO does not have api to get complete query after binding parameters
        return view('sql/injection_result', ['message' => $message, 'query' => $stmt->queryString]);
    }

    // Laravel Query Builder: SQL Injection
    public function injectionLaravelQueryBuilder()
    {
        // Debug for SQL Statements
        DB::enableQueryLog();

        $loginUser = request('user');
        $loginPassword = request('password');
        if (!isset($loginUser) || !isset($loginPassword)) {
            abort(301, "user or password not set.");
        }

        $whereSql = "id = '$loginUser' and password = '$loginPassword'";
        $results = DB::table("np_user")
            ->selectRaw("id")
            ->whereRaw($whereSql)
            ->get();

        // Debug with Log Facade -> storage/logs/laravel.log
        Log::debug(DB::getQueryLog());

        $message = "Login Failed!!";
        if (count($results) > 0) {
            $message = "Login Success!!";
        }
        return view('sql/injection_result', ['message' => $message, 'query' => json_encode(DB::getQueryLog())]);
    }

    // Laravel Query Builder: No SQL Injection
    public function noInjectionLaravelQueryBuilder()
    {
        // Debug for SQL Statements
        DB::enableQueryLog();

        $loginUser = request('user');
        $loginPassword = request('password');
        if (!isset($loginUser) || !isset($loginPassword)) {
            abort(301, "user or password not set.");
        }

        $results = DB::table("np_user")
            ->select("id")
            ->where('id', '=', ':loginUser')
            ->where('password', '=', 'loginPassword')
            ->setBindings(['loginUser' => $loginUser, 'loginPassword' => $loginPassword])
            ->get();

        // Debug with Log Facade -> storage/logs/laravel.log
        Log::debug(DB::getQueryLog());

        $message = "Login Failed!!";
        if (count($results) > 0) {
            $message = "Login Success!!";
        }
        return view('sql/injection_result', ['message' => $message, 'query' => json_encode(DB::getQueryLog())]);
    }

    public function searchWinResults()
    {
       
        try{
            $dsn = "mysql:dbname=" .$this->dbname . ";host=" . $this->servername;
            $pdo = new PDO($dsn, $this->username, $this->password);
        }catch(PDOException $e){
            abort(301, "database connection failed." . $e->getMessage());
        }
        $team_name = request('team');
        $tournament_name = request('tournament');
        $round_name = request('round');
        $group_name = request('group');
        $outcome_name = request('outcome');
        

        if(isset($tournament_name) && isset($team_name) && isset($outcome_name) && $outcome_name == '勝利'){
            $team_tour_sql = "SELECT t.name AS TT ,r.name AS RR,  g.name AS GR, mat.start_date AS ST,te.name AS TE, res.rs AS RS, res.ra AS RA , ene.name AS ENE, te.lat AS LAT, te.lng AS LNG
            FROM wc_tournament as t, wc_round as r, wc_match as mat, wc_group as g, wc_result as res, wc_team as te, wc_team as ene 
            WHERE t.id = r.tournament_id and r.id = mat.round_id and  g.id = mat.group_id and mat.id = res.match_id and res.team_id0=te.id and res.team_id1 = ene.id 
            AND ((te.name =:team_name AND res.team_id0 = te.id AND res.outcome ='勝利') OR (ene.name=:team_name AND res.team_id1 = ene.id AND res.outcome ='敗北'))  
            AND t.year = :tournament_name
            ORDER BY t.name DESC"; 
            $stmt = $pdo->prepare($team_tour_sql);
            $stmt->bindParam(':team_name',$team_name);
            $stmt->bindParam(':tournament_name',$tournament_name);
            $stmt->execute();

            return view('sql/search_win_results', [
                'team' => $team_name,
                'tournament' => $tournament_name,
                'data' => $stmt,
                'query'=> $stmt->queryString
            ]);

        }
        else if(isset($tournament_name) && isset($team_name) && isset($outcome_name) && $outcome_name == '敗北'){
            $team_tour_sql = "SELECT t.name AS TT ,r.name AS RR,  g.name AS GR, mat.start_date AS ST,te.name AS TE, res.rs AS RS, res.ra AS RA , ene.name AS ENE, te.lat AS LAT, te.lng AS LNG
            FROM wc_tournament as t, wc_round as r, wc_match as mat, wc_group as g, wc_result as res, wc_team as te, wc_team as ene 
            WHERE t.id = r.tournament_id and r.id = mat.round_id and  g.id = mat.group_id and mat.id = res.match_id and res.team_id0=te.id and res.team_id1 = ene.id 
            AND ((te.name =:team_name AND res.team_id0 = te.id AND res.outcome ='敗北') OR (ene.name=:team_name AND res.team_id1 = ene.id AND res.outcome ='勝利'))  
            AND t.year = :tournament_name
            ORDER BY t.name DESC"; 
            $stmt = $pdo->prepare($team_tour_sql);
            $stmt->bindParam(':team_name',$team_name);
            $stmt->bindParam(':tournament_name',$tournament_name);
            $stmt->execute();

            return view('sql/search_win_results', [
                'team' => $team_name,
                'tournament' => $tournament_name,
                'data' => $stmt,
                'query'=> $stmt->queryString
            ]);
        }
        else if (isset($tournament_name) && !isset($team_name) && !isset($outcome_name)) {
            $tour_sql = "SELECT DISTINCT te.name AS TT ,r.name AS RR,  g.name AS GR, mat.start_date AS ST,te.name AS TE, res.rs AS RS, res.ra AS RA , ene.name AS ENE, te.lat AS LAT, te.lng AS LNG
                         FROM wc_tournament as t, wc_round as r, wc_match as mat, wc_group as g, wc_result as res, wc_team as te, wc_team as ene 
                         WHERE t.id = r.tournament_id and r.id = mat.round_id and  g.id = mat.group_id and mat.id = res.match_id and res.team_id0=te.id and res.team_id1 = ene.id 
                         AND t.year =:tournament_name ORDER BY t.name";

            $stmt = $pdo->prepare($tour_sql);
            $stmt->bindParam(':tournament_name', $tournament_name);
            $stmt->execute();

            return view('sql/search_win_results', [
                'tournament' => $tournament_name,
                'data' => $stmt,
                'query'=> $stmt->queryString
            ]);

            
        }
        else if (isset($team_name) && !isset($tournament_name) && isset($outcome_name) && $outcome_name == '勝利' ) {

            $team_sql = "SELECT t.name AS TT ,r.name AS RR,  g.name AS GR, mat.start_date AS ST,te.name AS TE, res.rs AS RS, res.ra AS RA , ene.name AS ENE, te.lat AS LAT, te.lng AS LNG
                        FROM wc_tournament as t, wc_round as r, wc_match as mat, wc_group as g, wc_result as res, wc_team as te, wc_team as ene 
                        WHERE t.id = r.tournament_id and r.id = mat.round_id and  g.id = mat.group_id and mat.id = res.match_id and res.team_id0=te.id and res.team_id1 = ene.id 
                        AND ((te.name =:team_name AND res.team_id0 = te.id AND res.outcome ='勝利') OR (ene.name=:team_name AND res.team_id1 = ene.id AND res.outcome ='敗北'))  
                        ORDER BY t.name DESC"; 
            $stmt = $pdo->prepare($team_sql);
            $stmt->bindParam(':team_name',$team_name);
            $stmt->execute();

            return view('sql/search_win_results', [
                'team' => $team_name,
                'data' => $stmt,
                'query'=> $stmt->queryString
            ]);

        }
        else if(isset($team_name) && !isset($tournament_name) && isset($outcome_name) && $outcome_name == '敗北'){

            $team_sql = "SELECT t.name AS TT ,r.name AS RR,  g.name AS GR, mat.start_date AS ST,te.name AS TE, res.rs AS RS, res.ra AS RA , ene.name AS ENE, te.lat AS LAT, te.lng AS LNG
                        FROM wc_tournament as t, wc_round as r, wc_match as mat, wc_group as g, wc_result as res, wc_team as te, wc_team as ene 
                        WHERE t.id = r.tournament_id and r.id = mat.round_id and  g.id = mat.group_id and mat.id = res.match_id and res.team_id0=te.id and res.team_id1 = ene.id 
                        AND ((te.name =:team_name AND res.team_id0 = te.id AND res.outcome ='敗北') OR (ene.name=:team_name AND res.team_id1 = ene.id AND res.outcome ='勝利'))  
                        ORDER BY t.name DESC"; 
            $stmt = $pdo->prepare($team_sql);
            $stmt->bindParam(':team_name',$team_name);
            $stmt->execute();

            return view('sql/search_win_results', [
                'team' => $team_name,
                'tournament' => $tournament_name,
                'outcome' => $outcome_name,
                'data' => $stmt,
                'query'=> $stmt->queryString
            ]);

        }
        else if(isset($team_name) && !isset($tournament_name)  && isset($outcome_name) && $outcome_name =='引き分け'){
            $team_sql = "SELECT t.name AS TT ,r.name AS RR,  g.name AS GR, mat.start_date AS ST,te.name AS TE, res.rs AS RS, res.ra AS RA , ene.name AS ENE, te.lat AS LAT, te.lng AS LNG
            FROM wc_tournament as t, wc_round as r, wc_match as mat, wc_group as g, wc_result as res, wc_team as te, wc_team as ene 
            WHERE t.id = r.tournament_id and r.id = mat.round_id and  g.id = mat.group_id and mat.id = res.match_id and res.team_id0=te.id and res.team_id1 = ene.id 
            AND ((te.name =:team_name AND res.team_id0 = te.id AND res.outcome ='引き分け') OR (ene.name=:team_name AND res.team_id1 = ene.id AND res.outcome ='引き分け'))  
            ORDER BY t.name DESC"; 
            $stmt = $pdo->prepare($team_sql);
            $stmt->bindParam(':team_name',$team_name);
            $stmt->execute();

            return view('sql/search_win_results', [
                'team' => $team_name,
                'tournament' => $tournament_name,
                'outcome' => $outcome_name,
                'data' => $stmt,
                'query'=> $stmt->queryString
            ]);

        }
        else if(!isset($team_name) && !isset($tournament_name)){
            abort(301, "team not set.");
        } 
    }


    public function search()
    {
        $options = [];
        $pdo = null;
        try{
            $dsn = "mysql:dbname=" .$this->dbname . ";host=" . $this->servername;
            $pdo = new PDO($dsn, $this->username, $this->password);
        }catch(PDOException $e){
            abort(301, "database connection failed." . $e->getMessage());
        }

        $tour_sql = "SELECT tr.name AS name ,tr.id AS id FROM wc_tournament AS tr";
        $tour_stmt = $pdo->prepare($tour_sql);
        $tour_stmt->execute(); 
        $round_sql = "SELECT DISTINCT name FROM wc_round  ";
        $round_stmt = $pdo->prepare($round_sql);
        $round_stmt ->execute();

        $group_sql = "SELECT DISTINCT name FROM wc_group  ";
        $group_stmt = $pdo->prepare($group_sql);
        $group_stmt ->execute();

        $team_sql = "SELECT DISTINCT name FROM wc_team ";
        $team_stmt = $pdo->prepare($team_sql);
        $team_stmt ->execute();

        $outcome_sql = "SELECT DISTINCT outcome FROM wc_result ";
        $outcome_stmt = $pdo->prepare($outcome_sql);
        $outcome_stmt ->execute();

        return view('sql/search_win', [
            'tournaments' => $tour_stmt,
            'rounds' => $round_stmt,
            'groups' => $group_stmt,
            'teams' => $team_stmt,
            'outcomes' => $outcome_stmt
        ]);

    }

    public function searchResults()
    {
        $tournament_id = request('tournament');
        $round_id = request('round');
        $group_id = request('group');
        $team_id = request('team');
        $outcome_id = request('outcome');

	    return [$tournament_id,$round_id,$group_id,$team_id,$outcome_id];
    }


}
