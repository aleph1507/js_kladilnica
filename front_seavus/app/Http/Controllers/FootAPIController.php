<?php

namespace App\Http\Controllers;

use App\Lib\FootAPIServiceProvider;
use \Illuminate\Http\Request;

class FootAPIController extends Controller {

    private $footApi;

    public function __construct(FootAPIServiceProvider $footApi)
    {
        $this->footApi = $footApi;
    }


    function getCompetitions(Request $request)
    {
        $result = $this->footApi->getCompetitions($request);
        return $result;
    }

    function getCompetition(Request $request, $competition) {
        $result = $this->footApi->getCompetition($request, $competition);
        return $result;
    }

    function getMatchesOfCompetition(Request $request, $competition) {
        $result = $this->footApi->getMatchesOfCompetition($request, $competition);
        return $result;
    }

    function getCompetitionStandings(Request $request, $competition) {
        $result = $this->footApi->getCompetitionStandings($request, $competition);
        return $result;
    }

    function getMatches(Request $request) {
        return $this->footApi->getMatches($request);
    }

    function getMatch(Request $request, $match) {
        return $this->footApi->getMatch($request, $match);
    }

    function getTeams(Request $request) {
        return $this->footApi->getTeams($request);
    }

    function getTeam(Request $request, $team) {
        return $this->footApi->getTeam($request, $team);
    }
}
