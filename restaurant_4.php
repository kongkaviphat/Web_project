<?php include "dbconnect.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .mg{
            margin-top:80px;
            margin-left: 150px;
        }
        .head{
            text-align: center;
        }
        h1{
            padding-top: 30px;
        }
        .img1{
            margin-top: 30px;
        }
        .fontsize1{
            margin-top: 50px;
            /* margin-left: 600px; */
            text-align: center;
        }
        .fontsize2{
            text-align: center;
            margin-top: 50px;

        }
        .fontsize3{
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header class="head">
        <h1>ร้านอาหาร &nbsp Phed Phed Cafe</h1>
    </header>
    <nav>
        <div class="img1">
           <img src="img_restaurant/Phed_Phed.webp" class="rounded mx-auto d-block" height="700">
        </div>
        <div class="fontsize1">
           <h4>อาหารแนะนำ : &nbsp ส้มตำ , ก้อย , แกงหน่อไม้ใบย่านาง<h4>
           <h4>ที่อยู่ร้านอาหาร : &nbsp พหลโยธิน ซอย 8 (BTS อารีย์)<h4>
           <h4>เวลาเปิด-ปิด : &nbsp วันจันทร์-อาทิตย์19.00-23.00<h4>
        </div>
    </nav>
    <section>
        <div class="fontsize2">
            <h1>เมนูอาหาร</h1>
        </div> 
    </section>

    <div class="mg">
        <?php 
        $sql =$pdo->prepare("SELECT foodimage,foodname,fooddetail,foodregion,price+25 as price FROM detail_review_food WHERE foodregion='อีสาน'");
        $sql->execute();
        while($row = $sql->fetch()){
        ?>
           <img src="img_food/<?=$row["foodimage"]?>" height ='270' class="rounded"><br>
           <div class="fontsize3">
               <p class="fs-6">
                   ชื่ออาหาร:<?=$row["foodname"]?><br>
                   รายละเอียดอาหาร:<?=$row["fooddetail"]?><br>
                   ราคาอาหาร:<?=$row["price"]?><br>
                   ภาค:<?=$row["foodregion"]?><br><hr> 
               </p>
           </div>     
        <?php } ?>
    </div>
    
</body>
</html>