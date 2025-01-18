<?php

function incidents(string $homeTeamName, string $awayTeamName, array $incidents): array {
  if (empty($homeTeamName) || empty($awayTeamName) || empty($incidents)) {
    return [];
  }

  $latestIncident = null;
  $maxTime = -1;

  foreach ($incidents as $incident) {
    $time = $incident['time'] ?? 0;

    if ($time > $maxTime) {
      $maxTime = $time;
      $latestIncident = $incident;
    }
  }

  $homeTeamScore = $latestIncident['homeScore'] ?? 0;
  $awayTeamScore = $latestIncident['awayScore'] ?? 0;
  // TODO: rever esse tempo atual que nao esta funcionando corretamente
  $currentGameTime = $latestIncident['time'] ?? 0;
  // TODO: adicionar acrescimos

  return [
    'homeTeamScore' => $homeTeamScore,
    'awayTeamScore' => $awayTeamScore,
    'currentGameTime' => $currentGameTime
  ];

  }
?>