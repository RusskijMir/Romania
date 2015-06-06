<?php
require_once("bootstrap.php");
session_start();
if(isset($_SESSION['login'])) {
  if(isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    header("Location: addGoods.php");
  } else {
    header("Location: shop.php");
  }
} else {
  $template =
"<form method='POST'>
  Имя пользователя: <input type='text' name='username'><br>
  Пароль: <input type='password' name='pass'><br>
  <input type='submit' name='login' value='Отправить'>
</form>";
  $content = "";

  if(isset($_POST['login'])) {
    if(!(empty($_POST['username']) || empty($_POST['pass']))) {
      $user = "root";
      $pass = "ee34nf3o";
      $db = "Romania";
      $host = "localhost";
      $con = new mysqli($host, $user, $pass, $db);
      if(DEBUG)
        $content .= $con->error . "<br>";
      $con->set_charset("utf8");

      $result = $con->query("SELECT * FROM `Users` WHERE login='{$_POST['username']}'");
      if(DEBUG)
        $content .= $con->error . "<br>";
      if($con->affected_rows !== 1) {
        $content .= "Неверное имя пользователя и/или пароль";
      } else {
        $arr = $result->fetch_assoc();
        if($arr['pass'] !== $_POST['pass']) {
          $content .= "Неверное имя пользователя и/или пароль";
        } else {
          $_SESSION['login'] = $arr['id'];
          debug($_SESSION);
          if($arr['admin'] == 1)
            $_SESSION['admin'] = true;
          header("Location: index.php");
        }
      }
      $con->close();
    }
  }

  $content .= $template;
  include("template.php");
}