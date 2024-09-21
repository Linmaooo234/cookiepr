<?php
   session_start();
   $mysqli = new mysqli("sql309.infinityfree.com", "if0_37347050", "pKLwfA73YN22xoD", "if0_37347050_shop");

   if ($mysqli->connect_error) {
       die("Connection failed: " . $mysqli->connect_error);
   }

   if (isset($_GET['delete'])) {
       $id = intval($_GET['delete']);
       $mysqli->query("DELETE FROM products WHERE id = $id");
       header("Location: index.php");
   }

   $result = $mysqli->query("SELECT * FROM products");
   ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
<h1>Каталог товаров</h1>
   <div class="katalog">
        <a class="buttonadd" href="pages/add_product.php">Добавить товар</a>

        
       <?php while ($row = $result->fetch_assoc()): ?>
           <h3><?php echo htmlspecialchars($row['name']); ?></h3>
           <p><?php echo htmlspecialchars($row['description']); ?></p>
      
           <div class="knopki">
            <a href="index.php?delete=<?php echo $row['id']; ?>">Удалить</a></br>
            <a href="pages/cart.php?add=<?php echo $row['id']; ?>">Добавить в корзину</a></br>
           </div>
       <?php endwhile; ?>
       </div>
</body>
</html>
