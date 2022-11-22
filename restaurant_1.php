<?php include "dbconnect.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300&display=swap');
        .mg{
            margin-top:80px;
            margin-left: 150px;
        }
        .head{
            text-align: center;
            font-family: 'Noto Sans Thai', sans-serif;
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
            font-family: 'Noto Sans Thai', sans-serif;
        }
        .fontsize2{
            text-align: center;
            margin-top: 50px;
            font-family: 'Noto Sans Thai', sans-serif;

        }
        .fontsize3{
            margin-top: 10px;
            font-family: 'Noto Sans Thai', sans-serif;
        }
    </style>

</head>
<body>
    <header class="head">
        <h1>ร้านอาหาร &nbsp ครัวเชียงใหม่</h1>
    </header>
    <nav>
        <div class="img1">
        <img src="img_restaurant/krua-jiangmai.jpg" class="rounded mx-auto d-block" height="100%">
        </div>
        <div class="fontsize1">
        <h4>อาหารแนะนำ : &nbsp ข้าวซอยไก่ , ไส้อั่ว , แกงโฮะ<h4>
        <h4>ที่อยู่ร้านอาหาร : &nbsp ระหว่างซอยทองหล่อ 5 กับ 7 (BTS ทองหล่อ)<h4>
        <h4>เวลาเปิด-ปิด : &nbsp วันจันทร์-อาทิตย์ 12.00-23.00<h4>
        </div>
    </nav>
    <section>
        <div class="fontsize2">
            <h1>เมนูอาหาร</h1>
        </div> 
    </section>
    
    <!-- <nav><h2 class="position-absolute top-0 start-50">เมนูอาหาร</h2></nav> -->
    
    
    <div class="mg">
<?php 
$sql =$pdo->prepare("SELECT foodimage,foodname,fooddetail,foodregion,price+20 as price FROM detail_review_food WHERE foodregion='เหนือ'");
$sql->execute();
while($row = $sql->fetch()){
    ?> 
    <img src="img_food/<?=$row["foodimage"]?>" height ='270' class="rounded" ><br>
    <div class="fontsize3">
       <p class="fs-6">
           ชื่ออาหาร:&nbsp<?=$row["foodname"]?><br>
           รายละเอียดอาหาร:&nbsp<?=$row["fooddetail"]?><br>
           ราคาอาหาร:&nbsp<?=$row["price"]?><br>
           ภาค:&nbsp<?=$row["foodregion"]?><br><hr>
       </p>     
    </div>
    <!-- <p class="fw-normal" > -->
<?php } ?>
    </div>
</body>
</html>
