<!DOCTYPE>
<html>
<head>
  <meta charset="utf-8">
  <title>Привет</title>
  <link href='template.css' rel='stylesheet'>
</head>
<body>
  <div id='menu'>
    <ul>
      <li><a href='index.php'>Главная</a></li>
      <li><a href='shop.php'>Магазин</a></li>
      <li><a href='addGoods.php'>Добавить товар</a></li>
      <li><a href='addMoney.php'>Зачислить средства</a></li>
    </ul>
  </div>
  <?php include("profile.php");?>
  <div id='content'>
    <?php
    if(isset($content))
      echo $content;
    ?>
  </div>
</body>
</html>