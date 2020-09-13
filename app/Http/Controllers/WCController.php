<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Illuminate\Http\Request;

class WCController extends Controller
{
    public function search()
    {
        DB::enableQueryLog();

        $options = [];
        $tournament_results = DB::table('wc_tournament')
            ->select('id', 'name')
            ->get();

        return view('search', [
            'tournaments' => $tournament_results
        ]);
    }

    public function searchResults()
    {
        $tournament_id = request('tournament');
	return $tournament_id;
    }
}
