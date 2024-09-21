<?php
   session_start();
   $mysqli = new mysqli("sql309.infinityfree.com", "if0_37347050", "pKLwfA73YN22xoD", "if0_37347050_shop");

   if ($mysqli->connect_error) {
       die("Connection failed: " . $mysqli->connect_error);
   }

   if (isset($_GET['add'])) {
       $product_id = intval($_GET['add']);
       setcookie("cart[$product_id]", 1, time() + 3600); 
       header("Location: cart.php");
   }

   if (isset($_GET['remove'])) {
       $product_id = intval($_GET['remove']);
       setcookie("cart[$product_id]", "", time() - 3600); 
       header("Location: cart.php");
   }

   $cart_items = $_COOKIE['cart'] ?? [];
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
<h1>Корзина</h1>
   <div class="katalog">
       <?php foreach ($cart_items as $id => $value): ?>
           <?php
           $result = $mysqli->query("SELECT * FROM products WHERE id = $id");
           $product = $result->fetch_assoc();
           ?>
           <div class="korzim">
               <?php echo htmlspecialchars($product['name']); ?>
                <?php echo htmlspecialchars($product['description']); ?>
           </div>
               <a href="cart.php?remove=<?php echo $product['id']; ?>">Удалить</a>
       <?php endforeach; ?>
   </div>
   <a href="../index.php">Вернуться обратно</a>
</body>
</html>