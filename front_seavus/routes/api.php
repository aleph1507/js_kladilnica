<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::get('/competitions', 'FootAPIController@getCompetitions')->name('competitions.get');
Route::get('/competitions/{competition}', 'FootAPIController@getCompetition')->name('competition.get');
Route::get('/competitions/{competition}/standings', 'FootAPIController@getCompetitionStandings')->name('competitions.standings.get');
Route::get('/competitions/{competition}/matches', 'FootAPIController@getMatchesOfCompetition')->name('competitions.matches.get');
Route::get('/matches', 'FootAPIController@getMatches')->name('matches.get');
Route::get('/matches/{match}', 'FootAPIController@getMatch')->name('match.get');
Route::get('/teams', 'FootAPIController@getTeams')->name('teams.get');
Route::get('/teams/{team}', 'FootAPIController@getTeam')->name('team.get');
