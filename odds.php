<?php

function getOdds(array $oddsFeatured): array {
  // Verify if the odds are available for the "Full time" market.
  if (empty($oddsFeatured['fullTime']['marketName'])
      || empty($oddsFeatured['fullTime']['choices'])) {
    return [];
  }

  $fullTimeOddsChoices = $oddsFeatured['fullTime']['choices'];
  $marketName = $oddsFeatured['fullTime']['marketName'];
  $convertedOdds = [];

  foreach ($fullTimeOddsChoices as $choice) {
    $decimalValue = fractionalToDecimal($choice['fractionalValue']);

    $convertedOdds[] = [
      'name' => $choice['name'],
      'decimalValue' => $decimalValue,
      'marketName' => $marketName
    ];
  }

  return $convertedOdds;
}

function fractionalToDecimal(string $fractionalValue): float {
  list($numerator, $denominator) = explode('/', $fractionalValue);

  return round((float)($numerator / $denominator) + 1, 2);
}

