<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class FootAPIController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    function getCompetitions()
    {

        $result = $this->client->get('http://api.football-data.org/v2/competitions')->getBody();

        return $result;
    }

    function getAreas()
    {

    }
}
