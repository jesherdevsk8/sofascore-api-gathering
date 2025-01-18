<?php
// Dependencies
// sudo apt install php 8.1.2
// sudo apt install php8.1-curl

// https://www.sofascore.com/api/v1/sport/football/odds/1/2025-01-16
// https://www.sofascore.com/api/v1/sport/football/events/live
// https://www.sofascore.com/api/v1/event/13341576
// https://www.sofascore.com/api/v1/event/13269059/incidents
// https://www.sofascore.com/api/v1/event/13341576/odds/1/featured
// https://www.sofascore.com/api/v1/event/12421196/odds/1/all

// To run, use the command: php sofascore.php or php sofascore.php debug <event_id>

require_once('request.php');
require_once('save_json_file.php');
require_once('incidents.php');
require_once('odds.php');

const BASE_API = "https://www.sofascore.com/api/v1/";
const LIVE_EVENTS_API = "sport/football/events/live";

const URL = BASE_API . LIVE_EVENTS_API;

$data = request(URL);

rmdir_r("data/");

if (!empty($data['events'])) {
  echo "Resultados de futebol ao vivo:\n\n";

  foreach ($data['events'] as $event) {
    $eventId = $event['id'];
    
    if (isset($argv[1]) && $argv[1] == 'debug' && isset($argv[2]) && $argv[2] != $eventId) {
      // php sofascore.php debug 12530784
      continue;
    }
    
    $eventApi = BASE_API . "event/" . $eventId;
    $eventData = request($eventApi);
    $eventData = $eventData['event'];

    $round = isset($eventData['roundInfo']['round']) ? ", Rodada " . $eventData['roundInfo']['round'] : '';
    $tournamentName = $eventData['tournament']['name'];
    $countryName = $eventData['tournament']['category']['country']['name'] ?? '';

    echo "id: " . $eventId . " - " . $tournamentName . $round . "\n";

    $homeTeamName = $eventData['homeTeam']['fullName'];
    $awayTeamName = $eventData['awayTeam']['fullName'];

    $incidentsApi = BASE_API . "event/" . $eventId . "/incidents";
    $incidentsData = request($incidentsApi);
    $incidents = $incidentsData['incidents'] ?? [];

    if (isset($argv[1]) && $argv[1] == 'debug' && isset($argv[2]) && $argv[2] == $eventId) {
      // php sofascore.php debug 12530784
      save_json_file('event_incidents' . $eventId, $eventId, $incidentsData);
    }

    // Getting current incidents
    $incidentDetails = incidents($homeTeamName, $awayTeamName, $incidents);

    $homeTeamScore = $incidentDetails['homeTeamScore'] ?? 0;
    $awayTeamScore = $incidentDetails['awayTeamScore'] ?? 0;
    $currentGameTime = $incidentDetails['currentGameTime'] ?? 0;

    echo $homeTeamName . " " . $homeTeamScore . " x " . $awayTeamScore . " " . $awayTeamName . "\n";
    echo "Tempo atual do jogo: " . $currentGameTime . " minutos\n\n";

    $oddsEventApi = BASE_API . "event/" . $eventId . "/odds/1/featured";
    echo $oddsEventApi . "\n";
    $oddsEventData = request($oddsEventApi);
    $oddsFeatured = $oddsEventData['featured'] ?? [];

    if (isset($argv[1]) && $argv[1] == 'debug' && isset($argv[2]) && $argv[2] == $eventId) {
      // php sofascore.php debug 12530784
      save_json_file('odds_featured_' . $eventId, $eventId, $oddsEventData);
    }

    $currentOdds = getOdds($oddsFeatured);
    
    foreach ($currentOdds as $odd) {
      echo "Mercado: " . $odd["marketName"] . ", Resultado: " . $odd["name"] . ", Odds: " . $odd["decimalValue"] . "\n";
    }

    echo "\n\n";
  }
} else {
  echo "No live events found.\n";
}
