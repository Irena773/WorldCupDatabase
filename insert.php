<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>DATABASE INSERT</title>
<style>
    #search_form_area {
        padding: 0.5em 1em;
        margin: 2em 0;
        background: #f0f7ff;
        border: dashed 2px #5b8bd0;
    }
</style>

</head>


<div id="search_form_area" class="container">
        <div  class="title">データベース登録 </div>
        <label>トーナメントテーブル</label>
        <form method="POST" action="network.php">
        <tr>
                <th>id</th><br />
                <td><input type="text" name="id_name"></td><br />
        </tr>
        <tr>
                <th>大会名</th><br />
                <td><input type="text" name="tour_name"></td><br />
        </tr>
        <tr>
                <th>開始日</th><br />
                <td><input type="text" name="start_date"></td><br />
        </tr>
        <tr>
                <th>開催年</th><br />
                <td><input type="text" name="start_year"></td><br />
        </tr>
        <tr>
                <th>開催国</th><br />
                <td><input type="text" name="tour_country"></td><br />
        </tr>
        <button type="submit" class="btn btn-primary">登録</button>
        </div>
        </form>
 </html>