<?php
   $mysqli = new mysqli("sql309.infinityfree.com", "if0_37347050", "pKLwfA73YN22xoD", "if0_37347050_shop");

   if ($mysqli->connect_error) {
       die("Connection failed: " . $mysqli->connect_error);
   }

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       $name = $mysqli->real_escape_string($_POST['name']);
       $description = $mysqli->real_escape_string($_POST['description']);
       $mysqli->query("INSERT INTO products (name, description) VALUES ('$name', '$description')");
       header("Location: ../index.php");
   }
   ?>

   <form method="post">
       Название: <input type="text" name="name" required>
       Описание: <textarea name="description" required></textarea>
       <input type="submit" value="Добавить товар">
   </form>