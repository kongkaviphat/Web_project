<?php include "dbconnect.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/review.css">
    <style>
        .mg{
            margin-top: 30px;
        }
        h2{
            margin-top: 23px;
        }
    </style>

</head>
<body>
    <header class="head">
        <h2>ค้นหาอาหาร</h2><hr>
    </header>
    <div class="container-md">
        <div class="mg">
<?php
$value =$_POST["foodname"];
// $sql = $pdo->prepare("SELECT * FROM detail_review_food,detail_restaurant WHERE foodname LIKE ?");
// $sql =$pdo->prepare("SELECT restaurant_name,foodname FROM detail_restaurant INNER JOIN detail_review_food ON detail_restaurant.restaurant_id=detail_review_food.food_id;")
// SELECT restaurant_name,foodname FROM detail_restaurant INNER JOIN detail_review_food ON detail_restaurant.restaurant_region=detail_review_food.foodregion;
$sql = $pdo->prepare("SELECT * FROM detail_restaurant INNER JOIN detail_review_food 
ON detail_restaurant.restaurant_region=detail_review_food.foodregion WHERE foodname LIKE ?");

if(!empty($_POST)){
    $value ='%'.$_POST["foodname"]. '%';
}
$sql->bindParam(1,$value);
$sql->execute();

while($row = $sql->fetch()){
    ?>
    <div class="food">
        <?=$row["foodname"]?><br>
    </div>
    
    <img src="img_food/<?=$row["foodimage"]?>" height ='200' class="rounded mx-auto d-block"><br>
    <div class="data">
        ชื่อร้านอาหาร: <?=$row["restaurant_name"]?><br>
        <!-- price:<?=$row["price"]?><br> -->
        <!-- <a href="showrestaurant.php">ชื่อร้านอาหาร</a> -->
        รายละเอียดอาหาร: <br><?=$row["fooddetail"]?><br>
        ภาค: <?=$row["foodregion"]?><br>
        
    </div>
    <hr>
        
<?php } ?>
</div>
</div>
</body>
</html>
้