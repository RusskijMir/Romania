<?php
require_once("bootstrap.php");

session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] === true)
{
  $template =
      "<form method='POST'>
  Название товара: <input type='text' name='name'><br>
  Цена товара: <input type='text' name='price'><br>
  <input type='submit' name='addGood' value='Отправить'>
</form>";

  $content = "";

  if(isset($_POST['addGood'])) {
    if(isset($_POST['name']))
      $name = $_POST['name'];
    if(isset($_POST['price']))
      $price = $_POST['price'];

    if(!(empty($name) || empty($price))) {
      $user = "root";
      $pass = "ee34nf3o";
      $db = "Romania";
      $host = "localhost";
      $con = new mysqli($host, $user, $pass, $db);
      if(DEBUG)
        $content .= $con->error . "<br>";
      $con->set_charset("utf8");

      $con->query("INSERT INTO `Goods` (name, price) VALUES('$name', '$price')");
      if(DEBUG)
        $content .= $con->error . "<br>";
      if(!$con->errno)
        $content .= "Товар успешно добавлен" . "<br>";
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