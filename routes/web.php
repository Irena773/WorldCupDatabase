<?php


Route::get('/', function () {
    return view('welcome');
});


Route::get('/sql/injection', function () {
    return view('sql/injection');
});
//Route::post('/sql/injection', 'SQLController@injectionMySQLi');
Route::post('/sql/injection', 'SQLController@noInjectionMySQLi');
// Route::post('/sql/injection', 'SQLController@injectionPDO');
// Route::post('/sql/injection', 'SQLController@noInjectionPDO');
// Route::post('/sql/injection', 'SQLController@injectionLaravelQueryBuilder');
// Route::post('/sql/injection', 'SQLController@noInjectionLaravelQueryBuilder');


Route::get('/sql/search_win', function () {
    return view('sql/search_win');
});


Route::post('/sql/search_win_results', 'SQLController@searchWinResults');

Route::get('/ui/tournaments/{id?}', 'WCController@showTournaments');
Route::get('/ui/results/{tournament_id}', 'WCController@showResults');

// parameters via Form (POST)
Route::get('/ui/search', 'WCController@search');
Route::post('/ui/search_results', 'WCController@searchResults');



// Sample: VueJS
Route::get('/vuejs/hello_vuejs', function () {
    return view('vuejs/hello_vuejs', [
        'message' => "Hello VueJS!! from Server",
        'select_data' => [
            ['value' => "1", 'text' => "A"],
            ['value' => "2", 'text' => "B"],
            ['value' => "3", 'text' => "C"],
            ['value' => "4", 'text' => "D"],
            ['value' => "5", 'text' => "E"]
        ]
    ]);
});

Route::get('/ajax/hello_ajax', function () {
    return view('ajax/hello_ajax');
});
Route::get('/ajax/hello_ajax_message', function () {
    $data = [
        "message1" => "Welcome to Fantastic AJAX World!!",
        "message2" => "async/await is latest way for AJAX handling."
    ];
    return json_encode($data);
});
Route::post('/ajax/hello_ajax_message', function () {
    $data = [
        "message1" => "Welcome to Fantastic AJAX World!!",
        "message2" => "async/await is latest way for AJAX handling."
    ];
    return json_encode($data);
});

// Sample: PHP Function for DB Search
Route::get('/sql/search_win', function () {
    return view('sql/search_win');
});

Route::get('/sql/search_win/', 'SQLController@search');
Route::post('/sql/search_win/', 'SQLController@tournament_searchResults');

//Route::post('/sql/search_win_results', 'SQLController@searchWinResults');

Route::get('/gmap/hello_gmap', function () {
    return view('gmap/hello_gmap');
});

Route::get('/sql/test', function () {
    return view('sql/test');
});

Route::get('/sql/DB_search',function(){
    return view('sql/DB_search');
});


Route::post('/sql/DB_search_result','DBController@Insert');


Route::get('/sql/team', 'TESTController@updateTeam');
Route::post('/sql/team', 'TESTController@updateTeam');

Route::get('/sql/tournament', 'TESTController@LoadTour');
Route::get('/sql/outcome', 'TESTController@LoadOutcome');
Route::get('/sql/group', 'TESTController@LoadGroup');

Route::get('/sql/team_from_group','TESTController@updateTeamFromGroup');
Route::get('/sql/team_from_knock','TESTController@updateTeamFromKnock');
Route::post('/sql/team_from_group','TESTController@updateTeamFromGroup');
Route::post('/sql/team_from_knock','TESTController@updateTeamFromKnock');

Route::get('/sql/search', 'TESTController@Search');
Route::post('/sql/search', 'TESTController@Search');

Route::get('/sql/test_tournament', function () {
    $data = [
        "message1" => "Welcome to Fantastic AJAX World!!",
        "message2" => "async/await is latest way for AJAX handling."
    ];
    return json_encode($data);
});





?>
