
<?php
 $dsn = "mysql:dbname=mydb;hostname=localhost";
 $username = "np";
 $password = "irena773";

 try{
    $db = new PDO($dsn, $username, $password);
   }catch(PDOException $e){
    print('Connection failed:' . $e->getMessage());
    die();
   }
 $id_name = $_REQUEST['id_name'];
 $tour_name = $_REQUEST['tour_name'];
 $start_date = $_REQUEST['start_date'];
 $start_year = $_REQUEST['start_year'];
 $tour_country = $_REQUEST['tour_country'];

 $memos = $db->prepare("INSERT INTO wc_tournament(id, name, start_date, year, country)
                        VALUES($id_name,$tour_name,$start_date,$start_year,$tour_country)");
 $memos->execute();
?>

<?php
    $result = mysql_query('SELECT * FROM wc_tournament');
    if (!$result) {
        die('SELECTクエリーが失敗しました。'.mysql_error());
    }

    while ($row = mysql_fetch_assoc($result)) {
        print('<p>');
        print('id='.$row['id']);
        print(',name='.$row['name']);
        print(',name='.$row['start_date']);
        print(',name='.$row['year']);
        print(',name='.$row['country']);
        print('</p>');
    }
    
?>
