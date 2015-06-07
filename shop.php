<?php
require_once("bootstrap.php");
session_start();

if(isset($_SESSION['login'])) {
  $content = "";

  $user = "root";
  $pass = "ee34nf3o";
  $db = "Romania";
  $host = "localhost";
  $con = new mysqli($host, $user, $pass, $db);
  if(DEBUG)
    $content .= $con->error . "<br>";
  $con->set_charset("utf8");

  //Обработка запроса на покупку
  if(isset($_POST['purchase']) && isset($_POST['purchases'])) {

    //Подсчет суммарной стоимости покупок
    $query = "SELECT SUM(price) FROM Goods WHERE id IN (";
    foreach($_POST['purchases'] as $id) {
      $query .= "'$id', ";
    }
    $query = rtrim($query, ", ");
    $query .= ")";
    $result = $con->query($query);
    if(DEBUG)
      $content .= $con->error . "<br>";
    $row = $result->fetch_row();
    $totalPrice = $row[0];

    //Получение суммарного счета пользователя
    $result = $con->query("SELECT money FROM `Users` WHERE id = '{$_SESSION['login']}'");
    if(DEBUG)
      $content .= $con->error . "<br>";
    $row = $result->fetch_row();
    $accountMoney = $row[0];

    //Добавление покупок
    if($accountMoney < $totalPrice)
      $content .= "На вашем счету недостаточно средств для совершения покупки";
    else {
      $query = "INSERT INTO `UserGoods` (userId, goodId, `count`) VALUES";
      foreach($_POST['purchases'] as $id) {
        $query .= "('{$_SESSION['login']}', '$id', '1'),";
      }
      $query = rtrim($query, ',');
      $query .= " ON DUPLICATE KEY UPDATE `count` = `count` + 1";
      $con->query($query);
      if(DEBUG)
        $content .= $con->error . "<br>";

      //Списание средств со счета
      $con->query("UPDATE `Users` SET money = money - $totalPrice");
      if(DEBUG)
        $content .= $con->error . "<br>";
    }
  }

  //Создание формы покупок
  $result = $con->query("SELECT * FROM `Goods`");
  if(DEBUG)
    $content .= $con->error . "<br>";
  $template  =
      "<form method='post'>
        <select multiple name='purchases[]'>";
  while($row = $result->fetch_row()) {
    $template .= "<option value='$row[0]'>$row[1]($row[2])</option>";
  }
  $template .=
      "  </select><br>
         <input type='submit' name='purchase' value='Купить'>
      </form>";

  $content .= $template;
  include('template.php');

  $con->close();
} else {
  header("Location: index.php");
}