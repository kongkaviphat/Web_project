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
            margin-top: 100px;
        }
        h2{
            margin-top: 20px;
        }
    </style>
</head>
<body>
<header class="head">
        <h2>ภาคใต้</h2>
    </header>
    <div class="container">
        <div class="mg">
<?php 
$sql =$pdo->prepare("SELECT * FROM detail_review_food WHERE foodregion='ใต้'");
$sql->execute();
while($row = $sql->fetch()){
    ?>
    <div class="food">
        <?=$row["foodname"]?><br>
    </div>
    <img src="img_food/<?=$row["foodimage"]?>" height ='200' class="rounded mx-auto d-block"><br>
    <div class="data">
        รายละเอียดอาหาร:<br> <?=$row["fooddetail"]?><br>
        ภาค: <?=$row["foodregion"]?><br>
    </div>
    <hr>
        
<?php } ?>
</div>
</div>
</body>
</html>