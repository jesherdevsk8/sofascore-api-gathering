<?php

function request(string $url): array {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36");
  curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate, br, zstd');

  $response = curl_exec($ch);
    
  if ($response === false) {
      echo "Erro na requisição: " . curl_error($ch);
      return [];
  }
  
  curl_close($ch);

  return json_decode($response, true);
}

?>