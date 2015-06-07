<?php
require_once("bootstrap.php");

session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] === true)
{
  $template =
      "<form method='POST'>
  Имя пользователя: <input type='text' name='username'><br>
  Зачисляемые средства: <input type='text' name='money'><br>
  <input type='submit' name='addMoney' value='Отправить'>
</form>";

  $content = "";

  if(isset($_POST['addMoney'])) {
    if(isset($_POST['username']))
      $username = $_POST['username'];
    if(isset($_POST['money']))
      $money = $_POST['money'];

    if(!(empty($username) || empty($money))) {
      $user = "root";
      $pass = "ee34nf3o";
      $db = "Romania";
      $host = "localhost";
      $con = new mysqli($host, $user, $pass, $db);
      if(DEBUG)
        $content .= $con->error . "<br>";
      $con->set_charset("utf8");

      $con->query("UPDATE Users SET money = money + $money");
      if(DEBUG)
        $content .= $con->error . "<br>";
      if(!$con->errno)
        $content .= "Средства успешно зачислены" . "<br>";
      else
        $content .= "Ошибка добавления в базу данных" . "<br>";
      $con->close();
    }
    else
      $content .= "Не все поля заполнены" . "<br>";
  }

  $content .= $template;
  include("template.php");
} else {
  header("Location: index.php");
}