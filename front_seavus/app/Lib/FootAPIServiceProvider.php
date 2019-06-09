<?php

namespace App\Lib;

use \Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as PSR7Request;
use mysql_xdevapi\Exception;


class FootballDataUrls {
    public $getCompetitionsUrl = 'http://api.football-data.org/v2/competitions';
    public $getMatchesUrl = 'http://api.football-data.org/v2/matches';
    public $getTeamsUrl = 'http://api.football-data.org/v2/teams';

    private $availableCompetitions = [2000,2001,2002,2003,2013,2014,2015,2016,2017,2018,2019,2021];

    public function isCompetitionAvailable($competitionId) {
        return !in_array($competitionId, $this->availableCompetitions);
    }

    public function getCompetitionUrl($competitionId) {
        return $this->getCompetitionsUrl . '/' . $competitionId;
    }

    public function getCompetitionStandingsUrl($competitionId) {
        return $this->getCompetitionsUrl . '/' . $competitionId . '/standings';
    }

    public function getMatchesOfCompetitionUrl($competitionId) {
        return $this->getCompetitionUrl($competitionId) . '/matches';
    }

    public function getMatchUrl($match) {
        return $this->getMatchesUrl . '/' . $match;
    }

    public function getTeamUrl($team) {
        return $this->getTeamsUrl . '/' . $team;
    }
}

class FootAPIServiceProvider
{
    private $client;
    public $fdUrls;
    private $token = null;
    private $queryParams = [
        'id' => '', 'matchday' => '',
        'season' => '', 'status' => '',
        'venue' => '', 'dateFrom' => '',
        'dateTo' => '', 'stage' => '',
        'plan' => '', 'competitions' => '',
        'group' => '', 'limit' => '',
        'standingType' => ''
    ];

    public function __construct()
    {
        $this->client = new Client();
        $this->fdUrls = new FootballDataUrls();
    }

    private function buildQueryParams(Array $query = []) : String {
        $q = '';
        foreach($query as $key=>$val) {
            $q .= $key . '=' . $val . '&';
        }
        return $q;
    }

    public function getFootballData(Request $request, $url, $method='GET') {
        $this->token = config('app.token');
        $req = new PSR7Request($method,
            $url . '?' . $this->buildQueryParams($request->all()),
            [
                'X-Auth-Token' => $this->token
            ]);
        return $this->client->send($req)->getBody();
    }

    function getCompetitions(Request $request)
    {
        $result = $this->getFootballData($request, $this->fdUrls->getCompetitionsUrl);
        return $result;
    }

    function getCompetition(Request $request, $competition) {
        if($this->fdUrls->isCompetitionAvailable($competition))
            return json_encode(['error' => 'competition not available']);
        return $this->getFootballData($request, $this->fdUrls->getCompetitionUrl($competition));
    }

    function getMatchesOfCompetition(Request $request, $competition) {
        if($this->fdUrls->isCompetitionAvailable($competition))
            return json_encode(['error' => 'competition not available']);
        return $this->getFootballData($request, $this->fdUrls->getMatchesOfCompetitionUrl($competition));
    }

    function getCompetitionStandings(Request $request, $competition) {
        if($this->fdUrls->isCompetitionAvailable($competition))
            return json_encode(['error' => 'competition not available']);
        return $this->getFootballData($request, $this->fdUrls->getCompetitionStandingsUrl($competition));
    }

    function getMatches(Request $request) {
        return $this->getFootballData($request, $this->fdUrls->getMatchesUrl);
    }

    function getMatch(Request $request, $match) {
        return $this->getFootballData($request, $this->fdUrls->getMatchUrl($match));
    }

    function getTeams(Request $request) {
        return $this->getFootballData($request, $this->fdUrls->getTeamsUrl);
    }

    function getTeam(Request $request, $team) {
        return $this->getFootballData($request, $this->fdUrls->getTeamUrl($team));
    }

}
