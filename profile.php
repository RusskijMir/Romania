<?php

$template = "";

if(isset($_SESSION['login'])) {
  $user = "root";
  $pass = "ee34nf3o";
  $db = "Romania";
  $host = "localhost";
  $con = new mysqli($host, $user, $pass, $db);
  $con->set_charset("utf8");

  $result = $con->query("SELECT login, money FROM Users WHERE id = {$_SESSION['login']}");
  $row = $result->fetch_assoc();
  $template .=
      "<div id='profile'>
        Имя пользователя: {$row['login']}<br>
        Деньги: {$row['money']}
      </div>";
}

echo $template;


