<?php

namespace App\Http\Controllers;


use PDO;
use DB;
use Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Book;

class TESTController extends Controller
{
    public function __construct()
    {
        $this->servername = "localhost";
        $this->username = "np";
        $this->password = "irena773";
        $this->dbname = "mydb";
    }



public function LoadTour(){
    $options = [];
    $pdo = null;
    try{
        $dsn = "mysql:dbname=" .$this->dbname . ";host=" . $this->servername;
        $pdo = new PDO($dsn, $this->username, $this->password);
    }catch(PDOException $e){
        abort(301, "database connection failed." . $e->getMessage());
    }
    
    $tour_sql = "SELECT name from wc_tournament";
    $tour_stmt = $pdo->prepare($tour_sql);
    $tour_stmt ->execute();

    $data = json_encode($tour_stmt->fetchAll());
    $decoded_data = json_decode($data);
    
    header('Content-type: application/json');
    
    return json_encode($decoded_data);
    
}


public function LoadGroup(){
    $options = [];
    $pdo = null;
    try{
        $dsn = "mysql:dbname=" .$this->dbname . ";host=" . $this->servername;
        $pdo = new PDO($dsn, $this->username, $this->password);
    }catch(PDOException $e){
        abort(301, "database connection failed." . $e->getMessage());
    }
    
    $group_sql = "SELECT DISTINCT name from wc_group";
    $group_stmt = $pdo->prepare($group_sql);
    $group_stmt ->execute();

    $data = json_encode($group_stmt->fetchAll());
    $decoded_data = json_decode($data);
    
    header('Content-type: application/json');
    
    return json_encode($decoded_data);
}

public function LoadOutcome(){
    $options = [];
    $pdo = null;
    try{
        $dsn = "mysql:dbname=" .$this->dbname . ";host=" . $this->servername;
        $pdo = new PDO($dsn, $this->username, $this->password);
    }catch(PDOException $e){
        abort(301, "database connection failed." . $e->getMessage());
    }
    
    $outcome_sql = "SELECT DISTINCT outcome from wc_result";
    $outcome_stmt = $pdo->prepare($outcome_sql);
    $outcome_stmt ->execute();

    $data = json_encode($outcome_stmt->fetchAll());
    $decoded_data = json_decode($data);
    
    header('Content-type: application/json');
    
    return json_encode($decoded_data);
}

public function updateTeam(Request $request){
    $name = $request->name;
    $options = [];
    $pdo = null;
    try{
        $dsn = "mysql:dbname=" .$this->dbname . ";host=" . $this->servername;
        $pdo = new PDO($dsn, $this->username, $this->password);
    }catch(PDOException $e){
        abort(301, "database connection failed." . $e->getMessage());
    }
    
    
    $team_sql = "SELECT DISTINCT te.name 
            FROM wc_tournament as t, wc_round as r, wc_match as mat, wc_group as g, wc_result 
            as res, wc_team as te, wc_team as ene 
            WHERE  t.name = :request_name and t.id = r.tournament_id 
            and r.id = mat.round_id and  g.id = mat.group_id and mat.id = res.match_id
            and res.team_id0=te.id and res.team_id1 = ene.id 
            order by te.name ";
            
    $team_stmt = $pdo->prepare($team_sql);
    $team_stmt ->bindParam(':request_name',$name);
    $team_stmt ->execute();

    $data = json_encode($team_stmt->fetchAll());
    $decoded_data = json_decode($data);
    
    header('Content-type: application/json');
    
    return json_encode($decoded_data);
    
    }

    public function updateTeamFromGroup(Request $request){
    $name = $request->name;
    $options = [];
    $pdo = null;
    try{
        $dsn = "mysql:dbname=" .$this->dbname . ";host=" . $this->servername;
        $pdo = new PDO($dsn, $this->username, $this->password);
    }catch(PDOException $e){
        abort(301, "database connection failed." . $e->getMessage());
    }
    
    $team_sql = "SELECT DISTINCT te.name 
    FROM wc_tournament as t, wc_round as r, wc_match as mat, wc_group as g, wc_result 
    as res, wc_team as te, wc_team as ene 
    WHERE  t.name = :request_name and t.id = r.tournament_id 
    and r.id = mat.round_id and  g.id = mat.group_id and mat.id = res.match_id
    and res.team_id0=te.id and res.team_id1 = ene.id and r.knockout = '2'
    order by te.name ";
    
    $team_stmt = $pdo->prepare($team_sql);
    $team_stmt ->bindParam(':request_name',$name);
    $team_stmt ->execute();

    $data = json_encode($team_stmt->fetchAll());
    $decoded_data = json_decode($data);

    header('Content-type: application/json');

    return json_encode($decoded_data);
        }

    public function updateTeamFromKnock(Request $request){
        $name = $request->name;
        $options = [];
        $pdo = null;
        try{
            $dsn = "mysql:dbname=" .$this->dbname . ";host=" . $this->servername;
            $pdo = new PDO($dsn, $this->username, $this->password);
        }catch(PDOException $e){
            abort(301, "database connection failed." . $e->getMessage());
        }
        
        $team_sql = "SELECT DISTINCT te.name 
        FROM wc_tournament as t, wc_round as r, wc_match as mat, wc_group as g, wc_result 
        as res, wc_team as te, wc_team as ene 
        WHERE  t.name = :request_name and t.id = r.tournament_id 
        and r.id = mat.round_id and  g.id = mat.group_id and mat.id = res.match_id
        and res.team_id0=te.id and res.team_id1 = ene.id and r.knockout = '1'
        order by te.name ";
        
        $team_stmt = $pdo->prepare($team_sql);
        $team_stmt ->bindParam(':request_name',$name);
        $team_stmt ->execute();
    
        $data = json_encode($team_stmt->fetchAll());
        $decoded_data = json_decode($data);
    
        header('Content-type: application/json');
    
        return json_encode($decoded_data);

    }


