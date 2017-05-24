<?php

  if(!is_dir(__DIR__."/geo_cords/")){
    mkdir(__DIR__."/geo_cords/",0755,true);
  }
  if (is_dir(__DIR__."/geo_cords/")){
    move_uploaded_file($_FILES["geo_cords_file"]["tmp_name"], __DIR__."/geo_cords/".$_FILES["geo_cords_file"]["name"]);
    $csv = array_map('str_getcsv', file(__DIR__."/geo_cords/".$_FILES["geo_cords_file"]["name"]));
    array_walk($csv, function(&$a) use ($csv) {
      $a = array_combine($csv[0], $a);
    });
    array_shift($csv);
  }
  //print_r($csv);
  $myJSON = json_encode($csv);
  echo $myJSON;

?>
