<?php
error_reporting(E_ALL);
define('DEBUG', true);

function debug($param) {
  if(DEBUG)
    var_dump($param);
    echo "<br><br>";
}