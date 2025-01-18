<?php

function save_json_file(string $file_name, string $eventId, array $incidents) {  
  if (!empty($eventId) && !empty($incidents)) {
    mkdir_p("data/");

    $filename = "./data/{$file_name}.json";
    $file = fopen($filename, "w");
    if ($file) {
      fwrite($file, json_encode($incidents, JSON_PRETTY_PRINT));
      fclose($file);
    } else {
      echo "\n\nErro ao abrir o arquivo para salvar os dados.\n\n";
    }
  }
}

function rmdir_r(string $path) {
  if (is_dir($path)) {
    $files = glob($path . '/*');
    foreach ($files as $file) {
      if (is_file($file)) {
        unlink($file);
      } 
    }
    rmdir($path);
  }
}


function mkdir_p(string $path) {
  if (!file_exists($path)) {
    mkdir($path, 0777, true);
  }
}

?>