    public function Search(Request $request){
        $tour_name = $request->tour_name;
        $team_name = $request->team_name; 
        $outcome_name = $request->outcome_name;

        $options = [];
        $pdo = null;
        try{
            $dsn = "mysql:dbname=" .$this->dbname . ";host=" . $this->servername;
            $pdo = new PDO($dsn, $this->username, $this->password);
        }catch(PDOException $e){
            abort(301, "database connection failed." . $e->getMessage());
        }

        if(isset($tour_name) && isset($team_name) && isset($outcome_name) && $outcome_name == '勝利'){
            $sql = "SELECT DISTINCT t.name AS TT ,r.name AS RR,  g.name AS GR, mat.start_date AS ST,te.name AS TE,
                     res.rs AS RS, res.ra AS RA , ene.name AS ENE, te.lat AS LAT, te.lng AS LNG, ene.lat AS ELAT, ene.lng AS ELNG
            FROM wc_tournament as t, wc_round as r, wc_match as mat, wc_group as g, wc_result as res, wc_team as te, wc_team as ene 
            WHERE t.id = r.tournament_id and r.id = mat.round_id and  g.id = mat.group_id and mat.id = res.match_id and res.team_id0=te.id and res.team_id1 = ene.id 
            AND ((te.name =:request_team_name AND res.team_id0 = te.id AND res.outcome ='勝利') OR (ene.name= :request_team_name AND res.team_id1 = ene.id AND res.outcome ='敗北'))  
            AND t.name = :request_tour_name ORDER BY t.name" ;
            $stmt = $pdo->prepare($sql);
            $stmt ->bindParam(':request_tour_name',$tour_name);
            $stmt ->bindParam(':request_team_name',$team_name);
            $stmt->execute();

            $data = json_encode($stmt->fetchAll());
            $decoded_data = json_decode($data);
            
            header('Content-type: application/json');
            return json_encode($decoded_data);
        }else if(isset($tour_name) && isset($team_name) && isset($outcome_name) && $outcome_name == '敗北'){
            $sql = "SELECT DISTINCT t.name AS TT ,r.name AS RR,  g.name AS GR, mat.start_date AS ST,te.name AS TE,
             res.rs AS RS, res.ra AS RA , ene.name AS ENE, te.lat AS LAT, te.lng AS LNG, ene.lat AS ELAT, ene.lng AS ELNG
            FROM wc_tournament as t, wc_round as r, wc_match as mat, wc_group as g, wc_result as res, wc_team as te, wc_team as ene 
            WHERE t.id = r.tournament_id and r.id = mat.round_id and  g.id = mat.group_id and mat.id = res.match_id and res.team_id0=te.id and res.team_id1 = ene.id 
            AND ((te.name =:request_team_name AND res.team_id0 = te.id AND res.outcome ='敗北') OR (ene.name= :request_team_name AND res.team_id1 = ene.id AND res.outcome ='勝利'))  
            AND t.name = :request_tour_name ORDER BY t.name" ;
            $stmt = $pdo->prepare($sql);
            $stmt ->bindParam(':request_tour_name',$tour_name);
            $stmt ->bindParam(':request_team_name',$team_name);
            $stmt->execute();

            $data = json_encode($stmt->fetchAll());
            $decoded_data = json_decode($data);
            
            header('Content-type: application/json');
            return json_encode($decoded_data);
        }else if(isset($tour_name) && isset($team_name) && isset($outcome_name) && $outcome_name == '引き分け'){
            $sql = "SELECT DISTINCT t.name AS TT ,r.name AS RR,  g.name AS GR, mat.start_date AS ST,te.name AS TE, 
            res.rs AS RS, res.ra AS RA , ene.name AS ENE, te.lat AS LAT, te.lng AS LNG, ene.lat AS ELAT, ene.lng AS ELNG
            FROM wc_tournament as t, wc_round as r, wc_match as mat, wc_group as g, wc_result as res, wc_team as te, wc_team as ene 
            WHERE t.id = r.tournament_id and r.id = mat.round_id and  g.id = mat.group_id and mat.id = res.match_id and res.team_id0=te.id and res.team_id1 = ene.id 
            AND ((te.name =:request_team_name AND res.team_id0 = te.id AND res.outcome ='引き分け') OR (ene.name= :request_team_name AND res.team_id1 = ene.id AND res.outcome ='引き分け'))  
            AND t.name = :request_tour_name ORDER BY t.name" ;
            $stmt = $pdo->prepare($sql);
            $stmt ->bindParam(':request_tour_name',$tour_name);
            $stmt ->bindParam(':request_team_name',$team_name);
            $stmt->execute();

            $data = json_encode($stmt->fetchAll());
            $decoded_data = json_decode($data);
            
            header('Content-type: application/json');
            return json_encode($decoded_data);

        }
          
    }

    
    
} 

    
?>
